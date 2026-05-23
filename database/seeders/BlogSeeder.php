<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => '5 Best Exercises for Core Strength',
                'excerpt' => 'A strong core is the foundation of every great workout. Here are five exercises you should add to your routine today.',
                'content' => '<p>Core strength is critical for overall fitness. Here are 5 exercises: Plank, Dead Bug, Bird Dog, Pallof Press, and Ab Wheel Rollout. Incorporate these into your routine 3 times per week for best results.</p>',
                'category' => 'Training',
                'tags' => ['core', 'strength', 'exercises'],
                'is_published' => true,
                'published_at' => '2025-04-10 09:00:00',
            ],
            [
                'title' => 'Nutrition Tips for Maximum Muscle Gain',
                'excerpt' => 'What you eat matters as much as how you train. Discover the top nutrition strategies for building lean muscle fast.',
                'content' => '<p>To maximize muscle gain, focus on protein intake (1.6-2.2g per kg of bodyweight), caloric surplus of 300-500 kcal, and timing your meals around workouts.</p>',
                'category' => 'Nutrition',
                'tags' => ['nutrition', 'muscle', 'diet'],
                'is_published' => true,
                'published_at' => '2025-04-18 10:00:00',
            ],
            [
                'title' => 'The Mental Benefits of Regular Exercise',
                'excerpt' => 'Exercise isn\'t just about physical health. Learn how a consistent gym habit can transform your mental well-being.',
                'content' => '<p>Regular exercise reduces cortisol, increases endorphins, improves sleep quality, and boosts cognitive function. Even 30 minutes of moderate exercise can significantly improve mood.</p>',
                'category' => 'Lifestyle',
                'tags' => ['mental health', 'lifestyle', 'wellness'],
                'is_published' => true,
                'published_at' => '2025-05-01 08:00:00',
            ],
            [
                'title' => 'Iron Core Opens New Cardio Zone',
                'excerpt' => 'We\'re excited to announce the launch of our brand-new dedicated cardio zone — more space, more equipment, more results.',
                'content' => '<p>Our new cardio zone features 20 new treadmills, 15 ellipticals, 10 rowing machines, and a dedicated stretching area. Open now for all members.</p>',
                'category' => 'News',
                'tags' => ['news', 'announcement', 'cardio'],
                'is_published' => true,
                'published_at' => '2025-05-08 12:00:00',
            ],
            [
                'title' => 'Beginner\'s Guide to Powerlifting',
                'excerpt' => 'Thinking about getting into powerlifting? This beginner-friendly guide covers everything you need to know to get started safely.',
                'content' => '<p>Powerlifting consists of three main lifts: squat, bench press, and deadlift. Start with light weights, focus on form, and progressively overload.</p>',
                'category' => 'Training',
                'tags' => ['powerlifting', 'beginner', 'strength'],
                'is_published' => false,
                'published_at' => null,
            ],
            [
                'title' => 'Hydration: How Much Water Do You Really Need?',
                'excerpt' => 'Staying hydrated is one of the easiest ways to improve your performance. But how much is actually enough?',
                'content' => '<p>A general guideline is to drink 0.033 liters per kg of body weight. During intense exercise, increase intake by 500-1000ml per hour of activity.</p>',
                'category' => 'Nutrition',
                'tags' => ['hydration', 'nutrition', 'performance'],
                'is_published' => false,
                'published_at' => null,
            ],
        ];

        foreach ($posts as $post) {
            Blog::create(array_merge($post, [
                'slug' => Str::slug($post['title']),
                'author_id' => 1, // Admin user
            ]));
        }
    }
}
