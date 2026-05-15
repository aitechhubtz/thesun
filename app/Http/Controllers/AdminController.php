<?php

namespace App\Http\Controllers;

use App\Models\AboutPage;
use App\Models\Application;
use App\Models\Blog;
use App\Models\ContactMessage;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        return view('admin.dashboard', [
            'revenue' => Application::query()->whereNotNull('amount')->sum('amount'),
            'pendingApplications' => Application::query()->where('status', 'pending')->latest()->take(10)->get(),
            'applicationsCount' => Application::query()->count(),
            'usersCount' => User::query()->count(),
            'messagesCount' => ContactMessage::query()->where('status', 'pending')->count(),
            'services' => Service::query()->orderBy('order')->get(),
            'blogs' => Blog::query()->latest('published_at')->take(10)->get(),
            'about' => AboutPage::query()->first(),
            'messages' => ContactMessage::query()->latest()->take(10)->get(),
        ]);
    }

    public function updateAbout(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'hero_title' => ['required', 'string', 'max:180'],
            'hero_description' => ['required', 'string', 'max:1000'],
            'story_title' => ['required', 'string', 'max:180'],
            'story_description' => ['required', 'string', 'max:2000'],
            'projects_count' => ['required', 'integer', 'min:0'],
            'clients_count' => ['required', 'integer', 'min:0'],
            'years_count' => ['required', 'integer', 'min:0'],
            'team_count' => ['required', 'integer', 'min:0'],
        ]);

        AboutPage::query()->updateOrCreate(['id' => 1], $validated);

        return back()->with('success', 'About page imesasishwa kikamilifu.');
    }

    public function storeService(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:1000'],
            'icon' => ['required', 'string', 'max:20'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        Service::create($validated + ['is_active' => true]);

        return back()->with('success', 'Huduma mpya imeongezwa.');
    }

    public function toggleService(Service $service): RedirectResponse
    {
        $service->update(['is_active' => ! $service->is_active]);

        return back()->with('success', 'Hali ya huduma imebadilishwa.');
    }

    public function storeBlog(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'content' => ['required', 'string', 'max:10000'],
            'category' => ['required', 'string', 'max:80'],
            'author' => ['required', 'string', 'max:120'],
            'published_at' => ['required', 'date'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        Blog::create($validated + ['is_active' => true, 'is_featured' => $request->boolean('is_featured')]);

        return back()->with('success', 'Blog post imeongezwa.');
    }

    public function updateApplicationStatus(Request $request, Application $application): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:pending,approved,rejected,completed'],
        ]);

        $application->update($validated + [
            'completed_date' => $validated['status'] === 'completed' ? now() : $application->completed_date,
        ]);

        return back()->with('success', 'Status ya ombi imesasishwa.');
    }

    public function markMessageRead(ContactMessage $message): RedirectResponse
    {
        $message->update(['status' => 'read']);

        return back()->with('success', 'Ujumbe umewekwa kama umesomwa.');
    }
}
