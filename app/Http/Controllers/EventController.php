<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->has('image'){
      $imageName = time().'.'.$request->image->getClientOriginalExtension();
      $path = Storage::putFileAs('public/event_images/', new File($request->image), $imageName);  
      }else{
       $imageName = null; 
      }
      
      $event = new Event;
      $event->title = $request->title;
      $event->description = $request->description;
      $event->start = $request->start_date;
      $event->end = $request->end_date;
      $event->location = $request->location;
      $event->image = $imageName;
      $event->save();
      return Redirect::route('events.index')->with('message', trans('events.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('events.edit')->with('event', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->title = $request->title;
        $event->start = $request->start_date;
        $event->end = $request->end_date;
        $event->location = $request->location;
        if($request->has('image')){
          Storage::delete('public/event_images/' . $event->image);
          $imageName = time().'.'.$request->image->getClientOriginalExtension();
          $path = Storage::putFileAs('public/event_images/', new File($request->image), $imageName);
          $event->image = $imageName;
        }
        $event->save();
        return Redirect::route('events.list')->with('message', trans('events.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        Storage::delete('public/event_images/' . $event->image);
        $event->delete();
        return Redirect::route('events.list')->with('message', trans('events.deleted'));
    }

    public function imageUpload(Request $request)
    {
        $imageName = time().'.'.$request->upload->getClientOriginalExtension();
        $path = Storage::putFileAs('public/event_images', new File($request->upload), $imageName);
        $exp = explode('/', $path);
        unset($exp[0]);
        $realpath = implode('/', $exp);
        $data = [
          "url" => route('home').'//storage/' .$realpath,
        ];
        return response()->json($data, 200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

    public function getAll(){
      $events = Event::all();
      return response()->json($events, 200, [], JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT);
    }

    public function lists(){
      $events = Event::paginate(20);
      return view('events.list')->with('events', $events);
    }
}
