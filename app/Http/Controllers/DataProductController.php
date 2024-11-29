<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;



class DataProductController extends Controller
{
    public function DataProduct()
    {
        return view('data.table-product');
    }

    

}
