<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CompanyController extends Controller
{

    public function viewAddCompanyPage(){
        return view('addCompany');
    }

    public function viewEditCompanyPage($id){
        if(!$id){
            return redirect()->back()->with('error','company not found with given id');
        }

        $company = Company::find($id);
        return view('EditCompany',compact('company'));
    }

   

    public function postCreateCompany(Request $request)
    {
        try {
            $validateRequest = Validator::make($request->all(), [
                "logo" => 'required|file|mimes:png,jpg,jpeg',
                "name" => 'required',
                "email" => 'required|email',
                "website" => 'required|url'
            ]);

            if ($validateRequest->fails()) {
                return redirect()->back()->withErrors($validateRequest);
            }

            /**
             * upload company logo
             */
            $logoFile = $request->file('logo');
            $path = Str::random(20) . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->move(public_path('logo/'), $path);
    

            $company = Company::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'logo' => $path,
                'weburl' => $request->input('website')
            ]);

            $company->save();

            return redirect()->back()->with('success','company created !');
        } catch (Exception $e) {
           
            return redirect()->back()->with('error', 'something went wrong while creating company' . $e->getMessage());
        }
    }


    public function postEditCompany(Request $request, ){
        try {
            if(!$request->id){
                return redirect()->back()->with('error','company not found with given id');
            }

            $company = Company::find($request->id);
            $oldPath = $company->logo;
            $validateRequest = Validator::make($request->all(), [
                "logo" => 'file|mimes:png,jpg,jpeg',
                "name" => 'string',
                "email" => 'email',
                "website" => 'url'
            ]);

            if ($validateRequest->fails()) {
                return redirect()->back()->withErrors($validateRequest);
            }

    
            if($request->hasFile('logo')){
                
               try {
                $logoFile = $request->file('logo');
                $path = Str::random(20) . '.' . $logoFile->getClientOriginalExtension();
                $logoFile->move(public_path('logo/'), $path);
                $company->logo = $path;
                Storage::delete(public_path('logo/'.$oldPath));
               } catch (Exception $e) {
                Storage::delete(public_path('logo/'.$path));
               }

            }
            $company->name = $request->input('name');
            $company->email = $request->input('email');
            $company->weburl = $request->input('website');
            $company->save();
            return redirect()->back()->with('success','company edited !');
        } catch (Exception $e) {
           
            return redirect()->back()->with('error', 'something went wrong while editing company' . $e->getMessage());
        }
    }
   
}
