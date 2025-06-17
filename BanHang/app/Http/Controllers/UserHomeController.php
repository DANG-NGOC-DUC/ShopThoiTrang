<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;



class UserHomeController extends Controller
{
    public function index()
{
    $products = Product::take(8)->get();
    return view('user.home', compact('products'));
}
}
