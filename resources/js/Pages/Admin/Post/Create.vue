<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.posts.index')"
                  class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800">Назад
            </Link>
        </div>
        <div v-if="success" class="w-full p-4 bg-emerald-600 text-white mb-4">
            Пост создан
        </div>
        <div class="mb-4">
            <input v-model="enteries.post.title" type="text" placeholder="title" class="border border-gray-200 w-1/3">
        </div>
        <div v-if="errors['post.title']" class="text-red-600">
            <p v-for="error in errors['post.title']">{{ error }}</p>
        </div>
        <div class="mb-4">
            <textarea v-model="enteries.post.content" type="text" placeholder="content"
                      class="border border-gray-200 w-1/3"></textarea>
        </div>
        <div v-if="errors['post.content']" class="text-red-600">
            <p v-for="error in errors['post.content']">{{ error }}</p>
        </div>
        <div class="mb-4">
            <input v-model="enteries.post.published_at" type="datetime-local" placeholder="date"
                   class="border border-gray-200 w-1/3">
        </div>
        <div v-if="errors['post.published_at']" class="text-red-600">
            <p v-for="error in errors['post.published_at']">{{ error }}</p>
        </div>
        <div class="mb-4">
            <input ref="input_image" @change="addImage" type="file" class="border border-gray-200 w-1/3">
        </div>
        <div v-if="errors['image']" class="text-red-600">
            <p v-for="error in errors['image']">{{ error }}</p>
        </div>
        <div class="mb-4">
            <input v-model="enteries.tags" type="text" placeholder="tags" class="border border-gray-200 w-1/3">
        </div>
        <div v-if="errors['tags']" class="text-red-600">
            <p v-for="error in errors['tags']">{{ error }}</p>
        </div>
        <div class="mb-4">
            <select v-model="enteries.post.category_id" class="border border-gray-200 w-1/3">
                <option value="null" disabled selected>Выберите категорию</option>
                <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
            </select>
        </div>
        <div v-if="errors['post.category_id']" class="text-red-600">
            <p v-for="error in errors['post.category_id']">{{ error }}</p>
        </div>
        <div class="mb-4">
            <a @click.prevent="storePost" href="#"
               class="inline-block px-3 py-2 bg-emerald-700 text-white border border-emerald-800">Создать</a>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Create",
    props: {
        posts: Array,
        categories: Array
    },
    layout: AdminLayout,
    components: {
        Link
    },

    data() {
        return {
            enteries: {
                post: {
                    category_id: null
                },
                tags: '',
                image: ''
            },
            errors: {},
            success: false
        }
    },
    methods: {
        storePost() {
            const formData = {
                ...this.enteries
            };

            formData.post.published_at = this.formatDateTime(this.enteries.post.published_at);

            axios.post(route('admin.posts.store'), formData, {
                    'headers': {
                        'Content-Type': "multipart/form-data"
                    }
                }
            )
                .then(res => {
                    console.log(res);
                    this.enteries = {
                        post: {
                            category_id: null
                        },
                        tags: ''
                    }
                    this.$refs.input_image.value = null
                    this.errors = {}
                    this.$nextTick(() => {
                        this.success = true
                    })
                })
                .catch(error => {
                    this.errors = error.response.data.errors
                })
            //.finally(res =>{})
        },
        formatDateTime(datetime) {
            if (!datetime) return null;
            return datetime.replace('T', ' ');
        },
        addImage(e) {
            this.enteries.image = e.target.files[0];
        }
    },
    watch: {
        enteries: {
            handler() {
                this.success = false
            },
            deep: true
        }
    }

}
</script>

<style scoped>

</style>
