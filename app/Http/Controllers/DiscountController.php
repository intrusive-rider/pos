<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('discount.index', compact('discounts'));
    }

    public function create()
    {
        return view('discount.create');
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|max:255|unique:discounts,name',
            'type' => 'required|in:perc,fixed',
            'value' => [
                'required',
                'numeric',
                'min:1',
                Rule::when(request('type') === 'perc', 'between:1,99'),
            ],
            'max_value' => 'nullable|numeric|min:1|prohibited_if:type,fixed',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        Discount::create($attr);
        return redirect()->route('index-discount');
    }

    public function edit(Discount $discount)
    {
        return view('discount.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $attr = $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('discounts')->ignore($discount),
            ],
            'type' => 'required|in:perc,fixed',
            'value' => [
                'required',
                'numeric',
                'min:1',
                Rule::when(request('type') === 'perc', 'between:1,99'),
            ],
            'max_value' => 'nullable|numeric|min:1|prohibited_if:type,fixed',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $discount->update($attr);
        return redirect()->route('index-discount');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('index-discount');
    }
}
