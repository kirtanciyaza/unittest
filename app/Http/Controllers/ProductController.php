<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProductController extends Controller
{

    public function generate(Request $request)
{
    $products = Product::select('id', 'name', 'price')->get();


    $qrCodes = [];

    foreach ($products as $product) {

        $qrCode = QrCode::size(150)
            ->backgroundColor(255, 255, 255)
            ->color(0, 128, 128)
            ->generate('ID: ' . $product->id . ' - ' . $product->name . ' - ' . $product->price);


        $qrCodes[$product->id] = $qrCode;
    }

    $products = Product::all();

       return view('product.qrcode', ['products' => $products, 'qrCodes' => $qrCodes]);
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
            'price' =>'required|numeric'
        ]);

        if($validator->fails())
        {
            return redirect()->route('product.index')->with(['errors' => $validator->errors()]);
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


        return redirect()->route('product.index')->with('message' , 'product created successfully');

    }
    public function show(Request $request,$id)
    {
        $product = Product::find($id);
        $qrCode = QrCode::size(150)
        ->backgroundColor(255, 255, 255)
        ->color(0, 128, 128)
        ->generate('ID: ' . $product->id . ' - ' . $product->name . ' - ' . $product->price);

        return view('product.show',compact('product','qrCode'));
    }

    public function edit(Request $request,$id)
    {
        $product = Product::find($id);
        return view('product.edit',compact('product'));

    }

    public function update(Request $request, $id)
{

    // Find the existing product
    $product = Product::find($id);
    if (!$product) {
        return redirect()->route('product.index');

    }

    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'desc' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image' // Validate image if present
    ]);

    if ($validator->fails()) {
        return redirect()->route('product.index')->with(['errors' => $validator->errors()]);
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

    return redirect()->route('product.index')->with('message' , 'product updated successfully');
}


    public function delete(Request $request,$id)
    {
        $product = Product::find($id);

        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }
        $product->delete();

        return redirect()->route('product.index')->with('message' , 'product deleted successfully');
    }
}
