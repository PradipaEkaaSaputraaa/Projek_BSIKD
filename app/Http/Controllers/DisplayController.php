<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use App\Models\Runningtext;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    public function index()
    {
        // Ambil poster terbaru (urutan upload terakhir di atas)
        $posters = Poster::whereNotNull('path_poster')->latest()->get();
        
        // Ambil semua data teks berjalan
        $runningTexts = Runningtext::all();

        return view('user.display', compact('posters', 'runningTexts'));
    }
}