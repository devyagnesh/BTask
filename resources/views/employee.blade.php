@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <main class="container h-100 d-flex flex-direction-column gap-2 justify-content-center align-items-center">
        <div class="d-flex gap-2">
            <a href="{{ route('viewAddCompanyPage') }}" class="button btn-success" style="width:20rem;text-align:center;">Add
                Company</a>
            <a href="{{ route('viewAddEmployeePage') }}" class="button btn-success" style="width:20rem;text-align:center;">Add
                Employee</a>
        </div>
        <table class="list">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Company</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->firstname }}</td>
                        <td>{{ $employee->lastname }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->number }}</td>
                        <td>{{ $employee->companies->name }}</td>
                        <td class="d-flex gap-2">
                            <a href="/employee/edit/{{$employee->id}}" class="button btn-warning">Edit</a>
                            <a href="/employee/delete/{{$employee->id}}" class="button btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>

@endsection
