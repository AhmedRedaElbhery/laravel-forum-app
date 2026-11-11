<template>

    <div v-if="$page.props.auth.user" class="flex justify-end">
        <button @click="addPost" class="rounded border border-gray-400 bg-gray-900 p-2">Add Post</button>
    </div>
    <ul>
        <Link :href="route('posts.show', post.id)" v-for="post in posts.data" :key="post.id"
            class="hover:text-blue-500 ml-5">

            <li class="ml-4"> {{ post.title }}</li>

            <p class="ml-5 text-gray-500">
                {{ formattedDate(post.created_at) }} ago
                <span>by {{ post.user.name }}</span>
            </p>
        </Link>


    </ul>

    <Pagination :meta="posts.meta" />
</template>

<script setup>
import Pagination from '@/components/pagination.vue';
import { Link } from '@inertiajs/vue3';
import { formatTimeAgo } from '@vueuse/core';
import { route } from 'ziggy-js';
import { router } from '@inertiajs/vue3';

defineProps(['posts']);

const formattedDate = (date) =>
    formatTimeAgo(new Date(date));

function addPost() {
    router.get(route('posts.create'));
}
</script>
