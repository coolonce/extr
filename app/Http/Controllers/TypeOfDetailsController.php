<?php

namespace App\Http\Controllers;

use App\Models\TypeOfDetails;
use Illuminate\Http\Request;

class TypeOfDetailsController extends Controller
{
    public function get(Request $request)
    {
        return response()->json(["data" => TypeOfDetails::all()]);
    }
}
