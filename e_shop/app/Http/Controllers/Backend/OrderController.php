<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;
use DataTables;

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

    public function bayar(Request $request,$id){
        $order = Orders::find($id);
        if($order->status!=0){
            $order->status = '2';
            $order->save();

            return redirect()->back()->with('status','Barang sudah disetujui');
        }

        return redirect()->back()->with('failed','Barang belum dibayar');
    }

    public function dataTables(){
        $item = Orders::with('product', 'buyer')->get();

        return Datatables::of($item)
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
                return  '<a href="'.route('payOrder', $item->id).'" class="btn btn-xs btn-success" style="margin-right:7px; width:40px"><i class="fas fa-check"></i></a>'.
                        '<a href="'.route('deleteOrder', $item->id).'" class="btn btn-xs btn-danger" style="width:40px"><i class="fas fa-trash-alt"></i></a>';
            })
            ->rawColumns(['images','action'])
            ->make(true);
    }
}