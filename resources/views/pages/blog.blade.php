@extends('layouts.app')

@section('title', 'Blog | the sun Agency')

@section('content')
<section class="hero"><div class="container"><span class="badge">Insights</span><h1>Digital <span class="grad">thinking</span> and innovation</h1><p class="lead">Content is managed from MySQL and controlled by the Laravel admin panel.</p></div></section>
@if($featured)<section class="section"><div class="container"><article class="card"><span class="badge">Featured · {{ $featured->category }}</span><h2>{{ $featured->title }}</h2><p class="muted">{{ $featured->content }}</p><p class="muted">By {{ $featured->author }} · {{ $featured->published_at->format('M d, Y') }}</p></article></div></section>@endif
<section class="section"><div class="container"><div class="grid">@foreach($blogs as $blog)<article class="card"><span class="badge">{{ $blog->category }}</span><h3>{{ $blog->title }}</h3><p class="muted">{{ str($blog->content)->limit(180) }}</p><p class="muted">{{ $blog->published_at->format('M d, Y') }}</p></article>@endforeach</div><div style="margin-top:24px">{{ $blogs->links() }}</div></div></section>
@endsection
