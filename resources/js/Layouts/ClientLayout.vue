<template>
    <section class="w-full">
        <header class="mx-auto p-4 container">
            <nav>
                <ul class="container flex justify-between">
                    <li>
                        <Link :href="route('dashboard')" class="text-indigo-600 hover:text-indigo-900">
                            HEADER
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('profiles.index')" class="text-indigo-600 hover:text-indigo-900">
                            Профили
                        </Link>
                    </li>
                </ul>
            </nav>
        </header>
    </section>
    <section class="w-full bg-gray-50">
        <section class="mx-auto flex">
            <article class="w-3/4 p-4 mx-auto">
                <slot/>
            </article>
        </section>
    </section>
</template>

<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "ClientLayout",
    components: {
        Link
    }
}
</script>


<style scoped>

</style>
