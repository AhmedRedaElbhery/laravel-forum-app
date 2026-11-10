<template>
    <div class="pl-5">
        <h1 class="mt-5 text-xl">{{ post.title }}</h1>

        <p class="mb-5 text-gray-500">
            {{ formattedDate }} ago
            <span>by {{ post.user.name }}</span>
        </p>

        <div>
            <pre class="whitespace-pre-wrap">{{ post.body }}</pre>
        </div>
    </div>

    <h3 class="mt-5 pl-5 text-xl font-bold">Comments</h3>

    <form v-if="$page.props.auth.user" @submit.prevent="submit" class="m-5">
        <textarea v-model="form.body" rows="3" cols="80" placeholder="Write a comment..."
            class="rounded border p-2"></textarea>

        <div class="mr-3 mt-2">
            <button type="submit" :disabled="form.processing" class="rounded bg-gray-700 px-5 py-1.5 text-white">
                Add Comment
            </button>
        </div>

        <p v-if="form.errors.body" class="text-red-500">
            {{ form.errors.body }}
        </p>
    </form>


    <ul v-if="comments.length > 0" class="m-5">
        <li v-for="comment in comments" :key="comment.id" class="border border-gray-800 p-3">
            <Comment :comment="comment" />
        </li>
    </ul>
</template>

<script setup>
import { formatTimeAgo } from '@vueuse/core';
import { useForm } from '@inertiajs/vue3';
import Comment from '@/components/Comment.vue';

const props = defineProps(['post', 'comments']);

const formattedDate = formatTimeAgo(
    new Date(props.post.created_at)
);

const form = useForm({
    body: '',
});

function submit() {
    form.post(route('posts.comments.store', props.post), {
        onSuccess: () => form.reset(),
    });
}
</script>
