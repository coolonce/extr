<?php

namespace App\Http\Controllers;

use App\Models\Extragent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExtragentController extends Controller
{
    public function get(Request $request)
    {
        return response()->json(["data" => Extragent::all()]);
    }
}
