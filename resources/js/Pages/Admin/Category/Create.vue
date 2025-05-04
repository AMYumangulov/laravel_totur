<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.categories.index')" class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800">Назад</Link>
        </div>
        <div class="mb-4">
            <input v-model="category.title" type="text" placeholder="title" class="border border-gray-200 w-1/3">
        </div>
        <div class="mb-4">
            <a @click.prevent="storeCategory" href="#" class="inline-block px-3 py-2 bg-emerald-700 text-white border border-emerald-800">Создать</a>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Create",
    props:{
        category: Array
    },

    data(){
        return {
            category:{
            }
        }
    },
    methods:{
        storeCategory() {
            axios.post(route('admin.categories.store'), this.category)
            .then(res => {
                console.log(res);
            })
            // .catch(error => {console.log(error);})
            //.finally(res =>{})
        }
    },
    layout: AdminLayout,
    components:{
        Link
    }
}
</script>

<style scoped>

</style>
