<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    public function create()
    {
        $sizes  = ['P', 'M', 'G', 'GG'];
        $colors = [
            'red'   => 'Vermelho',
            'green' => 'Verde',
            'blue'  => 'Azul'
        ];

        return view('product.create', [
            'sizes'  => $sizes,
            'colors' => $colors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());
    
        return Redirect::route('product.edit', ['id' => $product->id])->with('success', 'Produto cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $model = Product::findOrFail($id);

        $sizes  = ['P', 'M', 'G', 'GG'];
        $colors = [
            'red'   => 'Vermelho',
            'green' => 'Verde',
            'blue'  => 'Azul'
        ];

        return view('product.update', [
            'sizes'  => $sizes,
            'colors' => $colors,
            'model'  => $model,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
