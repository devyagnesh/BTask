<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function viewLoginPage()
    {
        return view('login');
    }

    public function postLogin(Request $request)
    {
        try {
            $validateRequest = Validator::make($request->all(), [
                "email" => "email|required",
                "password" => "required"
            ]);

            if ($validateRequest->failed()) {
                return redirect()->back()->withErrors($validateRequest);
            }

            $credentials = [
                "email" => $request->input("email"),
                "password" => $request->input("password")
            ];


            if (!Auth::attempt($credentials)) {
                return redirect()->back()->with('error', 'invalid login credentials');
            }

            return redirect()->route('viewDashboard')->with('success', 'Leggin Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
