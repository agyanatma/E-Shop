<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Category_product;
use App\User;
use App\Orders;

class OrderController extends Controller
{
    public function index(){
        $orders = Orders::with('product', 'buyer')->get();
        $users = session()->get('user_session');
        //dd($orders->toArray());
        return view('pages.admin.index_order')->with('orders', $orders)->with('users', $users);
    }

    public function destroy($id){
        $order = Orders::find($id);
        $order->delete();

        return redirect()->back()->with('status', 'Data berhasil dihapus');   
    }

    public function bayar($id){
        $order = Orders::find($id);
        if($order->status==1){
            $order->status = '2';
            $order->save();
            return redirect()->back()->with('status','Barang sudah disetujui');
        }
        return redirect()->back();
    }
}
