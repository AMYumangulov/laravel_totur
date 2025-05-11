<template>
    <div v-if="isRepost" class="popup flex justify-center items-center">

        <div class="body p-4">
            <div class="mb-4">
                <input v-model="repost.title" type="text" class="border border-gray-200 w-full">
            </div>
            <div class="mb-4">
            <textarea v-model="repost.content" type="text" placeholder="content"
                      class="border border-gray-200 w-1/3"></textarea>
            </div>
            <div class="mb-4">
                <a href="#"
                   @click.prevent="repostPost"
                   class="inline-block px-3 py-2 bg-emerald-700 text-white border border-emerald-800">Репост</a>
            </div>
            <div @click="close">
                <span class="cursor-pointer">Закрыть</span>
            </div>
        </div>
    </div>

</template>

<script>


export default {
    name: "RepostItem",

    props: {
        post: Object,
    },


    data() {
        return {
            repost: {},
            isRepost:true,
        }
    },

    emits: ['isRepost', 'getPost', 'post_reposted'],

    methods: {
        repostPost() {
            axios.post(route('post.repost', this.post.id), this.repost)
                .then(res => {
                    console.log(res);
                    this.close();
                    this.$emit('post_reposted');
                })
        },
        close(){
            this.isRepost = false;
            this.$emit('isRepost', false);
            this.$emit('getPost');
        }
    }
};
</script>

<style>
.popup {
    position: fixed;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    left: 0;
    top: 0;
}

.body {
    width: 40%;
    background: #f6f6f6;
    left: 0;
    top: 0;
}
</style>
