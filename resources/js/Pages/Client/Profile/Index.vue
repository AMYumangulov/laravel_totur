<template>
    <div>
        <div v-for="profile in profiles" class="flex justify-between mb-4  w-1/2 mx-auto">
            <div>
                <Link :href="route('profiles.show', profile.id)" class="text-indigo-600 hover:text-indigo-900">
                    {{ profile.name }}
                </Link>
            </div>
            <div>
                <Link method="post"
                      :href="route('chats.store')"
                      :data="{profile_id:profile.id}">
                    Написать
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";


export default {
    name: "index",

    props: {
        profiles: Array
    },

    layout: ClientLayout,

    data() {
        return {
            profilesData: this.posts
        }
    },
    components: {
        Link
    },

    methods: {}
}
</script>

<style scoped>

</style>
