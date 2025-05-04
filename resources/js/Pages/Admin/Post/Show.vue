<template>
    <div>
        <div>
            <Link :href="route('admin.posts.index')" class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800">Назад</Link>
        </div>
        <div>
            <div class="mb-4 pb-4 border-b border-gray-200">
                <h3>{{ post.title }}</h3>
                <p>{{ post.content }}</p>
                <img :src="post.image_url" :alt="post.title">
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Show",
    props:{
        post: Object
    },
    layout:AdminLayout,
    components:{
        Link
    }
}
</script>

<style scoped>

</style>
