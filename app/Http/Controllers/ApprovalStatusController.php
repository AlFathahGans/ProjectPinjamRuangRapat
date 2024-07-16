<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApprovalStatus;

class ApprovalStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $getAStatus = ApprovalStatus::all();
        return response()->json(['data' => $getAStatus ]);
    }

}
