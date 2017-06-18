<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProductDataTable;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('products.index');
    }

    public function create()
    {
        $categories = ProductCategory::all();
    	return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    { 
        $product = new Product;
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->product_category_id = $request->product_category_id;

        if($request->hasFile('images')) {   
            $image = $request->file('images');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/products/' . $filename;
            $uploaded = $request->file('images')->move($path, $filename);

            $url_photo = $uploaded->getPathName();
            $product->images = $url_photo;
        }

        $product->save();

    	flash('Produk baru telah ditambahkan')->success();
    	
    	return redirect()->route('product.index');
    }

    public function show($id)
    {
        $product = Product::with('product_category')->where('id', $id)->first();

        return view('products.show', compact('product'));
    }

    public function destroy($id)
    {
        $member = Product::find($id)->delete();

        flash ('Produk berhasil dihapus')->success();
        
        return redirect()->route('product.index');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = ProductCategory::all();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->product_category_id = $request->product_category_id;

        if($request->hasFile('images')) {   
            $image = $request->file('images');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = 'uploads/products/' . $filename;
            $uploaded = $request->file('images')->move($path, $filename);

            $url_photo = $uploaded->getPathName();
            $product->images = $url_photo;
        }

        $product->save();

        flash('Produk telah diupdate')->success();
        
        return redirect()->route('product.index');
    }

    public function getCategory()
    {
        $category = ProductCategory::all();

        return $category;
    }
}
