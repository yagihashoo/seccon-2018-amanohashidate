<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function index()
    {
        return view('upload');
    }
}
