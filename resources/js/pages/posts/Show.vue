<template>
    <div class="flex justify-between">
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
        <div class="mr-3 my-3">
            <button v-if="post.can.update" @click="editPost"
                class="rounded border bg-gray-900 text-gray-400 mx-2 py-1.5 px-3">Edit</button>
            <button v-if="post.can.delete" @click="deletePost"
                class="rounded border bg-gray-900 mx-2 text-red-600 p-2">Delete</button>
        </div>
    </div>

    <h3 class="mt-5 pl-5 text-xl font-bold">Comments</h3>

    <form v-if="$page.props.auth.user" @submit.prevent="submit" class="m-5">
        <textarea v-model="form.body" rows="3" placeholder="Write a comment..."
            class="w-full rounded border p-2"></textarea>

        <div class="mr-3 mt-2">
            <button v-if="editCommentId == null" type="submit" :disabled="form.processing"
                class="rounded bg-gray-700 px-5 py-1.5 text-white">
                Add Comment
            </button>

            <button v-if="editCommentId != null" @click="update" :disabled="form.processing"
                class="rounded bg-gray-700 px-5 py-1.5 text-white">
                Update Comment
            </button>

        </div>

        <p v-if="form.errors.body" class="text-red-500">
            {{ form.errors.body }}
        </p>
    </form>


    <ul v-if="comments.length > 0" class="m-5">
        <li v-for="comment in comments" :key="comment.id" class="border border-gray-800 p-3">
            <Comment :comment="comment" @edit="editComment" />
        </li>
    </ul>
</template>

<script setup>
import { formatTimeAgo } from '@vueuse/core';
import { router, useForm } from '@inertiajs/vue3';
import Comment from '@/components/Comment.vue';
import { ref } from 'vue';

const props = defineProps(['post', 'comments']);

const formattedDate = formatTimeAgo(
    new Date(props.post.created_at)
);

const form = useForm({
    body: '',
});

const editCommentId = ref(null);
const updateComment = ref(null);

function editComment(comment) {
    editCommentId.value = comment.id;
    form.body = comment.body;
}

function update() {
    form.put(route('comments.update', editCommentId.value), {
        onSuccess: () => {
            form.reset();
            editCommentId.value = null;
        },
    });
}
function submit() {
    form.post(route('posts.comments.store', props.post), {
        onSuccess: () => form.reset(),
    });
}

function editPost() {
    router.get(route('posts.edit', props.post));
}

function deletePost() {
    router.delete(route('posts.destroy', props.post));
}


</script>
