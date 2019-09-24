<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Section;
use App\Subsection;
use App\Video;
use App\Currency;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        $subsections = Subsection::all();
        $currencies = Currency::all();
        return view('admin.videos.create', compact('sections', 'subsections','currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
            'title_hy' => 'string|max:255',
            'title_en' => 'string|max:255',
            'title_ru' => 'string|max:255',
            'section_id' => 'required|exists:sections,id',
            'subsection_id' => 'required|exists:subsections,id',
            'description_en' => 'string',
            'description_hy' => 'string',
            'description_ru' => 'string',
            'start_date' => 'string',
            'end_date' => 'string|nullable',
            ]
        );

        $video = new Video;
        $video->title_hy = $request->title_hy;
        $video->title_en = $request->title_en;
        $video->title_ru = $request->title_ru;
        $video->section_id = $request->section_id;
        $video->subsection_id = $request->subsection_id;
        $video->description_hy = $request->description_hy;
        $video->description_en = $request->description_en;
        $video->description_ru = $request->description_ru;
        $video->price = $request->price;
        $video->currency_id = $request->currency_id;
        $video->start_date = $request->start_date;
        $video->end_date = $request->end_date;
        $video->video = $request->video;
        $video->save();
        return redirect(route('admin.videos.adminIndex'))->with('message', trans('videoupload.success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sections = Section::all();
        $subsections = Subsection::all();
        $video = Video::findOrFail($id);
        $currencies = Currency::all();
        return view('admin.videos.edit', compact('sections', 'subsections', 'video', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $video = Video::findOrFail($id);
        $video->start_date = $request->start_date;
        $video->end_date = $request->end_date;
        $video->currency_id = $request->currency_id;
        $video->price = $request->price;
        $video->title_hy = $request->title_hy;
        $video->title_en = $request->title_en;
        $video->title_ru = $request->title_ru;
        $video->description_hy = $request->description_hy;
        $video->description_en = $request->description_en;
        $video->description_ru = $request->description_ru;
        $video->video = $request->video;
        $video->save();
        return redirect(route('admin.videos.adminIndex'))->with('message', trans('videoupload.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video  = Video::findOrFail($id);
        $video->delete();
        return redirect(route('admin.videos.adminIndex'))->with('message', trans('videoupload.deleted'));
    }

    public function AdminVideos()
    {
        $videos = Video::paginate(10);
        return view('admin.videos.index')->with('videos', $videos);
    }

    public function getVideos(Request $request)
    {
        $section_id = $request->section;
        $subsection_id = $request->subsection;
        if($subsection_id == '0'){
          $videos = Video::where('section_id', $section_id)->orderBy('start_date', 'asc')->get();
        }else{
          $videos = Video::where('section_id', $section_id)->where('subsection_id', $subsection_id)->orderBy('start_date', 'asc')->get();
        }
        return response()->json($videos);
    }

    public function getVideo(Request $request)
    {
        $id = $request->id;
        $video = Video::where('id', $id)->first();
        return response()->json($video);
    }
}
