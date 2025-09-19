<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChirpController extends Controller
{
    public function index()
    {
        $chirps = [
            ['author' => 'Alice', 'message' => 'Hello, world!', 'time' => '5 minutes ago'],
            ['author' => 'Bob', 'message' => 'Laravel is awesome!', 'time' => '1 hour ago'],
            ['author' => 'Charlie', 'message' => 'Just setting up my chirper.', 'time' => '3 hours ago'],
        ]; // Fetch chirps from the database or any data source
        return view('home', ['chirps' => $chirps]);
    }
}
