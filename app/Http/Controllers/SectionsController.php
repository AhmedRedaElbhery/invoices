<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = sections::all();
        return view("sections/sections", compact("sections"));
    }

    public static function report()
    {
        $sections = sections::all();
        return $sections;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'section_name' => 'unique:sections,section_name',


        ], [
            'section_name.unique' => 'هذا القسم موجود بالفعل',

        ]);

        $data = $request->all();
        sections::create($data);
        return redirect("/sections");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sections $sections)
    {
        $id = $request->id;
        // Validate the input
        $request->validate([
            'section_name' => 'required|unique:sections,section_name,' . $id, // Ignore current record during uniqueness check

        ], [
            'section_name.unique' => 'هذا القسم موجود بالفعل', // Custom error message
        ]);


        $data = $request->all();
        $sections = sections::find($id);

        $sections->update($data);

        return redirect('/sections');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $sections = sections::find($request->id);
        $sections->delete();
        return redirect("/sections");
    }
}
