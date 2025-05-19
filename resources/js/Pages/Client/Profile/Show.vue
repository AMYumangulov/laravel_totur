<template>

    <div>
        <div class="mb-4 w-1/2 mx-auto">
            <div class="mb-4 bg-white p-4 border border-gray-200">
                {{ profile.name }}
            </div>

            <div v-if="profile.id !== this.$attrs.auth.user.profile" class="mb-4 bg-white p-4 border border-gray-200">
                <Link method="post"
                      :href="route('chats.store')"
                      :data="{profile_id:profile.id}">
                    Сообщение
                </Link>
            </div>

            <div class="mb-4 bg-white p-4 border border-gray-200">
                <a @click.prevent="toggleSubscriber" :class="[profile.is_subscriber ? 'text-blue-600':'bg-blue-600','inline-block px-3 py-2 text-sm text-white border border-blue-600']"
                   href="#"
                   v-html="profile.is_subscriber ? 'Отписаться':'Подписаться' "></a>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "ShowProfile",
    layout: ClientLayout,

    props: {
        profile: Object,
        authProfile: Object,
    },

    components: {
        Link
    },
    mounted() {
    },

    methods: {
        toggleSubscriber() {
            axios.post(route('profiles.subscribers.toggle', this.$page.props.auth.user.profile.id), {subscriber_id: this.profile.id})
                .then(res => {
                    this.profile.is_subscriber = res.data.is_subscriber;
                })
        }
    }

}
</script>

<style>

</style>
