<template>

    <div>
        <div class="mb-4 w-1/2 mx-auto">
            <div class="mb-4 bg-white p-4 border border-gray-200">
                {{ chatData.id }}
            </div>

            <div class="mb-4 bg-white p-4 border border-gray-200 chat-box">

                <div class="mb-4">
                    <a @click.prevent="getMessages()" href="#"
                       class="inline-block px-3 py-2 bg-cyan-700 text-white border bg-cyan-800">Еще</a>
                </div>

                <div v-for="message in messages.data" class="mb-4 pb-4 border-b border-gray-200">
                    {{ message.id }}
                    {{ message.content }}
                </div>

            </div>

            <div class="mb-4 bg-white p-4 border border-gray-200">
                <div class="mb-4">
                    <textarea class="w-full" v-model="message.content" placeholder="message"></textarea>
                </div>
                <div class="mb-4">
                    <a @click.prevent="storeMessage()" href="#"
                       class="inline-block px-3 py-2 bg-emerald-700 text-white border border-emerald-800">Отправить</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Show",
    layout: ClientLayout,

    props: {
        chat: Object,
    },

    components: {
        Link
    },

    mounted() {
        this.getMessages()
    },

    data() {
        return {
            messages: {data: []},
            chatData: this.chat,
            message: {},
            page: 1,
        }
    },

    methods: {
        storeMessage() {
            axios.post(route('chats.messages.store', this.chat.id), this.message)
                .then(res => {
                    this.messages.data.push(res.data);
                    this.message = {};

                })
        },

        getMessages() {
            axios.get(route('chats.messages.index', this.chat.id), {
                params: {
                    page: this.page
                }
            })
                .then(res => {
                    console.log(res.data);

                    this.messages.data.unshift(...res.data.data);
                    this.page++;

                })
        }
    }

}
</script>

<style>
.chat-box {
    height: 300px;
    overflow-x: auto;
}
</style>
