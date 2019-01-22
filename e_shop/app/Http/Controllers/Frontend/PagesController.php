<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Welcome To Laravel!';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.index')->with ('title', $title);
    }
    public function indexuser(){
        $title = 'array';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.indexuser')->with ('title', $title);
    }
    public function category(){
        $title = 'Kategori';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.category')->with ('title', $title);
    }
    public function order(){
        $title = 'ORDER';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.order')->with ('title', $title);
    }
    public function product(){
        $title = 'PRODUK';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.product')->with ('title', $title);
    }
    public function user(){
        $title = 'USER';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.user')->with ('title', $title);
    }
    public function shop(){
        $title = 'SHOP';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.shop')->with ('title', $title);
    }
    public function tambahproduct(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.tambahproduct')->with ('title', $title);
    }
    public function registeraccount(){
        $title = 'Register Akun';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.registeraccount')->with ('title', $title);
    }
    public function loginaccount(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.loginaccount')->with ('title', $title);
    }
    public function wishlist(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.wishlist')->with ('title', $title);
    }
    public function editproduct(){
        $title = 'Edit Produk';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.editproduct')->with ('title', $title);
    }
}   
