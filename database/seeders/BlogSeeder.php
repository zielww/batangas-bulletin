<?php
namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Tech-related articles', 'color' => '#3B82F6'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'description' => 'Lifestyle and personal development', 'color' => '#10B981'],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business and entrepreneurship', 'color' => '#F59E0B'],
            ['name' => 'Health', 'slug' => 'health', 'description' => 'Health and wellness', 'color' => '#EF4444'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create additional users
        $users = [
            ['name' => 'John Editor', 'email' => 'editor@blog.com', 'email_verified_at' => now()],
            ['name' => 'Jane Writer', 'email' => 'writer@blog.com', 'email_verified_at' => now()],
        ];

        foreach ($users as $userData) {
            User::create(array_merge($userData, ['password' => bcrypt('password')]));
        }

        // Create sample articles
        $articles = [
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-started-with-laravel-11',
                'excerpt' => 'Learn the basics of Laravel 11 and its new features.',
                'content' => '<p>Laravel 11 brings many exciting new features and improvements...</p>',
                'status' => 'published',
                'category_id' => 1,
                'user_id' => 1,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-started-with-11',
                'excerpt' => 'Learn the basics of Laravel 11 and its new features.',
                'content' => '<p>Laravel 11 brings many exciting new features and improvements...</p>',
                'status' => 'published',
                'category_id' => 1,
                'user_id' => 1,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-started-with-laravel-12',
                'excerpt' => 'Learn the basics of Laravel 11 and its new features.',
                'content' => '<p>Laravel 11 brings many exciting new features and improvements...</p>',
                'status' => 'published',
                'category_id' => 1,
                'user_id' => 1,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Getting Started with Laravel 12',
                'slug' => 'getting-started-with-laravel-13',
                'excerpt' => 'Learn the basics of Laravel 11 and its new features.',
                'content' => '<p>Laravel 11 brings many exciting new features and improvements...</p>',
                'status' => 'published',
                'category_id' => 1,
                'user_id' => 1,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-started-with-laravel',
                'excerpt' => 'Learn the basics of Laravel 11 and its new features.',
                'content' => '<p>Laravel 11 brings many exciting new features and improvements...</p>',
                'status' => 'published',
                'category_id' => 1,
                'user_id' => 1,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-started--laravel-11',
                'excerpt' => 'Learn the basics of Laravel 11 and its new features.',
                'content' => '<p>Laravel 11 brings many exciting new features and improvements...</p>',
                'status' => 'published',
                'category_id' => 1,
                'user_id' => 1,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Getting Started with Laravel 11',
                'slug' => 'getting-with-laravel-11',
                'excerpt' => 'Learn the basics of Laravel 11 and its new features.',
                'content' => '<p>Laravel 11 brings many exciting new features and improvements...</p>',
                'status' => 'published',
                'category_id' => 1,
                'user_id' => 1,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Building Modern Web Applications',
                'slug' => 'building-modern-web-applications',
                'excerpt' => 'Best practices for creating scalable web applications.',
                'content' => '<p>Modern web development requires understanding of various technologies...</p>',
                'status' => 'published',
                'category_id' => 1,
                'user_id' => 2,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Work-Life Balance in Tech',
                'slug' => 'work-life-balance-in-tech',
                'excerpt' => 'Tips for maintaining healthy work-life balance.',
                'content' => '<p>Achieving work-life balance in the tech industry can be challenging...</p>',
                'status' => 'draft',
                'category_id' => 2,
                'user_id' => 1,
            ],
        ];

        foreach ($articles as $article) {
            Article::create($article);
        }

        // Create sample comments
        $comments = [
            [
                'content' => 'Great article! Very informative and well-written.',
                'status' => 'approved',
                'author_name' => 'Mike Johnson',
                'author_email' => 'mike@example.com',
                'article_id' => 1,
            ],
            [
                'content' => 'Thanks for sharing this. Looking forward to more content like this.',
                'status' => 'approved',
                'author_name' => 'Sarah Wilson',
                'author_email' => 'sarah@example.com',
                'article_id' => 1,
            ],
            [
                'content' => 'I have a question about the implementation details.',
                'status' => 'pending',
                'author_name' => 'David Brown',
                'author_email' => 'david@example.com',
                'article_id' => 2,
            ],
        ];

        foreach ($comments as $comment) {
            Comment::create($comment);
        }

        // Create default settings
        $settings = [
            ['key' => 'site_name', 'value' => 'My Awesome Blog', 'type' => 'text'],
            ['key' => 'site_description', 'value' => 'A blog about technology, lifestyle, and more.', 'type' => 'textarea'],
            ['key' => 'contact_email', 'value' => 'contact@myblog.com', 'type' => 'email'],
            ['key' => 'posts_per_page', 'value' => '10', 'type' => 'number'],
            ['key' => 'allow_comments', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'moderate_comments', 'value' => 'true', 'type' => 'boolean'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
