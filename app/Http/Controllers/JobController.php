<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $jobs = Job::orderBy('created_at','DESC')->get();
        return response()->json($jobs);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $item = new Job;
        $item->name = $request->job['name'];
        $item->save();
        return $item;


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobs = Job::find($id);
        return response()->json($jobs);
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
        $jobfind = Job::find($id);
        if($jobfind){
            $jobfind->completed = $request->job['completed'] ? true : false;
            $jobfind->completed_at = $request->job['completed'] ? Carbon::now() : null;
            $jobfind->save();
            return response()->json($jobfind,'Job updated');
        }
        return "Job not found";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobfind = Job::find($id);
        if($jobfind){
            $jobfind->delete();
            return response()->json($jobfind,'Job deleted successfully');
        }
        return "Job not found";
    }
}
