@extends('layouts.app')

@section('title', 'Services | the sun Agency')

@section('content')
<section class="hero"><div class="container"><span class="badge">Our Services</span><h1>Transform your <span class="grad">digital ecosystem</span></h1><p class="lead">Laravel-powered services, content-managed from admin, designed for real business operations.</p></div></section>
<section class="section"><div class="container"><div class="grid">@forelse($services as $service)<div class="card"><div style="font-size:3rem">{{ $service->icon }}</div><h3>{{ $service->title }}</h3><p class="muted">{{ $service->description }}</p></div>@empty<div class="card"><h3>No active services</h3><p class="muted">Admin can add services.</p></div>@endforelse</div></div></section>
@endsection
