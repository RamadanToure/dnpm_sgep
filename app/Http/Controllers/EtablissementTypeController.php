<?php

namespace App\Http\Controllers;

use App\Models\EtablissementType;
use Illuminate\Http\Request;

class EtablissementTypeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissementTypes = EtablissementType::all();
        return view('admin.etablissement_types.index', compact('etablissementTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('etablissementTypes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        EtablissementType::create($request->all());

        return redirect()->route('etablissementTypes.index')
            ->with('success', 'Etablissement type created successfully.');
    }

    public function update(Request $request, $id)
{
    $etablissementType = EtablissementType::findOrFail($id);

    $request->validate([
        'name' => 'required',
    ]);

    $etablissementType->update($request->all());

    return redirect()->route('etablissementTypes.index')
        ->with('success', 'Etablissement type updated successfully.');
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $etablissementType = EtablissementType::findOrFail($id);
        return view('etablissementTypes.edit', compact('etablissementType'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etablissementType = EtablissementType::findOrFail($id);
        $etablissementType->delete();

        return redirect()->route('etablissementTypes.index')
            ->with('success', 'Etablissement type deleted successfully.');
    }
}
