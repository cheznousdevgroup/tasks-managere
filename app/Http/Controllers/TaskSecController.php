<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Http\Requests\TasksRequest;

class TaskSecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.index',['Tasks' => Tasks::all()],['tasksByStatus' => Tasks::select('status', Tasks::raw('count(*) as count'))
        ->groupBy('status')
        ->get()] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TasksRequest $request)
    {
        $data = $request->validated($request->all());
        $data['status'] = $request->status == "one" ? 1 : 0;
        Tasks::create($data);

        return redirect()->route('index')->with('success', 'Tâche enregistrée avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $task)
    {
        
        return View('pages.create', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TasksRequest $request, Tasks $task)
    {
        $data = $request->validated($request->all());

        $task->update($data);
        return redirect()->route('index')->with('success', 'Tâche Modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $task)
    {
        $task->delete();
        return redirect()->route('index')->with('success', 'Tâche Supprimé avec succès');
    }
}
