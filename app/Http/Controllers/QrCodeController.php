<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;





class QrCodeController extends Controller
{



    public function index()
    {
        $product = Product::all();

        return response()->json([
            'status' => true,
            'product' => $product
        ],200);

    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'desc' => 'required',
            'price' =>'required|numeric',
            'image' => 'required|image',
        ]);

        if($validator->fails())
        {
            return response()->json([
                    'errors' => $validator->errors()
            ], 422);
        }

        $product = new Product();
        $product->name = $request->name;
        $product->desc = $request->desc;
        $product->price = $request->price;

        $product->save();

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = 'images/'.$imageName;
        $product->save();


        return response()->json([
            'status' => true,
            'messasge' => 'data added successfully',
            'data' => $product
        ],200);

    }



    public function edit(Request $request,$id)
    {
        $product = Product::find($id);

        return response()->json([
            'status' => true,
            'product' => $product
        ], 200);

    }

    public function update(Request $request, $id)
{

    // Find the existing product
    $product = Product::find($id);


    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'desc' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image' // Validate image if present
    ]);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors()
        ], 422);
    }

    // Update product details
    $product->name = $request->name;
    $product->desc = $request->desc;
    $product->price = $request->price;

    // Handle image upload if present
    if ($request->hasFile('image')) {
        // Delete the old image if it exists
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        // Save the new image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $product->image = 'images/' . $imageName;
    }

    // Save the updated product
    $product->save();

    return response()->json([
        'status' => true,
        'message' => 'Data updated successfully',
        'data' => $product
    ], 200);
}


    public function delete(Request $request,$id)
    {
        $product = Product::find($id);

        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data deleted successfully',
            'data' => $product
        ], 200);
    }


}
