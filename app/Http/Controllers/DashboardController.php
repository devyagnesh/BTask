<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function viewDashboardPage(){
       
        return view('dashboard');
    }

   
}
