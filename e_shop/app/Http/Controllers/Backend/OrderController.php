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
        $orders = Orders::all();
        //dd($orders->toArray());
        return view('pages.admin.index_order')->with('orders', $orders);
    }

    public function show($id){
        $orders = Orders::with(['orderDetail','orderDetail.product'])->find($id);
        $details = $orders->orderDetail;
        $item = Order_product::with(['product','buyer'])->where('user_id',Auth::id())->get();
        dd($item->toArray());
        return view('pages.admin.view_order')->with('orders', $orders)->with('details', $details);
    }

    public function destroy($id){
        $order = Orders::find($id);
        $order->delete();
        $detail = Order_detail::where('order_id',$order->id);
        $detail->delete();

        return redirect()->back()->with('status', 'Data berhasil dihapus');   
    }

    public function dataTables(){
        $item = Orders::all();

        return Datatables::of($item)
            ->addIndexColumn()
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
            ->rawColumns(['action'])
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
                'product_id' =>$item->product_id,
                'price' =>$item->price,
                'qty' =>$item->qty
            ]);
        }

        Order_product::where('user_id',Auth::id())->delete();

        return redirect()->back()->with('status','Order success');
    }
}