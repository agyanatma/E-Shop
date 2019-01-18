<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('pages.category')->with('categories', $categories);
    }

    
}
