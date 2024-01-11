@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('content')
    <main class="container h-100 d-flex flex-direction-column gap-2 justify-content-center align-items-center">
        <form action="{{ route('postCreateCompany') }}" method="POST" autocomplete="off" class="authForm"
            enctype="multipart/form-data">
            @csrf
            <h2 class="authForm__title">
                Add Company
            </h2>
            @if (Session('error'))
                <div class="alert alert_danger mt-2">{{ Session('error') }}</div>
            @elseif ($errors->any())
                <div class="alert alert_danger mt-2">{{ $errors->first() }}</div>
            @elseif (Session('success'))
                <div class="alert alert_success mt-2">{{ Session('success') }}</div>
            @endif

            <div class="authForm__wrapper mt-2">
                <label for="logo" class="authForm__wrapper_avatar">
                    <input type="file" name="logo" id="logo" accept=".jpg,.png,.jpeg" />
                </label>
            </div>

            <div class="authForm__wrapper mt-2">
                <input type="text" name="name" id="name" class="authForm__wrapper_controller"
                    placeholder="Company name..." />
            </div>

            <div class="authForm__wrapper mt-2">
                <input type="email" name="email" id="email" class="authForm__wrapper_controller"
                    placeholder="Email address..." />
            </div>

            <div class="authForm__wrapper mt-2">
                <input type="text" name="website" id="website" class="authForm__wrapper_controller"
                    placeholder="Website..." />
            </div>
            <div class="authForm__wrapper mt-2">
                <button type="submit" class="btn-primary">Create Company</button>
            </div>
        </form>
    </main>
@endsection
