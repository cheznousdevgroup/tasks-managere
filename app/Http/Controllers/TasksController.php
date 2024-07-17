<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    //
    public function index()
    {
        return view('pages.index');
    }
    public function create(){
        return view('pages.create');
    }
}
