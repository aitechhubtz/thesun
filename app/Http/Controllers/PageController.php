<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        $services = Service::query()->where('is_active', true)->orderBy('order')->take(6)->get();
        $blogs = Blog::query()->where('is_active', true)->latest('published_at')->take(3)->get();

        return view('pages.home', compact('services', 'blogs'));
    }

    public function about(): View
    {
        $about = AboutPage::query()->first();

        return view('pages.about', compact('about'));
    }

    public function services(): View
    {
        $services = Service::query()->where('is_active', true)->orderBy('order')->get();

        return view('pages.services', compact('services'));
    }

    public function blog(): View
    {
        $featured = Blog::query()->where('is_active', true)->where('is_featured', true)->latest('published_at')->first();
        $blogs = Blog::query()->where('is_active', true)->latest('published_at')->paginate(9);

        return view('pages.blog', compact('featured', 'blogs'));
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function storeContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:150'],
            'phone' => ['nullable', 'string', 'max:40'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Ujumbe wako umepokelewa. Tutakujibu hivi karibuni.');
    }
}
