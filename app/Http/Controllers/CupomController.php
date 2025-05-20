<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCupomRequest;
use App\Http\Requests\UpdateCupomRequest;
use App\Models\Cupom;
use Illuminate\Support\Facades\Redirect;

class CupomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $models = Cupom::all();
        
        return view('cupom.index', [
            'models' => $models
        ]);
    }

    /**
     * Create a newly created resource in storage.
     */
    public function create()
    {
        $active = [1 => 'Sim', 0 => 'Não'];

        return view('cupom.create', [
            'active' => $active
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCupomRequest $request)
    {   
        $model = Cupom::create($request->all());
        
        return Redirect::route('cupom.edit', ['id' => $model->id])->with('success', __(':resource registered successfully!', ['resource' => __('Cupom')]));
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $model = Cupom::findOrFail($id);

        $active = [1 => 'Sim', 0 => 'Não'];

        return view('cupom.update', [
            'model'  => $model,
            'active' => $active,
        ]);
    }

    /**
     * Update a newly created resource in storage.
     */
    public function update(UpdateCupomRequest $request, string $id)
    {   
        $model = Cupom::findOrFail($id);

        $model->fill($request->all());

        $model->save();
        
        return Redirect::route('cupom.edit', ['id' => $model->id])->with('success', __(':resource updated successfully!', ['resource' => __('Cupom')]));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Cupom::findOrFail($id);
        
        $model->delete();

        return Redirect::route('cupom.index')->with('success', 'Cupom deletado com sucesso!');
    }
}
