<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Orders;
use App\Order_product;
use App\Order_detail;
use DataTables;
use Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(){
        $orders = Orders::with('product', 'buyer')->get();
        //dd($orders->toArray());
        return view('pages.admin.index_order')->with('orders', $orders);
    }

    public function destroy($id){
        $order = Orders::find($id);
        $order->delete();

        return redirect()->back()->with('status', 'Data berhasil dihapus');   
    }

    public function dataTables(){
        $item = Orders::with('product', 'buyer')->get();

        return Datatables::of($item)
            ->addIndexColumn()
            ->editColumn('fullname', function ($item) {
                return $item->buyer->fullname;
            })
            ->editColumn('product_name', function ($item) {
                return $item->product->product_name;
            })
            ->editColumn('price', function ($item) {
                return 'Rp '.number_format($item->price, 0);
            })
            ->editColumn('qty', function ($item) {
                return $item->qty.' pcs';
            })
            ->editColumn('status', function ($item) {
                if($item->status=='1'){
                    return "Menunggu Konfirmasi";
                }
                elseif($item->status=='2'){
                    return "Sudah Dibayar";
                }
                else{
                    return "Belum Dibayar";
                }
            })
            ->addColumn('action', function($item){
                return  '<a href="'.route('show.order', $item->id).'" class="btn btn-sm btn-info" style="margin-right:7px"><i class="fas fa-eye"></i></a>'.
                        '<a href="'.route('edit.order', $item->id).'" class="btn btn-sm btn-info" style="margin-right:7px"><i class="fas fa-edit"></i></a>'.
                        '<a href="'.route('destroy.order', $item->id).'" class="btn btn-sm btn-info"><i class="fas fa-trash-alt"></i></a>';
            })
            ->rawColumns(['images','action'])
            ->make(true);
    }

//ORDERING FUNCTION===========================================================================
    public function orderProduct(Request $request){
        Order_product::create([
            'user_id' =>Auth::id(),
            'product_id' =>$request->get('product_id'),
            'price' =>$request->get('price'),
            'qty' =>$request->get('qty'),
            'total' =>$request->get('total'),
        ]);

        return redirect()->back()->with('Add to Cart Success');
    }

    public function bayar(Request $request){
        $user = Auth::user();
        $order = Orders::create([
            'user_id' =>$user->id,
            'email' =>$user->email,
            'fullname' =>$user->fullname,
            'address' =>$user->address,
            'city'  =>$user->city,
            'postal_code' =>$user->postal_code,
            'order_date' =>Carbon::now(),
            'total' =>$request->get('total')
        ]);
        
        $product = Order_product::all();
        foreach($product as $item){
            Order_detail::create([
                'order_id' =>$order->id,
                'product_id' =>$item->id,
                'price' =>$item->price,
                'qty' =>$item->qty
            ]);
        }

        Order_product::query()->delete();

        return redirect()->back()->with('status','Order success');
    }
}