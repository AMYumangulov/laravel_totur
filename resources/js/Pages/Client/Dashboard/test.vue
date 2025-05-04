<template>
    <div class="relative overflow-x-auto">
        <table class="w-full">
            <thead>
            <tr>
                <th
                    v-for="(column, index) in columns"
                    :key="index"
                    :style="{ width: column.width + 'px' }"
                    class="px-4 py-2 relative"
                >
                    {{ column.label }}
                    <div
                        v-if="index < columns.length - 1"
                        class="absolute top-0 bottom-0 right-0 w-1 bg-gray-300 cursor-col-resize"
                        @mousedown="startResize($event, index)"
                    ></div>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td
                    v-for="(column, index) in columns"
                    :key="index"
                    :style="{ width: column.width + 'px' }"
                    class="px-4 py-2"
                >
                    Данные {{ index + 1 }}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { ref } from 'vue';

const columns = ref([
    { label: 'Столбец 1', width: 150 },
    { label: 'Столбец 2', width: 200 },
    { label: 'Столбец 3', width: 100 },
]);

const resizingColumnIndex = ref(null);
const startX = ref(0);
const startWidth = ref(0);

const startResize = (event, index) => {
    resizingColumnIndex.value = index;
    startX.value = event.clientX;
    startWidth.value = columns.value[index].width;
    document.addEventListener('mousemove', resize);
    document.addEventListener('mouseup', stopResize);
};

const resize = (event) => {
    if (resizingColumnIndex.value !== null) {
        const delta = event.clientX - startX.value;
        const newWidth = startWidth.value + delta;
        columns.value[resizingColumnIndex.value].width = Math.max(50, newWidth); // Ограничение минимальной ширины
    }
};

const stopResize = () => {
    resizingColumnIndex.value = null;
    document.removeEventListener('mousemove', resize);
    document.removeEventListener('mouseup', stopResize);
};
</script>

<style scoped>
.cursor-col-resize {
    user-select: none; /* Предотвращает выделение текста при перетаскивании */
}
</style>
