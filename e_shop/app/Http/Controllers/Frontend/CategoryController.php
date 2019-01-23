<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category_product::get();
        $categories = Category_product::all();
        return view('pages.index')->with('categories', $categories);
        
    }

}