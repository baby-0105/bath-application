<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'bath_id' => $faker->randomNumber(),
        'user_id' => $faker->randomNumber(),
        'title' => $faker->name,
        'thoughts' => $faker->name,
        'main_image_path' => UploadedFile::fake()->create('main.jpeg', 10)->store('uploads'),
        'sub_picture1_path' => UploadedFile::fake()->create('sub1.png', 10)->store('uploads'),
        'sub_picture2_path' => UploadedFile::fake()->create('sub2.png', 10)->store('uploads'),
        'sub_picture3_path' => UploadedFile::fake()->create('sub3.png', 10)->store('uploads'),
        'eval_cd' => $faker->randomElement([0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5]),
        'hot_water_eval_cd' => $faker->randomElement([0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5]),
        'rock_eval_cd' => $faker->randomElement([0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5]),
        'sauna_eval_cd' => $faker->randomElement([0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5]),
        'created_at' => now(),
    ];
});
