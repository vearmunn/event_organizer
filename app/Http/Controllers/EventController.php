<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Category;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $events = Event::latest()->get();
    return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
         return view('events.create', compact('categories'));
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
        'title' => 'required',
        'location' => 'required',
        'date' => 'required|date',
        'image' => 'nullable|image',
    ]);

     $path = null;

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('events', 'public');
    }

    Event::create([
        'title' => $request->title,
        'description' => $request->description,
        'location' => $request->location,
        'date' => $request->date,
        'organizer_id' => auth()->id(),
        'image' => $path,
        'category_id' => $request->category_id,
    ]);

    return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
       if ($event->organizer_id !== auth()->id()) {
        abort(403);
    }

     $categories = Category::all();

    return view('events.edit', compact('event', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
         if ($event->organizer_id !== auth()->id()) {
        abort(403);
    }
 $request->validate([
        'title' => 'required',
        'location' => 'required',
        'date' => 'required|date',
        'image' => 'nullable|image',
    ]);

    $data = [
        'title' => $request->title,
        'description' => $request->description,
        'location' => $request->location,
        'date' => $request->date,
         'category_id' => $request->category_id,

    ];

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('events', 'public');
    }

    $event->update($data);
 return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if ($event->organizer_id !== auth()->id()) {
        abort(403);
    }

    $event->delete();

    return redirect()->route('dashboard');
    }

    public function myEvents()
{
    $events = Event::where('organizer_id', auth()->id())
                ->latest()
                ->get();

    return view('events.my-events', compact('events'));
}
}