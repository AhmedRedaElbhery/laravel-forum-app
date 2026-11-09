<template>

    <div class="flex items-center gap-3"">
        <img :src="comment.user.profile_photo_url" class="w-10 h-10 rounded-full" />
    <span class="text-gray-400">{{ comment.user.name }}</span>

    </div>
    <div>
        <p class="pt-3 text-sm">{{ comment.body }}</p>
        <span class="text-gray-400 pr-3 text-xsm">Created at {{ formattedDate }} ago</span>
    </div>
</template>

<script setup>
import { formatTimeAgo } from '@vueuse/core';

const props = defineProps(['comment']);

const formattedDate = formatTimeAgo(
    new Date(props.comment.created_at)
);
</script>
