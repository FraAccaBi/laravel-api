<?php

use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $post = new Post();
            $post->title = $faker->sentence(3);
            $post->cover_img = $faker->imageUrl(600, 300, 'Post', true, $post->title, true);
            $post->content = $faker->text(500);
            $post->save();
        }
    }
}
