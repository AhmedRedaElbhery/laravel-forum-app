<?php

use App\Models\Post;

it('should return the right component', function () {
    $this->get(route('posts.index'))
        ->assertInertia(fn($page) => $page->component('posts/Index'));
});

it('posts passes to view', function () {
    $this->get(route('posts.index'))
        ->assertInertia(fn($page) => $page->component('posts/Index')
            ->has('posts'));
});

it('paginates posts 15 per page with pagination meta', function () {
    Post::factory(20)->create();

    $this->get(route('posts.index'))
        ->assertInertia(fn($page) => $page
            ->has('posts.data', 15)
            ->where('posts.meta.current_page', 1)
            ->where('posts.meta.last_page', 2)
            ->where('posts.meta.total', 20)
            ->has('posts.meta.links'));
});

it('returns the remaining posts on the second page', function () {
    Post::factory(20)->create();

    $this->get(route('posts.index', ['page' => 2]))
        ->assertInertia(fn($page) => $page
            ->has('posts.data', 5)
            ->where('posts.meta.current_page', 2));
});

it('includes the post author', function () {
    $post = Post::factory()->create();

    $this->get(route('posts.index'))
        ->assertInertia(fn($page) => $page
            ->where('posts.data.0.id', $post->id)
            ->where('posts.data.0.user.name', $post->user->name));
});
