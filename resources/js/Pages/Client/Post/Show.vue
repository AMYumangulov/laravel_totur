<template>
    <RepostItem v-if="isRepost"
                :post="post"
                @is-repost="isRepost=false"/>
    <div>
        <div class="mb-4 w-1/2 mx-auto">
            <div class="mb-4 bg-white p-4 border border-gray-200">
                <div class="items-center">
                    <h2 class="mb-4 text-xl font-bold" :href="route('posts.show', post.id)">{{ post.title }}</h2>
                    <img class="mb-4 w-full object-cover" v-if="post.image_url" :src="post.image_url" :alt="post.title">
                    <p class="mb-4 text-gray-700" v-if="post.content">{{ post.content }}</p>
                    <div class="flex justify-end items-center">
                        <div class="mr-4">
                            <svg @click="isRepost = true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor" class="cursor-pointer size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m15 15 6-6m0 0-6-6m6 6H9a6 6 0 0 0 0 12h3"/>
                            </svg>

                        </div>
                        <div class="flex">
                            <span v-if="post.liked_by_profiles_count > 0" class="mr-1">
                            {{ post.liked_by_profiles_count }}</span>
                            <svg @click="toggleLike" xmlns="http://www.w3.org/2000/svg"
                                 :fill="post.is_liked ? 'red' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="cursor-pointer size-6 text-red-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                            </svg>
                        </div>

                    </div>
                    <div class="text-sm text-gray-500 mt-2"> Опубликовано: {{ post.published_at }}</div>
                </div>
            </div>


            <div class="mb-4 bg-white p-4 border border-gray-200">
                <div class="mb-4">
                    <h3 class="font-semibold">Оставить комментарий</h3></div>
                <div class="mb-4">
                    <textarea
                        class="border border-gray-300 w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500"
                        v-model="newCommentContent" placeholder="Ваш комментарий..."></textarea></div>
                <div class="mb-4">
                    <a @click.prevent="storeComment(null)"
                       href="#"
                       class="inline-block px-4 py-2 bg-emerald-700 text-white border border-emerald-800 rounded hover:bg-emerald-800 transition duration-150">
                        Отправить
                    </a>
                </div>
            </div>


            <div class="mb-4 bg-white p-4 border-b border-gray-200">
                <a v-if="post.comment_count > 0" href="#"
                   @click.prevent="showCommentsMethod()"
                   class="mb-4 text-sm text-blue-500 hover:underline">
                    {{ showComments ? 'Скрыть комментарии' : 'Показать комментарии' }} ({{ post.comment_count }})
                </a>

                <div class="mb-4" v-if="showComments && comments.length > 0">
                    <div v-if="post.comment_count > 0">

                        <div class="mb-4">
                            <a class="inline-block mr-2 px-2 py-1 bg-white border-gray border text-gray-700"
                               href="#"
                               v-for="page in comments_meta.links"
                               v-html="page.label"
                               @click.prevent="changePage(page.label)">
                            </a>
                        </div>

                        <CommentItem
                            v-for="comment in comments"
                            :comment="comment"
                            :post="post"
                        ></CommentItem>

                        <div class="mb-4">
                            <a class="inline-block mr-2 px-2 py-1 bg-white border-gray border text-gray-700"
                               href="#"
                               v-for="page in comments_meta.links"
                               v-html="page.label"
                               @click.prevent="changePage(page.label)">
                            </a>
                        </div>
                    </div>
                    <div v-else class="text-gray-500"> Комментариев пока нет. Будьте первым!
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import ClientLayout from "@/Layouts/ClientLayout.vue";
import CommentItem from "@/Components/Post/CommentItem.vue";
import RepostItem from "@/Components/Post/RepostItem.vue";

export default {
    name: "ShowPost",

    props: {
        post: Object,
    },

    layout: ClientLayout,

    components: {
        CommentItem,
        RepostItem
    },

    data() {
        return {
            newCommentContent: '',
            showComments: false,
            comments: Object,
            comments_meta: Object,
            filter: {page: 1},
            isRepost: false,
        }
    },


    methods: {
        showCommentsMethod() {
            this.indexComments();
            this.showComments = !this.showComments

        },
        changePage(page) {
            if (page === '&laquo; Previous') {
                if (this.filter.page > 1) {
                    this.filter.page = Number(this.filter.page) - 1;
                }
            } else if (page === 'Next &raquo;') {
                if (this.filter.page < this.comments_meta.last_page) {
                    console.log(this.filter.page);
                    this.filter.page = Number(this.filter.page ?? 0) + 1;
                }
            } else {
                this.filter.page = page;
            }


        },
        toggleLike() {
            axios.post(route('posts.likes.toggle', this.post.id))
                .then(res => {
                    this.post.is_liked = res.data.is_liked;
                    this.post.liked_by_profiles_count = res.data.like_count;
                })
                .catch(error => {
                    console.error("Ошибка при лайке поста:", error);
                });
        },

        storeComment(parentId) {
            if (!this.newCommentContent.trim()) {
                alert('Комментарий не может быть пустым');
                return;
            }

            const commentData = {
                content: this.newCommentContent,
                parent_id: parentId
            };

            axios.post(route('posts.comments.store', this.post.id), commentData)
                .then(res => {
                    console.log(res);
                    this.newCommentContent = '';
                    this.indexComments();
                })
                .catch(error => {
                    console.error("Ошибка при отправке корневого комментария:", error);

                });
        },

        indexComments() {
            axios.get(route('posts.comments.index', this.post.id), {
                params: this.filter
            })
                .then(res => {
                    this.comments = res.data.data;
                    this.comments_meta = res.data.meta;
                })
                .catch(error => {
                    console.error("Ошибка при загрузке комментариев:", error);
                    this.comments = [];
                });
        },


    },
    watch: {
        filter: {
            handler() {
                this.indexComments()
            },
            deep: true
        }
    }
}
</script>

<style>

</style>
