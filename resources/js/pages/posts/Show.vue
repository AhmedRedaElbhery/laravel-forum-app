<template>

    <div class="pl-5">
        <h1 class="mt-5 text-xl">{{ post.title }}</h1>
        <p class="mb-5 text-gray-500">{{ formattedDate }} ago <span>by {{ post.user.name }}</span></p>

        <div>
            <pre class="whitespace-pre-wrap">{{ post.body }}</pre>
        </div>

    </div>

    <h3 class="mt-5 pl-5 text-xl font-bold">Comments</h3>

    <ul v-if="comments.length > 0" class="m-5">
        <li v-for="comment in comments" :key="comment.id" class="p-3 border border-gray-800">
            <Comment :comment='comment'></Comment>
        </li>
    </ul>

</template>


<script setup>
import { formatTimeAgo } from '@vueuse/core';
import { computed } from 'vue';

import Comment from '@/components/Comment.vue';

const props = defineProps(['post', 'comments']);

const formattedDate = formatTimeAgo(new Date(props.post.created_at));
</script>
