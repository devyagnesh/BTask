<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function viewAddEmployeePage()
    {
        $companies = Company::all();
        return view('addEmployee',compact('companies'));
    }

    public function viewEditEmployeePage($id)
    {
        $companies = Company::all();
        $employee = Employee::find($id);
        return view('editEmployee',compact('companies','employee'));
    }

    public function viewEmployeePage($id){
        $employees = Employee::with('companies')->where('cid', $id)->get();
        return view('employee',compact('employees'));
    }

    public function postAddEmployee(Request $request){
        try {
             $validateRequest = Validator::make($request->all(),[
                "firstname"=>"required",
                "lastname"=>"required",
                "email"=>"required|email",
                "phone"=>"required",
                "company"=>"required"
            ]);

            if ($validateRequest->fails()) {
                return redirect()->back()->withErrors($validateRequest);
            }

            $employee = Employee::create([
                "firstname"=>$request->input("firstname"),
                "lastname"=>$request->input("lastname"),
                "email"=>$request->input("email"),
                "number"=>$request->input("phone"),
                "cid"=>$request->input("company")
            ]);

            $employee->save();
            return redirect()->back()->with('success','employee added !');
        } catch (Exception $e) {
           return redirect()->back()->with('error','something went wrong while adding employee');
        }
    }


    public function postEditEmployee(Request $request){
        try {
            if(!$request->id){
                return redirect()->back()->with('error','employee not found with given id');
            }
             $validateRequest = Validator::make($request->all(),[
                "firstname"=>"required",
                "lastname"=>"required",
                "email"=>"required|email",
                "phone"=>"required",
                "company"=>"required"
            ]);

            if ($validateRequest->fails()) {
                return redirect()->back()->withErrors($validateRequest);
            }

            $employee = Employee::find($request->id);
            $employee->firstname=$request->input("firstname");
            $employee->lastname=$request->input("lastname");
            $employee->email=$request->input("email");
            $employee->number=$request->input("phone");
            $employee->cid=$request->input("company");
            $employee->save();
            return redirect()->back()->with('success','employee edited !');
        } catch (Exception $e) {
           return redirect()->back()->with('error','something went wrong while editing employee');
        }
    }

    public function deleteEmployee($id){
        if(!$id){
            return redirect()->back()->with('error','employee not found with given id');
        }
        $employee = Employee::find($id);

        if(!$employee){
            return redirect()->back()->with('error','employee not found with given id');
        }

        $employee->delete();
        return redirect()->back()->with('success','employee deleted !');
    }
}
