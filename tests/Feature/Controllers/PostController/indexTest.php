<?php

it('should return the right component', function () {
    $this->get(route('posts.index'))
        ->assertInertia(fn($page) => $page->component('posts/Index'));
});

it('posts passes to view', function () {
    $this->get(route('posts.index'))
        ->assertInertia(fn($page) => $page->component('posts/Index')
            ->has('posts'));
});
