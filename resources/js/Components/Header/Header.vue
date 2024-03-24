<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-brand-dark py-3 mb-5 shadow-sm">
        <div class="container">
            <Link href="/" class="navbar-brand text-brand-pink">
                <Logo width="110" height="30"/>
            </Link>
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

<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";
import UserNavigation from "./Navigation/UserNavigation.vue";
import DefaultNavigation from "./Navigation/DefaultNavigation.vue";
import Logo from "../Logo.vue";

const page = usePage();
const user = computed(() => page.props.user);
</script>
