<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\Runningtext;
use App\Models\Agenda; // Import Model Agenda
use App\Models\Note;   // Import Model Note
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function index()
    {
        // Ambil poster yang memiliki file DAN status is_active = true
        $posters = Poster::whereNotNull('path_poster')
            ->where('is_active', true)
            ->latest()
            ->get();

        // Ambil running text (asumsi running text tidak pakai toggle is_active)
        $runningTexts = Runningtext::all();
        
        // Ambil agenda yang status is_active = true
        $agendas = Agenda::where('is_active', true)
            ->latest()
            ->get(); 

        // Ambil notes yang status is_active = true
        $notes = Note::where('is_active', true)
            ->latest()
            ->get();
            
        $posters = Poster::whereNotNull('path_poster')
            ->where('is_active', true) // Filter ini yang paling penting
            ->latest()
            ->get();

        return view('user.display', compact('posters', 'runningTexts', 'agendas', 'notes'));
    }
}