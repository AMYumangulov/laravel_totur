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
            <div>
                <input type="checkbox" id="checkbox" :value="profile.id" v-model="checkedNames"/>
            </div>
        </div>
        <div class="flex justify-between mb-4  w-1/2 mx-auto" v-if="checkedNames.length > 3">
            <Link method="post" :href="route('chats.groupStore')"
                  :data="{profile_ids:checkedNames}">
                Создать групповой чат
            </Link>
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
            profilesData: this.posts,
            checkedNames: [],
        }
    },
    components: {
        Link
    },

    methods: {logCheckedNames() {
            console.log('Массив checkedNames перед отправкой:', this.checkedNames);
        },}
}
</script>

<style scoped>

</style>
