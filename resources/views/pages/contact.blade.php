@extends('layouts.app')

@section('title', 'Contact | the sun Agency')

@section('content')
<section class="hero"><div class="container"><span class="badge">Contact</span><h1>Let’s build something <span class="grad">exceptional</span></h1><p class="lead">Send a message. It will be saved directly in MySQL and visible in admin dashboard.</p></div></section>
<section class="section"><div class="container" style="max-width:780px">@if(session('success'))<div class="alert success">{{ session('success') }}</div>@endif @if($errors->any())<div class="alert error">{{ $errors->first() }}</div>@endif<form class="card form" method="POST" action="{{ route('contact.store') }}">@csrf<input class="input" name="name" placeholder="Jina lako" value="{{ old('name') }}" required><input class="input" name="email" type="email" placeholder="Email" value="{{ old('email') }}" required><input class="input" name="phone" placeholder="Simu / WhatsApp" value="{{ old('phone') }}"><textarea name="message" placeholder="Ujumbe wako" required>{{ old('message') }}</textarea><button class="btn" type="submit">Tuma Ujumbe</button></form></div></section>
@endsection
