<?php

namespace App\Http\Controllers;


class DiscountController extends Controller
{
    public function index()
    {
        return view('discount.index');
    }

    public function create()
    {
        return view('discount.create');
    }


    
}
