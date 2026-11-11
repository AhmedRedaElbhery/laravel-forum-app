<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('store post', function () {

    $user = User::factory()->create();

    $post = Post::factory()->create();

    actingAs($user)->post(route('posts.store', $post), [
        'title' => 'this is the title',
        'body' => 'this is a post'
    ]);

    $this->assertDatabaseHas(Post::class, [
        'user_id' => $user->id,
        'title' => 'this is the title',
        'body' => 'this is a post',
    ]);
});
