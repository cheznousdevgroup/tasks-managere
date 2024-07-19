<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use Illuminate\Console\View\Components\Task;

class TasksController extends Controller
{
    //
    public function index()
    {
        $Tasks= Tasks::all();
        $tasksByStatus = Tasks::select('status', Tasks::raw('count(*) as count'))
                        ->groupBy('status')
                        ->get();
        return view('pages.index', compact('Tasks','tasksByStatus'));
    }
    public function create(){
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        // dd($request); // Décommentez cette ligne pour le débogage si nécessaire
        $data['status'] = $request->status == "one" ? 1 : 0;
        Tasks::create($data);

        return redirect()->route('index')->with('success', 'Tâche enregistrée avec succès');
    }

    public function edit($id){
        $task = Tasks::where('id', $id)->firstOr();
        return View('pages.create', compact('task'));
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $task = Tasks::where('id', $id)->firstOr();

        $task->update($data);
        return redirect()->route('index')->with('success', 'Tâche Modifiée avec succès');
    }

    public function destroy($id){
        Tasks::where('id', $id)->delete();
        return redirect()->route('index')->with('success', 'Tâche Supprimé avec succès');
    }
}
