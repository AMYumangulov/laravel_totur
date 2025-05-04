<template>
    <div class="mb-6 bg-white rounded-md shadow-md overflow-hidden border border-gray-200">
        <div class="p-4">
            <Link :href="route('posts.show', post.id)"
                  class="block text-xl font-semibold text-gray-800 hover:text-emerald-600 transition duration-150 ease-in-out">
                {{ post.title }}
            </Link>
            <img v-if="post.image_url"
                 :src="post.image_url"
                 :alt="post.title"
                 class="mt-2 rounded-md w-full object-cover">
            <p v-if="post.short_content" class="mt-3 text-gray-700 leading-relaxed">
                {{ post.short_content }}
            </p>
            <div class="mt-4 flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <button @click="toggleLike(post.id)"
                            class="flex items-center text-gray-600 hover:text-red-500 focus:outline-none transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             :fill="post.is_liked ? '#ef4444' : 'none'"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor"
                             class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                        </svg>
                        <span v-if="post.liked_by_profiles_count > 0" class="ml-1 text-sm text-gray-500">{{ post.liked_by_profiles_count }}</span>
                    </button>
                </div>
                <div v-if="post.profile.id === profile.id">
                    <button @click="deletePost"
                            class="text-red-600 hover:text-red-700 focus:outline-none transition duration-150 ease-in-out">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import axios from 'axios';

export default {
    name: "PostItem",

    props: {
        post: Object,
        profile: Object,
    },

    components: {
        Link
    },

    methods: {
        toggleLike(postId) {
            this.$emit('like_toggled', postId);
        },
        deletePost() {
            axios.delete(route('posts.destroy', this.post.id))
                .then(() => {
                    this.$emit('post_deleted', this.post);
                })
                .catch(error => {
                    console.error("Ошибка при удалении поста:", error);
                });
        }
    }
};
</script>

<style scoped>
</style>
