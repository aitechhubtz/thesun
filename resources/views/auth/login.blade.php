@extends('layouts.app')
@section('title','Login | the sun Agency')
@section('content')
<section class="hero"><div class="container" style="max-width:520px"><div class="card"><h1 style="font-size:2.4rem">Admin / User Login</h1><p class="muted" style="margin-bottom:18px">Use seeded admin account after migration.</p>@if($errors->any())<div class="alert error">{{ $errors->first() }}</div>@endif<form class="form" method="POST" action="{{ route('login.store') }}">@csrf<input class="input" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required><input class="input" name="password" type="password" placeholder="Password" required><label class="muted"><input type="checkbox" name="remember" value="1"> Remember me</label><button class="btn" type="submit">Login</button><a class="muted" href="{{ route('register') }}">Create account</a></form></div></div></section>
@endsection
