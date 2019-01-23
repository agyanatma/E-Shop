<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function wishlist(){
        $title = 'TAMBAH PRODUCT';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.wishlist')->with ('title', $title);
    }

    public function blog(){
        $title = 'blog';
        //return view ('pages.index', compact ('title'));
        return view ('pages.frontend.blog')->with ('title', $title);
    }

}   
