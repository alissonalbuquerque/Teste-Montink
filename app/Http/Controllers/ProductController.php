<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{   
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $products = Product::all();

        return view('product.index', [
            'products' => $products
        ]);
    }

    /**
     * Create a newly created resource in storage.
     */
    public function create() {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
    
        return Redirect::route('product.edit', ['id' => $product->id])->with('success', __(':resource registered successfully!', ['resource' => __('Product')]));
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $model = Product::findOrFail($id);

        return view('product.update', [
            'model'  => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $model = Product::findOrFail($id);
        $model->fill($request->all());
        $model->save();

        return Redirect::route('product.edit', ['id' => $model->id])->with('success', __(':resource updated successfully!', ['resource' => __('Product')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Product::findOrFail($id);

        $model->variants->each(function(Variant $variant) {
            $variant->stock()->delete();
            $variant->delete();
        });

        $model->delete();

        return Redirect::route('product.index')->with('success', 'Produto deletado com sucesso!');
    }
}
