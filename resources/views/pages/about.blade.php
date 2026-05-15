@extends('layouts.app')

@section('title', 'About Us | the sun Agency')

@section('content')
<section class="hero"><div class="container"><span class="badge">About Us</span><h1>{{ $about->hero_title ?? 'Building Digital Excellence Since Day One' }}</h1><p class="lead">{{ $about->hero_description ?? 'We are a team of passionate creators, developers, and strategists dedicated to transforming your digital presence.' }}</p></div></section>
<section class="section"><div class="container"><div class="grid"><div class="card"><h2>{{ $about->story_title ?? 'Our Journey' }}</h2><p class="muted">{{ $about->story_description ?? 'Founded with a vision to revolutionize digital experiences, the sun Agency delivers modern digital solutions.' }}</p></div><div class="card"><h2 class="grad">{{ $about->projects_count ?? 500 }}+</h2><p>Projects</p><h2 class="grad">{{ $about->clients_count ?? 150 }}+</h2><p>Clients</p><h2 class="grad">{{ $about->years_count ?? 10 }}+</h2><p>Years</p></div></div></div></section>
<section class="section"><div class="container"><h2>Core Values</h2><div class="grid">@for($i=1;$i<=6;$i++)<div class="card"><h3>{{ $about->{'value'.$i.'_title'} ?? ['Innovation','Passion','Integrity','Collaboration','Excellence','Growth'][$i-1] }}</h3><p class="muted">{{ $about->{'value'.$i.'_description'} ?? 'Professional value that guides every decision.' }}</p></div>@endfor</div></div></section>
@endsection
