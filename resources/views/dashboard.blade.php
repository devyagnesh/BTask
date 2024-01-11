@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <main class="container h-100 d-flex flex-direction-column gap-2 justify-content-center align-items-center">
        <div class="d-flex gap-2">
            <a href="{{route('viewAddCompanyPage')}}" class="button btn-success" style="width:20rem;text-align:center;">Add Company</a>
            <a href="{{route('viewAddEmployeePage')}}" class="button btn-success" style="width:20rem;text-align:center;">Add Employee</a>
        </div>
        <table class="list">
            <thead>
                <tr>
                    <th>ID</th>


                    <th>Logo</th>

                    <th>NAME</th>

                    <th>Email</th>

                    <th>Website</th>


                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="companyData">
            </tbody>
        </table>
    </main>
   
@endsection
