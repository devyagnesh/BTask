<?php

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth.session')->group(function () {
    Route::get('/company/{id}', function ($id) {
       
        if (!$id) {
            return response()->json(["error" => " couldn't find given id"], 404);
        }

        $company = Company::find($id);

        if ($company) {
            $company->delete();
            return response()->json(["error" => "company deleted"], 200);
        }
        return response()->json(["error" => " couldn't find given id"], 404);
    });

    Route::get('/company', function () {
        $dbCompany = Company::all();
        $companies = [];

        foreach ($dbCompany as $key => $company) {
            $company->logo = asset('logo/' . $company->logo);
            array_push($companies, $company);
        }

        return response()->json($companies);
    });
});
