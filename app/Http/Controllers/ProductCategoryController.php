<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ProductCategoryDataTable;
use App\Models\Product;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index(ProductCategoryDataTable $dataTable)
    {
        return $dataTable->render('products.categories.index');
    }

    public function create()
    {
        return view('products.categories.create');
    }

    public function store(Request $request)
    { 
        $product = ProductCategory::create($request->all());

        flash('Kategori baru telah ditambahkan')->success();
    	
    	return redirect()->route('category.index');
    }

    public function show($id)
    {
        $product = ProductCategory::find($id);
        return view('products.categories.show', compact('product'));
    }

    public function destroy($id)
    {
       	$product = ProductCategory::find($id)->delete();

        flash ('Data berhasil dihapus')->success();
        
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $product = ProductCategory::find($id);
        return view('products.categories.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = ProductCategory::find($id)->update($request->all());

        flash('Data telah diupdate')->success();
        
        return redirect()->route('category.index');
    }

    public function getCategory()
    {
        
    }
}
