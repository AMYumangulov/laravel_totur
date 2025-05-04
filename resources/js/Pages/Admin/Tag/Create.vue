<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.tags.index')" class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800">Назад</Link>
        </div>
        <div class="mb-4">
            <input v-model="tag.title" type="text" placeholder="title" class="border border-gray-200 w-1/3">
        </div>
        <div class="mb-4">
            <a @click.prevent="storeTag" href="#" class="inline-block px-3 py-2 bg-emerald-700 text-white border border-emerald-800">Создать</a>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Create",
    props:{
        tag: Object
    },

    data(){
        return {
            tag:{
            }
        }
    },
    methods:{
        storeTag() {
            axios.post(route('admin.tags.store'), this.tag)
            .then(res => {
                console.log(res);
            })
            // .catch(error => {console.log(error);})
            //.finally(res =>{})
        }
    },
    layout: AdminLayout,

    components: {
        Link
    }

}
</script>

<style scoped>

</style>
