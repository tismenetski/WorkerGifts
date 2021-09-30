<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Models\GiftCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

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


        if ($request->image) {
            $image = $request->image;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('gifts/',$image_new_name);
            $gift->image = $image_new_name;
        }

        $gift->save();
        return redirect()->route('availableGifts');
    }

    public function delete($id) {

        $gift = Gift::findOrFail($id);
        $image_name = $gift->image;
        File::delete(public_path().'/gifts/'.$image_name);

        $gift->delete();
        return redirect()->back()->with('Successfully Deleted Gift');
    }


    public function edit($id) {
        $gift = Gift::findOrFail($id);
        $gift_categories = GiftCategory::all();
        return view('admin.editGift')->with('gift', $gift)->with('gift_categories', $gift_categories);
    }


    public function update(Request $request) {

        $gift = Gift::findOrFail($request->id);

        $request->validate([
            'id' => Rule::unique('gifts')->ignore($gift->id,'id'),
            'name' => Rule::unique('gifts')->ignore($gift->name, 'name'),
            'description' => 'max:2000',
            'value' => 'required|numeric|min:0',
            'file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gift_category' => 'nullable|exists:gift_categories,id'
        ]);

        $gift->update([
            'name' => $request->name,
            'description' => $request->description ?? "",
            'value' => $request->value,
            'gift_category_id' => $request->gift_category ?? null
        ]);

        if ($request->image && $request->image !== $gift->image) {
            $image = $request->image;
            $image_new_name = time().$image->getClientOriginalName();
            $image->move('gifts/',$image_new_name);
            $gift->image = $image_new_name;
        }

        $gift->save();
        return redirect()->route('availableGifts')->with('Updated Gift Successfully');
    }
}
