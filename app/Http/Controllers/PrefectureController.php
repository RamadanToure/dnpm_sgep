<?php

namespace App\Http\Controllers;

use App\Models\Prefecture;
use App\Models\Region;
use Illuminate\Http\Request;

class PrefectureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        $prefectures = Prefecture::all();
        return view('admin.prefectures.index', compact('prefectures', 'regions'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.prefectures.create');
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
            'name' => 'required|unique:prefectures|max:255',
        ]);

        Prefecture::create($request->all());

        return redirect()->route('prefectures.index')
            ->with('success', 'Prefecture created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prefecture  $prefecture
     * @return \Illuminate\Http\Response
     */
    public function show(Prefecture $prefecture)
    {
        return view('admin.prefectures.show', compact('prefecture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prefecture  $prefecture
     * @return \Illuminate\Http\Response
     */
    public function edit(Prefecture $prefecture)
    {
        return view('admin.prefectures.edit', compact('prefecture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prefecture  $prefecture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prefecture $prefecture)
    {
        $request->validate([
            'name' => 'required|unique:prefectures,name,' . $prefecture->id . '|max:255',
        ]);

        $prefecture->update($request->all());

        return redirect()->route('prefectures.index')
            ->with('success', 'Prefecture updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prefecture  $prefecture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prefecture $prefecture)
    {
        $prefecture->delete();

        return redirect()->route('prefectures.index')
            ->with('success', 'Prefecture deleted successfully');
    }
}
