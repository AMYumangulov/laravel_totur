<template>

    <div>
        <div class="mb-4 w-1/2 mx-auto">
            <div class="mb-4 bg-white p-4 border border-gray-200">
                {{ profile.name }}
            </div>
            <div class="mb-4 bg-white p-4 border border-gray-200">
                <Link method="post"
                      :href="route('chats.store')"
                      :data="{profile_id:profile.id}">
                    Сообщение
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "ShowPost",
    layout: ClientLayout,

    props: {
        profile: Object,
    },

    components: {
        Link
    },

}
</script>

<style>

</style>
