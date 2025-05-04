<template>
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Посты</h1>
            <Link
                :href="route('admin.posts.create')"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                          clip-rule="evenodd"/>
                </svg>
                Добавить пост
            </Link>
        </div>

        <!-- Фильтры -->
        <div class="grid grid-cols-3 gap-4 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Заголовок</label>
                <input
                    v-model="filter.title"
                    type="text"
                    placeholder="Поиск по заголовку"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Контент</label>
                <input
                    v-model="filter.content"
                    type="text"
                    placeholder="Поиск по контенту"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Категория</label>
                <select
                    v-model="filter.category_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-gray-800"
                >
                    <option value="" selected>Все категории</option>
                    <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Профиль</label>
                <select
                    v-model="filter.profile_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 text-gray-800"
                >
                    <option value="" selected>Все профили</option>
                    <option v-for="profile in profiles" :value="profile.id">{{ profile.name }}</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Дата публикации от</label>
                <input
                    v-model="filter.published_at_from"
                    type="date"
                    placeholder="Дата публикации от"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Дата публикации до</label>
                <input
                    v-model="filter.published_at_to"
                    type="date"
                    placeholder="Дата публикации до"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <!--            <div class="flex items-end">-->
            <!--                <button-->
            <!--                    @click="getPosts"-->
            <!--                    class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors flex items-center justify-center"-->
            <!--                >-->
            <!--                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">-->
            <!--                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />-->
            <!--                    </svg>-->
            <!--                    Применить-->
            <!--                </button>-->
            <!--            </div>-->
        </div>

        <!-- Таблица -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="table-auto min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Заголовок
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Контент
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Категория
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Профиль
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Дата публикации
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Действия
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="post in postsData.data" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        <Link :href="route('admin.posts.show', post.id)" class="text-indigo-600 hover:text-indigo-900">
                            {{ post.title }}
                        </Link>
                    </td>
                    <td class="px-6 py-4 whitespace-normal  text-sm text-gray-500">{{ post.short_content }}</td>
                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">{{ post.category.title }}</td>
                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">{{ post.profile.name }}</td>
                    <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">{{ post.published_at }}</td>
                    <td class="px-6 py-4 whitespace-normal text-sm font-medium">
                        <Link
                            :href="route('admin.posts.edit', post.id)"
                            class="text-emerald-600 hover:text-red-900 flex items-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            Редактировать
                        </Link>
                        <button
                            @click.prevent="deletePost(post)"
                            class="text-red-600 hover:text-red-900 flex items-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                      clip-rule="evenodd"/>
                            </svg>
                            Удалить
                        </button>
                    </td>
                </tr>
                <div>
                    <a class="inline-block mr-2 px-2 py-1 bg-white border-gray border text-gray-700"
                       href="#"
                       v-for="page in postsData.meta.links"
                       v-html="page.label"
                       @click.prevent="changePage(page.label)">
                    </a>
                </div>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",
    props: {
        posts: {},
        profiles: Array,
        categories: Array,
    },
    layout: AdminLayout,

    components: {
        Link
    },
    data() {
        return {
            filter: {
                profile_id: "",
                category_id: "",
            },
            postsData: this.posts // после этого в цикле где отображаются посты надо поменять объект
        }
    },
    methods: {
        changePage(page) {
            if (page === '&laquo; Previous') {
                if (this.filter.page > 1) {
                    this.filter.page = Number(this.filter.page) - 1;
                }
            } else if (page === 'Next &raquo;') {
                if (this.filter.page < this.postsData.meta.last_page) {
                    this.filter.page = Number(this.filter.page) + 1;
                }
            } else {
                this.filter.page = page;
            }


        },
        getposts() {
            axios.get(route('admin.posts.index'), {
                params: this.filter
            })
                .then(res => {
                    console.log(res);
                    this.postsData = res.data
                    var urlQuery = ''
                    for (var key in this.filter) {
                        var value = this.filter[key]
                        if (value) {
                            if (urlQuery === '') {
                                urlQuery = key + '=' + value
                            } else {
                                urlQuery = urlQuery + '&' + key + '=' + value
                            }
                        }
                    }

                    if (urlQuery !== '') {
                        window.history.replaceState(null, '', 'posts' + '?' + urlQuery);
                    }

                    if (this.postsData.meta.last_page < this.filter.page) {
                        this.filter.page = 1
                    }
                })
        },
        deletePost(post) {
            axios.delete(route('admin.posts.destroy', post.id))
                .then(res => {
                    this.postsData.data = this.postsData.data.filter(postData => postData !== post) //этот вариант если нет пагинации
                })
        },
        updatePost(post) {
            axios.get(route('admin.posts.edit', post.id))
                .then(res => {
                })
        }
    },
    watch: {
        filter: {
            handler() {
                this.getposts()
            },
            deep: true
        }
    }
}
</script>

<style scoped>

</style>
