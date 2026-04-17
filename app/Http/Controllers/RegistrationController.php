<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Models\Event;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = Registration::with('event')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('registrations.index', compact('registrations'));
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
    public function store(Event $event)
    {
         $userId = auth()->id();

    // Cannot join own event
    if ($event->organizer_id == $userId) {
        return redirect()->back()
            ->with('error', 'You cannot join your own event.');
    }

    // Prevent duplicate join
    $exists = Registration::where('user_id', $userId)
        ->where('event_id', $event->id)
        ->exists();

    if ($exists) {
        return redirect()->back()
            ->with('error', 'You already joined this event.');
    }

    Registration::create([
        'user_id' => $userId,
        'event_id' => $event->id,
    ]);

    return redirect()->back()
        ->with('success', 'Joined successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Registration $registration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
{
    Registration::where('user_id', auth()->id())
        ->where('event_id', $event->id)
        ->delete();

    return redirect()->back()
        ->with('success', 'Participation cancelled.');
}
}