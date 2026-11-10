<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use function Pest\Laravel\actingAs;

it('delete comments', function () {


    $comment = Comment::factory()->create();

    actingAs($comment->user)->delete(route('comments.destroy', $comment));

    $this->assertModelMissing($comment);
});
