<template>
    <section class="w-full">
        <header class="mx-auto p-4">
            HEADER
        </header>
    </section>
    <section class="w-full">
        <section class="mx-auto flex">
        <aside class="w-1/4 bg-gray-900 min-h-screen">
            <div>
                <Link :href="route('admin.posts.index')" class="block p-4 border-gray-500 text-gray-300">Посты</Link>
            </div>
            <div>
                <Link :href="route('admin.comments.index')" class="block p-4 border-gray-500 text-gray-300">Комментарии</Link>
            </div>
            <div>
                <Link :href="route('admin.categories.index')" class="block p-4 border-gray-500 text-gray-300">Категории</Link>
            </div>
            <div>
                <Link :href="route('admin.profiles.index')" class="block p-4 border-gray-500 text-gray-300">Профили</Link>
            </div>
            <div>
                <Link :href="route('admin.tags.index')" class="block p-4 border-gray-500 text-gray-300">Тэги</Link>
            </div>
            <div>
                <Link :href="route('admin.statistics.index')" class="block p-4 border-gray-500 text-gray-300">Статистика</Link>
            </div>
        </aside>
        <article class="w-3/4 p-4 bg-gray-50">
            <slot />
        </article>
        </section>
    </section>
</template>

<!--<script>-->
<!--import {Link} from "@inertiajs/vue3"-->
<!--export default {-->
<!--    name: "AdminLayout",-->
<!--    components:{-->
<!--        Link-->
<!--    }-->
<!--}-->
<!--</script>-->

<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

// Явно запрещаем получение пропса tag
const props = defineProps({
    tag: {
        type: null,
        required: false,
        validator: () => false
    }

});
</script>

<style scoped>

</style>
