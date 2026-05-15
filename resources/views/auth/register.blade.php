@extends('layouts.app')
@section('title','Register | the sun Agency')
@section('content')
<section class="hero"><div class="container" style="max-width:560px"><div class="card"><h1 style="font-size:2.4rem">Create Account</h1>@if($errors->any())<div class="alert error">{{ $errors->first() }}</div>@endif<form class="form" method="POST" action="{{ route('register.store') }}">@csrf<input class="input" name="name" placeholder="Full name" value="{{ old('name') }}" required><input class="input" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required><input class="input" name="password" type="password" placeholder="Password" required><input class="input" name="password_confirmation" type="password" placeholder="Confirm password" required><button class="btn" type="submit">Register</button><a class="muted" href="{{ route('login') }}">Already registered?</a></form></div></div></section>
@endsection
