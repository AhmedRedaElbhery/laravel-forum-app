<template>
    <p v-if="$page.props.flash.success" class="bg-gray-900 p-2 text-gray-200 w-full flex justify-center font-bold">{{
        $page.props.flash.success }}
    </p>

    <h3 class="flex justify-center mt-5 pl-5 text-xl font-bold">Edit Post</h3>

    <form v-if="$page.props.auth.user" @submit.prevent="submit" class="m-5">
        <input class="w-full h-13 p-3 my-3 rounded border border-gray-600" v-model="form.title"
            placeholder="Enter The Title..." />

        <p v-if="form.errors.title" class="text-red-500">
            {{ form.errors.title }}
        </p>

        <textarea v-model="form.body" rows="3" placeholder="Write the Body..."
            class="w-full p-3 rounded border border-gray-600 my-2"></textarea>

        <p v-if="form.errors.body" class="text-red-500">
            {{ form.errors.body }}
        </p>

        <div class="mr-3 mt-2 flex justify-center">
            <button type="submit" :disabled="form.processing" class="rounded bg-gray-700 px-5 py-1.5 text-white">
                Update the Post
            </button>
        </div>


    </form>

</template>

<script setup>
import { useForm } from '@inertiajs/vue3';

const props = defineProps(['post']);

const form = useForm({
    title: props.post.title,
    body: props.post.body,
});

function submit() {
    form.put(route('posts.update', props.post));
}

</script>
