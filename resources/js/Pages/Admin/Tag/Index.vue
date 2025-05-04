<!--<template>-->
<!--    <div>-->
<!--        <div class="mb-4">-->
<!--            <Link :href="route('admin.tags.create')"-->
<!--                  class="inline-block px-3 py-2 bg-indigo-700 text-white border border-indigo-800">Добавить-->
<!--            </Link>-->
<!--        </div>-->
<!--        <div>-->
<!--            <div v-for="tag in localTags" class="mb-4 pb-4 border-b border-gray-200">-->

<!--                <Link :href="route('admin.tags.show', tag.id)"> {{ tag.title }}</Link>-->

<!--                <div class="inline-block px-3 py-2 bg-red-700 text-white border border-red-800"><a-->
<!--                    @click.prevent="deleteTag(tag.id)" href="#">Delete</a>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</template>-->

<template>
    <div class="container mx-auto px-4 py-6">
        <!-- Заголовок и кнопка добавления -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Управление тегами</h1>
            <Link
                :href="route('admin.tags.create')"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors flex items-center"
            >
                <PlusIcon class="w-5 h-5 mr-2"/>
                Добавить тег
            </Link>
        </div>

        <!-- Список тегов -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="tag in localTags"
                    :key="tag.id"
                    class="px-6 py-4 hover:bg-gray-50 transition-colors"
                >
                    <div class="flex items-center justify-between">
                        <!-- Название тега -->
                        <div class="flex items-center">
                            <TagIcon class="w-5 h-5 text-gray-400 mr-3"/>
                            <Link
                                :href="route('admin.tags.show', tag.id)"
                                class="text-lg font-medium text-indigo-600 hover:text-indigo-800 hover:underline"
                            >
                                {{ tag.title }}
                            </Link>
                        </div>

                        <!-- Кнопка удаления -->
                        <button
                            @click="deleteTag(tag.id)"
                            :disabled="isProcessing"
                            class="px-3 py-1 bg-red-100 text-red-600 rounded-md hover:bg-red-200 transition-colors flex items-center"
                        >
                            <TrashIcon class="w-4 h-4 mr-1"/>
                            <span>
                                {{ deletingId === tag.id && isProcessing ? 'Удаление...' : 'Удалить' }}
                            </span>
                        </button>
                    </div>
                </li>
            </ul>

            <!-- Пустое состояние -->
            <div
                v-if="localTags.length === 0"
                class="text-center py-12 text-gray-500"
            >
                <TagIcon class="w-12 h-12 mx-auto text-gray-300"/>
                <p class="mt-4">Теги не найдены</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3'; // Импортируем router
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { PlusIcon, TagIcon, TrashIcon } from '@heroicons/vue/24/outline';

defineOptions({ layout: AdminLayout });

const props = defineProps({
    tags: {
        type: Array,
        required: true,
        validator: value => value.every(item => item.id && item.title)
    }
});

const localTags = ref([...props.tags]);
const deletingId = ref(null);
const isProcessing = ref(false);

const deleteTag = async (id) => {
    if (!confirm('Удалить тег?')) return;

    deletingId.value = id;
    isProcessing.value = true;

    try {
        await router.delete(route('admin.tags.destroy', id), {
            preserveScroll: true,
            onSuccess: () => {
                localTags.value = localTags.value.filter(t => t.id !== id);
            },
            onError: (errors) => {
                alert(errors.message || 'Ошибка при удалении тега');
            }
        });
    } catch (error) {
        console.error('Ошибка:', error);
        alert('Произошла непредвиденная ошибка');
    } finally {
        deletingId.value = null;
        isProcessing.value = false;
    }
};
</script>

<style scoped>
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(30px);
}
</style>
