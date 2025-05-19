<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVariantRequest;
use App\Http\Requests\UpdateVariantStore;
use App\Models\Stock;
use App\Models\Variant;
use Illuminate\Support\Facades\Redirect;

class VariantController extends Controller
{   
    /**
     * Create a newly created resource in storage.
     */
    public function create($product_id) {

        /** @var array */
        $sizes  = ['P', 'M', 'G', 'GG'];

        /** @var array */
        $colors = ['red'   => 'Vermelho', 'green' => 'Verde', 'blue'  => 'Azul'];

        return view('variant.create', [
            'product_id' => $product_id,
            'sizes'      => $sizes,
            'colors'     => $colors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVariantRequest $request)
    {   
        $model = new Variant();
        $model->fill($request->all());
        $model->setConfig(['size'  => $request->get('size'), 'color' => $request->get('color')]);
        $model->save();

        $stock = new Stock();
        $stock->variant_id = $model->id;
        $stock->quantity   = $request->get('quantity');
        $stock->save();
    
        return Redirect::route('variant.edit', ['id' => $model->id])->with('success', __(':resource registered successfully!', ['resource' => __('Variant')]));
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $model = Variant::findOrFail($id);

        /** @var array */
        $sizes  = ['P', 'M', 'G', 'GG'];

        /** @var array */
        $colors = ['red'   => 'Vermelho', 'green' => 'Verde', 'blue'  => 'Azul'];

        return view('variant.update', [
            'model'  => $model,
            'sizes'  => $sizes,
            'colors' => $colors,
        ]);
    }

   
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVariantStore $request, string $id)
    {
        $model = Variant::findOrFail($id);
        $model->fill($request->all());
        $model->setConfig(['size'  => $request->get('size'), 'color' => $request->get('color')]);
        $model->save();

        $stock = $model->stock;
        $stock->quantity = $request->get('quantity');
        $stock->save();

        return Redirect::route('variant.edit', ['id' => $model->id])->with('success', __(':resource updated successfully!', ['resource' => __('Variant')]));
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $model = Variant::findOrFail($id);

        $model->stock->delete();

        $model->delete();

        return Redirect::route('product.edit', ['id' => $model->product_id])->with('success', 'Variação deletada com sucesso!');
    }
}
