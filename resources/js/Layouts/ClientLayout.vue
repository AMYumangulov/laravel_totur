<template>
    <section class="w-full">
        <header class="mx-auto p-4">
            HEADER
        </header>
    </section>
    <section class="w-full bg-gray-50">
        <section class="mx-auto flex">
        <article class="w-3/4 p-4 mx-auto">
            <slot />
        </article>
        </section>
    </section>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "ClientLayout",
    components:{
        Link
    }
}
</script>


<style scoped>

</style>
