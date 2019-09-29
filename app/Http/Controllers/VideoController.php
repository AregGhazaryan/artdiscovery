<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\File;
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
        return view('admin.videos.create', compact('sections', 'subsections', 'currencies'));
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
        $dateOne = explode('-', $request->start_date);
        if(!array_key_exists(1, $dateOne)) {
            $dateOne[1] = '01';
        }
        if(!array_key_exists(2, $dateOne)) {
            $dateOne[2] = '01';
        }
        $start_date = implode('-', $dateOne);
        $dateTwo = explode('-', $request->end_date);
        if(!array_key_exists(1, $dateTwo)) {
            $dateTwo[1] = '01';
        }
        if(!array_key_exists(2, $dateTwo)) {
            $dateTwo[2] = '01';
        }
        $end_date = implode('-', $dateTwo);

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
        $video->start_date = $start_date;
        $video->end_date = $end_date;
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
        $videos = Video::paginate(20);
        return view('admin.videos.index')->with('videos', $videos);
    }

    public function getVideos(Request $request)
    {
        $section_id = $request->section;
        $subsection_id = $request->subsection;
        if($subsection_id == '0') {
            $videos = Video::with('currency')->where('section_id', $section_id)->orderBy('start_date', 'asc')->get();
        }else{
            $videos = Video::with('currency')->where('section_id', $section_id)->where('subsection_id', $subsection_id)->orderBy('start_date', 'asc')->get();
        }
        return response()->json($videos);
    }

    public function getVideo(Request $request)
    {
        $id = $request->id;
        $video = Video::where('id', $id)->first();
        return response()->json($video);
    }

    public function imageUpload(Request $request)
    {
        $request->validate(['upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
        $imageName = time().'.'.$request->upload->getClientOriginalExtension();
        $path = Storage::putFileAs('public/video_images', new File($request->upload), $imageName);
        // $path = Storage::putFile('public/video_images', $request->upload);
        $exp = explode('/',$path);
        unset($exp[0]);
        $realpath = implode('/',$exp);
        // $data = [
        //   "url" => route('home').'//storage/' .$realpath,
        // ];
        $data = [
          'resourceType' => 'Files',
          'currentFolder'  => [
            'path' => '/storage/video_images',
            'url' => '/uploadImg',
            'acl' => 255
          ],
          'fileName' => $imageName,
          'uploaded' => 1,
        ];

        return response()->json($data, 200,[], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
        // return response()->json(route('home').'/storage/'.$realpath, 200);
    }
}
