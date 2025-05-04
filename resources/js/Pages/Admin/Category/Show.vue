<template>
    <div>
        <div>
            <Link :href="route('admin.categories.index')" class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800">Назад</Link>
        </div>
        <div>
            <div class="mb-4 pb-4 border-b border-gray-200">
                <h3>{{ category.title }}</h3>
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
        category: Object
    },
    layout:AdminLayout,
    components:{
        Link
    }
}
</script>

<style scoped>

</style>
