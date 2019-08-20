<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;

class RecordsController extends Controller
{

    public function showCreateForm(){
        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $today = $year . '-' . $month . '-' . $day;
        return view('create-records', compact('today'));
    }
    
}
