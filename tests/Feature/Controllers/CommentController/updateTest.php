<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;

it('update comments', function () {

    $comment = Comment::factory()->create();

    actingAs($comment->user)->put(route('comments.update', $comment), [
        'body' => 'this is an update'
    ]);

    $this->assertDatabaseHas(Comment::class, [
        'body' => 'this is an update',
    ]);
});
