<?php

namespace App\Http\Controllers;

use App\Models\Extractor;
use Illuminate\Http\Request;

class ExtractorController extends Controller
{
    public function get(Request $request)
    {
        return response()->json(["data" => Extractor::all()]);
    }
}
