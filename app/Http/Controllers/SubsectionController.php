<?php

namespace App\Http\Controllers;

use App\Section;
use App\Subsection;
use Illuminate\Http\Request;

class SubsectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subsections = Subsection::all();
        return view('admin.subsections.index')->with('subsections', $subsections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('admin.subsections.create')->with('sections', $sections);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subsection = new Subsection;
        $subsection->section_id = $request->section_id;
        $subsection->title_en = $request->title_en;
        $subsection->title_ru = $request->title_ru;
        $subsection->title_hy = $request->title_hy;
        $subsection->color = $request->color;
        $subsection->save();
        return redirect()->route('subsections.index')->with('message', trans('subsections.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function show(Subsection $subsection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function edit(Subsection $subsection)
    {
        $sections = Section::all();
        return view('admin.subsections.edit',compact('subsection', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsection $subsection)
    {
        $subsection->title_en = $request->title_en;
        $subsection->title_ru = $request->title_ru;
        $subsection->title_hy = $request->title_hy;
        $subsection->section_id = $request->section_id;
        $subsection->color = $request->color;
        $subsection->save();
        return redirect(route('subsections.index'))->with('message', trans('subsections.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsection $subsection)
    {
        $subsection->delete();
        return redirect(route('subsections.index'))->with('message', trans('subsections.deleted'));
    }
}
