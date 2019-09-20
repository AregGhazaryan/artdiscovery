<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Section;
use App\Video;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = Section::all();
        return view('admin.videos.create')->with('sections', $sections);
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
            'description_en' => 'string',
            'description_hy' => 'string',
            'description_ru' => 'string',
            'date' => 'string',
            ]
        );

        $video = new Video;
        $explodedDate = explode('-', $request->date);
        if(empty($explodedDate[1])) {
            $end_date = null;
        }else{
            $end_date = $explodedDate[1];
        }
        $start_date = $explodedDate[0];
        $video->title_hy = $request->title_hy;
        $video->title_en = $request->title_en;
        $video->title_ru = $request->title_ru;
        $video->section_id = $request->section_id;
        $video->description_hy = $request->description_hy;
        $video->description_en = $request->description_en;
        $video->description_ru = $request->description_ru;
        $video->start_date = $start_date;
        $video->end_date = $end_date;
        $file = $request->file('video');
        $fileName = $file->getClientOriginalName();
        $storagePath = Storage::put('public/videos', $file);
        $explode = explode("/", $storagePath);
        $actualFileName = end($explode);
        $video->video = $actualFileName;
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
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('sections', 'video'));
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
        $video->title_hy = $request->title_hy;
        $video->title_en = $request->title_en;
        $video->title_ru = $request->title_ru;
        $video->description_hy = $request->description_hy;
        $video->description_en = $request->description_en;
        $video->description_ru = $request->description_ru;
        $video->date = $request->date;
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
        Storage::delete('public/videos/' . $video->video);
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
        $id = $request->id;
        $subsection_id = $request->subsection;
        $videos = Video::where('section_id', $id)->with('subsection_id', $subsection_id)->get();
        return response()->json($videos);
    }

    public function getVideo(Request $request)
    {
        $id = $request->id;
        $video = Video::where('id', $id)->first();
        return response()->json($video);
    }
}
