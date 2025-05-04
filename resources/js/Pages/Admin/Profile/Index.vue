<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.profiles.create')" class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800">Добавить</Link>
        </div>
        <div>
            <div v-for="profile in profiles" class="mb-4 pb-4 border-b border-gray-200">
                <Link :href="route('admin.profiles.show', profile.id)">  {{ profile.name }}</Link>
            </div>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",
    props:{
        profiles: Array
    },
    layout: AdminLayout,

    components:{
        Link
    }
}
</script>

<style scoped>

</style>
