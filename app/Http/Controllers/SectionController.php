<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::get();
        return view('admin.sections.index')->with('sections', $sections);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $color = $request->color;
        $section = new Section;
        $section->title_hy = $request->title_hy;
        $section->title_en = $request->title_en;
        $section->title_ru = $request->title_ru;
        $section->color = $color;
        $section->save();
        return redirect(route('sections.index'))->with('message', trans('sections.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        return view('admin.sections.edit')->with('section', $section);
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
        $section = Section::findOrFail($id);
        $section->title_hy = $request->title_hy;
        $section->title_en = $request->title_en;
        $section->title_ru = $request->title_ru;
        $section->color = $request->color;
        $section->save();
        return redirect(route('sections.index'))->with('message', trans('sections.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $section->delete();
        $section->subsection()->delete();
        return redirect(route('sections.index'))->with('message', trans('sections.deleted'));
    }
}
