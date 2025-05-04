<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.comments.index')" class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800">Назад</Link>
        </div>
        <div class="mb-4">
            <textarea v-model="comment.content" type="text" placeholder="content" class="border border-gray-200 w-1/3"></textarea>
        </div>
        <div class="mb-4">
            <a @click.prevent="storeComment" href="#" class="inline-block px-3 py-2 bg-emerald-700 text-white border border-emerald-800">Создать</a>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Create",
    props:{
        comment: Array
    },

    data(){
        return {
            comment:{
            }
        }
    },
    methods:{
        storeComment() {
            console.log(this.data);
            axios.post(route('admin.comments.store'), this.comment)
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
