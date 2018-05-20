<?php

namespace App\Http\Controllers;
use App\category;
use App\brand;
use App\product;

use Illuminate\Http\Request;

class adminController extends Controller
{
    
    public function index(){
$productCount=product::all()->count();
$categoryCount=category::all()->count();
$brandCount=brand::all()->count();
return view('admin.index',compact(['productCount','categoryCount','brandCount']));

    }

    
    
   
}
