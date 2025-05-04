<template>
    <div class="mb-4 p-4 border border-gray-200">

        <h3 class="mb-4 font-semibold" v-if="comment.profile">{{ comment.profile.name }}</h3>
        <h3 class="mb-4 font-semibold text-gray-500" v-else>[Удаленный пользователь]</h3>

        <p>{{ comment.content }}</p>

        <span class="text-sm text-gray-500">{{ comment.published_date }}</span>

        <div class="flex justify-between mt-2">
            <a @click.prevent="showReply(comment.id)"
               href="#"
               class="text-sm text-blue-500 hover:underline">
                Ответить
            </a>

            <div class="flex justify-end items-center">
                <span v-if="comment.liked_by_profiles_count > 0" class="mr-1">
                    {{ comment.liked_by_profiles_count }}
                </span>

                <svg @click="CommentToggleLike"
                     xmlns="http://www.w3.org/2000/svg"
                     :fill="comment.is_liked ? 'red' : 'none'" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="cursor-pointer size-6 text-red-500">

                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>

                </svg>
            </div>
        </div>

        <div v-if="openedReplyFormId === comment.id"
             class="reply-form mt-4">
            <div class="mb-4">
                 <textarea v-model="replyContent"
                           class="border border-gray-300 w-full p-2 rounded focus:outline-none focus:ring-2 focus:ring-emerald-500"
                           placeholder="Ваш ответ...">
                 </textarea>
            </div>
            <div class="mb-4">
                <a @click.prevent="storeComment(comment.id)"
                   href="#"
                   class="inline-block px-3 py-2 bg-emerald-700 text-white border border-emerald-800 rounded hover:bg-emerald-800 transition duration-150">
                    Ответить
                </a>
            </div>
        </div>

        <div class="mt-4">
            <a v-if="comment.subComments > 0" href="#"
               @click.prevent="getChildComments(comment.id)"
               class="text-sm text-blue-500 hover:underline">
                {{ showReplies ? 'Скрыть ответы' : 'Показать ответы' }} ({{ comment.subComments }})
            </a>

            <div v-if="showReplies && comment.subComments > 0"
                 class="mt-4 pl-4 border-l-2 border-gray-300">
                <CommentItem
                    v-for="comment in childComments"
                    :comment="comment"
                    :post="post"
                    @comment-action-triggered="$emit('comment-action-triggered')">
                </CommentItem>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CommentItem",

    props: {
        comment: Object,
        post: Object,
    },
    data() {
        return {
            openedReplyFormId: null,
            showReplies: false,
            replyContent: '',
            comments: Object,
            childComments: Object
        }
    },
    methods: {
        getChildComments(parentId) {

            this.showReplies = !this.showReplies;

            axios.get(route('posts.comments.child', parentId))
                .then(res => {
                    this.childComments = res.data;
                })
                .catch(error => {
                    console.error("Ошибка при загрузке комментариев:", error);
                    this.comments = [];
                });
        },
        showReply(commentId) {
            if (this.openedReplyFormId === commentId) {
                this.openedReplyFormId = null;
                this.replyContent = '';
            } else {
                this.openedReplyFormId = commentId;
            }
        },
        CommentToggleLike() {
            axios.post(route('comments.likes.toggle', this.comment.id))
                .then(res => {
                    this.comment.liked_by_profiles_count = res.data.like_count;
                    this.comment.is_liked = res.data.is_liked;
                })
                .catch(error => {
                    console.error("Ошибка при лайке комментария:", error);
                });
        },
        storeComment(parentId) {
            if (!this.replyContent.trim()) {
                alert('Комментарий не может быть пустым');
                return;
            }

            const commentData = {
                content: this.replyContent,
                parent_id: parentId
            };

            axios.post(route('posts.comments.store', this.post.id), commentData)
                .then(res => {
                    this.openedReplyFormId = null;
                    this.replyContent = '';
                    this.getChildComments(parentId);
                    this.comment.subComments++;
                    this.showReplies = true;
                })
                .catch(error => {
                    console.error("Ошибка при отправке корневого комментария:", error);
                });
        },

        indexComments() {
            axios.get(route('posts.comments.index', this.post.id))
                .then(res => {
                    console.log(res);
                    this.comments = res.data;
                })
                .catch(error => {
                    console.error("Ошибка при загрузке комментариев:", error);
                    this.comments = [];
                });

        }
    },
    watch: {
        'comment.id'(newId, oldId) {
            this.openedReplyFormId = null;
            this.showReplies = false;
            this.childComments = [];
        }
    }
}
</script>

<style scoped>
</style>
