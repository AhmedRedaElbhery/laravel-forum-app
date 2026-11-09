<?php

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

it('show a Post', function () {

    $post = Post::factory()->create();

    $this->get(route('posts.show', $post))
        ->assertInertia(fn($page) => $page->component('posts/Show')->where('post.id', $post->id));
});
