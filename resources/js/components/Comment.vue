<template>

    <div class="flex justify-between">
        <div class="flex items-center gap-3"">
            <img :src="comment.user.profile_photo_url" class="w-10 h-10 rounded-full" />
        <span class="text-gray-400">{{ comment.user.name }}</span>

    </div>
    <div class="flex">
        <form v-if="comment.can.update" @submit.prevent="$emit('edit', comment)" class="mt-3 mx-2">
            <button type="submit" class="rounded bg-gray-900 px-4 py-1 text-gray-400">
                Edit
            </button>
        </form>
        <form v-if="comment.can.delete" @submit.prevent="submit" class="mt-3 mx-2">
            <button type="submit" class="text-red-600 rounded bg-gray-900 px-3 py-1">
                Delete
            </button>
        </form>
    </div>
    </div>

    <div>
        <p class="pt-3 text-sm">{{ comment.body }}</p>
        <span class="text-gray-400 pr-3 text-xsm">Created at {{ formattedDate }} ago</span>
    </div>
</template>

<script setup>
import { formatTimeAgo } from '@vueuse/core';
import { router } from '@inertiajs/vue3';

const props = defineProps(['comment']);

const formattedDate = formatTimeAgo(
    new Date(props.comment.created_at)
);

const emit = defineEmits(['edit']);

function submit() {
    if (confirm('Are you sure you want to delete this comment?')) {
        router.delete(route('comments.destroy', props.comment));
    }
}

</script>
