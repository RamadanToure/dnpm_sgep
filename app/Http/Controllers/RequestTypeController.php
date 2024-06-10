<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestType;

class RequestTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestTypes = RequestType::all();
        return view('admin.request_types.index', compact('requestTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.request_types.create');
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
            'name' => 'required|unique:request_types|max:255',
        ]);

        RequestType::create($request->all());

        return redirect()->route('request_types.index')
            ->with('success', 'Request Type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requestType = RequestType::findOrFail($id);
        return view('admin.request_types.show', compact('requestType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requestType = RequestType::findOrFail($id);
        return view('admin.request_types.edit', compact('requestType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestType = RequestType::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:request_types|max:255',
        ]);

        $requestType->update($request->all());

        return redirect()->route('request_types.index')
            ->with('success', 'Request Type updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $requestType = RequestType::findOrFail($id);
        $requestType->delete();

        return redirect()->route('request_types.index')
            ->with('success', 'Request Type deleted successfully');
    }
}
