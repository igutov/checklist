<?php

namespace App\Http\Controllers;

use App\Lists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userId = Auth::user()->id;
        $lists = DB::table('lists')->where('user_id', '=', $userId)->get();

        return view(
            'checklist.lists.index',
            [
                'lists' => $lists,
            ]
        );
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required||max:50',
        ]);

        $list = new Lists;
        $list->name = $request->input('name');
        $list->user_id = Auth::user()->id;
        $list->save();

        return redirect('list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userId = Auth::user()->id;
        $list = Lists::where('user_id', '=', $userId)->find($id);
        $tasks = DB::table('tasks')->where('lists_id', '=', $list->id)->get();

        return view(
            'checklist.tasks.select',
            [
                'list' => $list,
                'tasks' => $tasks,
            ]
        );

        // return dd($tasks);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function edit(Lists $lists)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lists $lists)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lists  $lists
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $list = Lists::find($id);
        $list->tasks()->delete();
        $list->delete();

        return back()->withInput();
    }
}
