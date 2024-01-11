@extends('layouts.app')
@section('title','Admin Login')
@section('content')
    <main class="container h-100 d-flex justify-content-center align-items-center">
            <form action="{{route('postLogin')}}" method="POST" autocomplete="off" class="authForm">
                @csrf
                <h2 class="authForm__title">
                    signin
                </h2>
                @if(Session('error'))
                    <div class="alert alert_danger mt-2">{{Session('error')}}</div>
                @endif
                <div class="authForm__wrapper mt-2">
                    <input type="email" name="email" id="email" class="authForm__wrapper_controller" placeholder="Email address"/>
                </div>

                <div class="authForm__wrapper mt-2">
                    <input type="password" name="password" id="password" class="authForm__wrapper_controller" placeholder="Login Password"/>
                </div>
                <div class="authForm__wrapper mt-2">
                    <button type="submit" class="btn-primary">Signin</button>
                </div>
            </form>
    </main>
@endsection