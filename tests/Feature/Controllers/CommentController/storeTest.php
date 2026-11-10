<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('store comments', function () {

    $user = User::factory()->create();

    $post = Post::factory()->create();

    actingAs($user)->post(route('posts.comments.store', $post), [
        'body' => 'this is a comment'
    ]);

    $this->assertDatabaseHas(Comment::class, [

        'post_id' => $post->id,
        'user_id' => $user->id,
        'body' => 'this is a comment',
    ]);
});
