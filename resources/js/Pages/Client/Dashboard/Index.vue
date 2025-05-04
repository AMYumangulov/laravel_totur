<template >
    <div >
        <div class="mb-4  w-1/2 mx-auto">
            <PostItem @post_deleted="getposts"
                      v-for="post in postsData"
                      :post="post"
                      :profile="$attrs.auth.user.profile"
                      @like_toggled="toggleLike">
            </PostItem>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import PostItem from "@/Components/Post/PostItem.vue";


export default {
    name: "index",

    props: {
        posts: Array
    },

    layout: ClientLayout,

    data() {
        return {
            postsData: this.posts
        }
    },
    components: {
        PostItem
    },
    methods: {
        toggleLike(postId) {
            axios.post(route('posts.likes.toggle', postId))
                .then(res => {
                    this.getposts();
                })
        },
        getposts() {
            axios.get(route('dashboard'))
                .then(res => {
                    this.postsData = res.data;
                    // console.log(res);
                })
        }
    }
}
</script>

<style scoped>

</style>
