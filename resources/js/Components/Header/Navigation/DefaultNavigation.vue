<template class="d-flex justify-content-between">
    <NavigationMenuItems :menuItems="menuItems" />

    <div class="d-flex align-items-center">
        <Link href="/register" class="btn text-light mx-2">Создать аккаунт</Link>
        <Link href="/login" class="btn btn-outline-secondary text-light border-light">Войти</Link>
    </div>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";
import { HeaderNavigationBarMenuItem } from "../../../Types/types.ts";
import NavigationMenuItems from "./NavigationMenuItems.vue";

const page = usePage();
const user = computed(() => page.props.user);

const menuItems = ref<HeaderNavigationBarMenuItem[]>([
    { title: 'Ссылка 1', url: '#', icon: null },
    { title: 'Ссылка 2', url: '#', icon: null },
]);
</script>
