@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <main class="container h-100 d-flex flex-direction-column gap-2 justify-content-center align-items-center">
        <form action="{{ route('postEditEmployee') }}" method="POST" autocomplete="off" class="authForm"
            enctype="multipart/form-data">
            @csrf
            <h2 class="authForm__title">
                Edit Employee
            </h2>
            @if (Session('error'))
                <div class="alert alert_danger mt-2">{{ Session('error') }}</div>
            @elseif ($errors->any())
                <div class="alert alert_danger mt-2">{{ $errors->first() }}</div>
            @elseif (Session('success'))
                <div class="alert alert_success mt-2">{{ Session('success') }}</div>
            @endif

            <input type="hidden" name="id" id="id" value="{{$employee->id}}" />

            <div class="authForm__wrapper mt-2">
                <input type="text" name="firstname" id="firstname" class="authForm__wrapper_controller"
                    placeholder="firstname" value="{{$employee->firstname}}"/>
            </div>

            <div class="authForm__wrapper mt-2">
                <input type="text" name="lastname" id="lastname" class="authForm__wrapper_controller"
                    placeholder="lastname" value="{{$employee->lastname}}"/>
            </div>

            <div class="authForm__wrapper mt-2">
                <input type="email" name="email" id="email" class="authForm__wrapper_controller"
                    placeholder="Email address..." value="{{$employee->email}}"/>
            </div>

            <div class="authForm__wrapper mt-2">
                <input type="text" name="phone" id="phone" class="authForm__wrapper_controller"
                    placeholder="phone..." value="{{$employee->number}}"/>
            </div>

            <div class="authForm__wrapper mt-2">
                <select name="company">
                    <option value="" default>Select Company</option>
                    @foreach ($companies as $company)
                        <option value="{{$company->id}}" {{$company->id === $employee->cid ? "selected" : null}}>{{$company->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="authForm__wrapper mt-2">
                <button type="submit" class="btn-primary">Edit Employee</button>
            </div>
        </form>
    </main>
@endsection
