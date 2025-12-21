<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\Runningtext;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function index()
{
    $posters = Poster::whereNotNull('path_poster')->latest()->get();
    $runningTexts = Runningtext::all();
    
    // Pastikan Nama Model (Agenda & Note) sesuai dengan file di app/Models
    $agendas = \App\Models\Agenda::latest()->take(4)->get(); 
    $notes = \App\Models\Note::latest()->take(2)->get();   

    return view('user.display', compact('posters', 'runningTexts', 'agendas', 'notes'));
}

}

