<template>

    <div>
        <div class="mb-4 w-1/2 mx-auto">
            <div class="mb-4 bg-white p-4 border border-gray-200">
                {{ chat.id }}
            </div>

            <div class="mb-4 bg-white p-4 border border-gray-200 chat-box" >
                <div v-for="message in chat.messages" class="mb-4 pb-4 border-b border-gray-200">
                    {{message.content}}
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

    data() {
        return {
            message: {}
        }
    },

    methods:{
        storeMessage(){
            axios.post(route('chats.messages.store', this.chat.id), this.message)
                .then( res => {
                    this.chat.messages.push(res.data);
                    this.message = {};

                })
        }
    }

}
</script>

<style>
.chat-box{
    height: 300px;
    overflow-x: auto;
}
</style>
