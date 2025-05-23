<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (!Auth::check()) {
        //     return redirect()->route('home')->with([
        //         'status' => 0,
        //         'message' => 'Please login to access this page.',
        //     ]);
        // }
        $events = Event::all();
        return view('admin.dashboard', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $events = new Event();
            $events->event_name = strtolower($request['name']);
            $events->venue = $request['venue'];
            $events->capacity = $request['capacity'];
            $events->ticket_price = $request['ticket_price'];
            $events->description = $request['decription'];
            $events->contact_info = $request['contact_info'];
            $events->start_date = $request['start_date'];
            $events->end_date = $request['end_date'];
            $events->category = $request['category'];
            $events->status = $request['status'];
            $events->organizer = $request['organizer'];
            $events->image_url = $request['image_url'];
            $events->tickets_sold = $request['tickets_sold'];
            $events->currency = $request['currency'];
            $events->created_by = Auth::id();
            $events->updated_by = Auth::id();
            $events->save();

            DB::commit();

            return response()->json([
                'status' => 1,
                'message' => 'Event created successfully',
            ]);

        } catch (\Exception $e) {

            DB::rollBack();
            Log::error('Event creation failed: ' . $e->getMessage());

            return redirect()->route('home')->with([
                'status' => 0,
                'message' => 'Error Occured! Please try again',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
