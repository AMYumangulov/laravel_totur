<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.profiles.index')" class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800">Назад</Link>
        </div>
        <div class="mb-4">
            <input v-model="profile.name" type="text" placeholder="name" class="border border-gray-200 w-1/3">
        </div>
        <div class="mb-4">
            <textarea v-model="profile.address" type="text" placeholder="address" class="border border-gray-200 w-1/3"></textarea>
        </div>
        <div class="mb-4">
            <input v-model="profile.phone" type="text" placeholder="phone" class="border border-gray-200 w-1/3">
        </div>
        <div class="mb-4">
            <textarea v-model="profile.gender" type="text" placeholder="gender" class="border border-gray-200 w-1/3"></textarea>
        </div>
        <div class="mb-4">
            <a @click.prevent="storeProfile" href="#" class="inline-block px-3 py-2 bg-emerald-700 text-white border border-emerald-800">Создать</a>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Create",
    props:{
        profile: Array
    },

    data(){
        return {
            profile:{
            }
        }
    },
    methods:{
        storeProfile() {
            axios.post(route('admin.profiles.store'), this.profile)
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
