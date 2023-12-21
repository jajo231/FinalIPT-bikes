<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index() {
        $logs = Log::orderBy('created_at','desc')->get();
        return view('Logs.index', ['logs' => $logs]);
    }
}
