<template>
    <h1>Posts</h1>

    <ul>
        <li v-for="post in posts" :key="post">{{ post.title }}</li>
    </ul>
</template>


<script setup>

defineProps(['posts']);

</script>