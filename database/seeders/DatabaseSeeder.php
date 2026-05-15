<?php

namespace Database\Seeders;

use App\Models\AboutPage;
use App\Models\Application;
use App\Models\Blog;
use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@thesun.test'],
            ['name' => 'AITECH Master', 'password' => Hash::make('Admin12345'), 'role' => 'admin']
        );

        User::updateOrCreate(
            ['email' => 'user@thesun.test'],
            ['name' => 'Demo User', 'password' => Hash::make('User12345'), 'role' => 'user']
        );

        AboutPage::updateOrCreate(['id' => 1], [
            'hero_title' => 'Building Digital Excellence Since Day One',
            'hero_description' => 'We are a team of passionate creators, developers, and strategists dedicated to transforming your digital presence into something extraordinary.',
            'story_title' => 'Our Journey',
            'story_description' => 'Founded with a vision to revolutionize digital experiences, the sun Agency has grown from a small startup to a leading force in the digital landscape.',
            'projects_count' => 500,
            'clients_count' => 150,
            'years_count' => 10,
            'team_count' => 25,
        ]);

        $services = [
            ['icon' => '💻', 'title' => 'Web Development', 'description' => 'High-performance websites and portals built with scalable architecture.', 'order' => 1],
            ['icon' => '📱', 'title' => 'Mobile Apps', 'description' => 'User-friendly iOS and Android experiences for modern businesses.', 'order' => 2],
            ['icon' => '🛒', 'title' => 'E-Commerce', 'description' => 'Secure online stores with payment-ready business flows.', 'order' => 3],
            ['icon' => '📊', 'title' => 'Digital Marketing', 'description' => 'SEO, content strategy, and performance marketing campaigns.', 'order' => 4],
            ['icon' => '🎨', 'title' => 'UI/UX Design', 'description' => 'Beautiful interfaces with user-centered product thinking.', 'order' => 5],
            ['icon' => '⚙️', 'title' => 'Business Automation', 'description' => 'Dashboards and workflows that reduce manual work.', 'order' => 6],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service + ['is_active' => true]);
        }

        Blog::updateOrCreate(['title' => 'The Future of Mobile App Development'], [
            'content' => 'Explore the cutting-edge technologies and trends shaping the future of mobile applications, from AI integration to augmented reality experiences.',
            'category' => 'Mobile Apps',
            'author' => 'the sun Team',
            'is_featured' => true,
            'is_active' => true,
            'published_at' => now(),
        ]);

        Blog::updateOrCreate(['title' => '10 Best Practices for Modern Web Development'], [
            'content' => 'Discover the essential practices every developer should follow to build efficient, scalable, and maintainable web applications.',
            'category' => 'Web Development',
            'author' => 'the sun Team',
            'is_featured' => false,
            'is_active' => true,
            'published_at' => now()->subDays(3),
        ]);

        Application::updateOrCreate(['client_id' => '#TSN-001'], [
            'client_name' => 'Asha Suleiman',
            'service_type' => 'BRELA',
            'details' => 'Business registration request',
            'status' => 'pending',
            'application_date' => now(),
            'amount' => 150000,
        ]);

        Application::updateOrCreate(['client_id' => '#TSN-002'], [
            'client_name' => 'Kelvin Mushi',
            'service_type' => 'HESLB',
            'details' => 'HESLB application support',
            'status' => 'completed',
            'application_date' => now()->subDays(5),
            'completed_date' => now()->subDay(),
            'amount' => 75000,
        ]);
    }
}
