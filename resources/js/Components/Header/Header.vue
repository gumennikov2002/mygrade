<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-brand-dark py-3 mb-5">
        <div class="container">
            <Link href="/" class="navbar-brand text-brand-pink">MyGrade</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Меню">
                <i class="lni lni-menu text-brand-pink"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <template v-if="user">
                    <UserNavigation />
                </template>
                <template v-else>
                    <DefaultNavigation />
                </template>
            </div>
        </div>
    </nav>
</template>

<script lang="ts">
import { defineComponent, computed, ref } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";
import UserNavigation from "./Navigation/UserNavigation.vue";
import DefaultNavigation from "./Navigation/DefaultNavigation.vue";

export default defineComponent({
    components: { Link, UserNavigation, DefaultNavigation },
    setup() {
        const page = usePage();
        const user = computed(() => page.props.user);

        return { user }
    },
});
</script>
