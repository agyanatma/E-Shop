<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome To Laravel!';
        //return view ('pages.index', compact ('title'));
        return view ('pages.index')->with ('title', $title);
    }
    public function indexuser(){
        $title = 'array';
        //return view ('pages.index', compact ('title'));
        return view ('pages.indexuser')->with ('title', $title);
    }
    public function category(){
        $title = 'Kategori';
        //return view ('pages.index', compact ('title'));
        return view ('pages.category')->with ('title', $title);
    }
    public function order(){
        $title = 'ORDER';
        //return view ('pages.index', compact ('title'));
        return view ('pages.order')->with ('title', $title);
    }
    public function product(){
        $title = 'PRODUK';
        //return view ('pages.index', compact ('title'));
        return view ('pages.product')->with ('title', $title);
    }
    public function user(){
        $title = 'USER';
        //return view ('pages.index', compact ('title'));
        return view ('pages.user')->with ('title', $title);
    }
    public function shop(){
        $title = 'SHOP';
        //return view ('pages.index', compact ('title'));
        return view ('shop.shop')->with ('title', $title);
    }
    public function tambahproduct(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.tambahproduct')->with ('title', $title);
    }
    public function registeraccount(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.registeraccount')->with ('title', $title);
    }
    public function loginaccount(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.loginaccount')->with ('title', $title);
    }
    public function wishlist(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.wishlist')->with ('title', $title);
    }
    public function editproduct(){
        $title = 'Edit Produk';
        //return view ('pages.index', compact ('title'));
        return view ('pages.editproduct')->with ('title', $title);
    }
}   
