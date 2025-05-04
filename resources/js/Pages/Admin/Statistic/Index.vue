<template>
    <div>
        <div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="table-auto min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Дата
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Кол-во постов
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            кол-во комментов
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            кол-во лайков
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            отношение лайков к постам
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            отношение лайков к комментариям
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            кол-во просмотров
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="statistic in statistics" class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{statistic.created_at}}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">{{ statistic.post_count }}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">{{ statistic.comment_count }}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">{{ statistic.like_count }}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">{{ statistic.post_like_count }}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">{{ statistic.comment_like_count }}</td>
                        <td class="px-6 py-4 whitespace-normal text-sm text-gray-500">{{ statistic.view_count }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",
    props: {
        statistics: Array
    },
    layout: AdminLayout,
}
</script>

<style scoped>

</style>
