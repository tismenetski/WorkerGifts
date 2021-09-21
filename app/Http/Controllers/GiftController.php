<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\GiftCategory;
use Illuminate\Http\Request;

class GiftController extends Controller
{
    public function index() {
        $gitfs = Gift::all();
        return view('admin.gifts')->with('gifts', $gitfs);
    }

    public function create() {
        $giftCategories = GiftCategory::all();
        return view('admin.addGift')->with('gift_categories' , $giftCategories);
    }

    public function store(Request $request) {

        $validation =  $request->validate([
            'name' => 'required|unique:gifts',
            'description' => 'max:2000',
            'value' => 'required|numeric|min:0',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gift_category' => 'nullable|exists:gift_categories,id'
        ]);

        $gift = Gift::create([
            'name' => $request->name,
            'description' => $request->description ?? "",
            'value' => $request->value,
            'gift_category_id' => $request->gift_category ?? null,
        ]);
        $gift->save();
        return redirect()->route('availableGifts');
    }

    public function delete($id) {
        $gift = Gift::findOrFail($id);
        $gift->delete();
        return redirect()->back()->with('Successfully Deleted Gift');
    }


    public function edit($id) {
        $gift = Gift::findOrFail($id);
        $gift_categories = GiftCategory::all();
        return view('admin.editGift')->with('gift', $gift)->with('gift_categories', $gift_categories);
    }
}
