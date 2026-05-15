@extends('layouts.app')

@section('title', 'the sun Agency | Digital Excellence')

@section('content')
<section class="hero">
    <div class="container">
        <span class="badge">Digital Gravity Inspired Experience</span>
        <h1>Build a powerful <span class="grad">digital presence</span> with backend intelligence.</h1>
        <p class="lead">the sun Agency combines modern UI, Laravel backend, MySQL data, admin workflows, and scalable business logic for professional digital services.</p>
        <div style="margin-top:28px;display:flex;gap:14px;flex-wrap:wrap">
            <a href="{{ route('services') }}" class="btn">Explore Services</a>
            <a href="{{ route('contact') }}" class="btn ghost">Talk to us</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Featured Services</h2>
        <p class="lead" style="margin-bottom:28px">Solutions managed from the Laravel admin dashboard.</p>
        <div class="grid">
            @forelse($services as $service)
                <div class="card"><div style="font-size:2.5rem">{{ $service->icon }}</div><h3>{{ $service->title }}</h3><p class="muted">{{ $service->description }}</p></div>
            @empty
                <div class="card"><h3>No services yet</h3><p class="muted">Seed database or add services from admin.</p></div>
            @endforelse
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <h2>Latest Insights</h2>
        <div class="grid">
            @foreach($blogs as $blog)
                <article class="card"><span class="badge">{{ $blog->category }}</span><h3>{{ $blog->title }}</h3><p class="muted">{{ str($blog->content)->limit(130) }}</p></article>
            @endforeach
        </div>
    </div>
</section>
@endsection
