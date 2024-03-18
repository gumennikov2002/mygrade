<template class="d-flex justify-content-between">
    <ul v-if="menuItems.length" class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item" v-for="(item, key) in menuItems" :key="key">
            <div class="d-flex align-items-center mx-3">
                <i v-if="item.icon" style="font-size: 30px" class="lni text-white" :class="'lni-' + item.icon"></i>
                <Link class="nav-link" :href="item.url">{{ item.title }}</Link>
            </div>
        </li>
    </ul>
    <div class="d-flex align-items-center">
        <Link href="/register" class="btn text-light mx-2">Создать аккаунт</Link>
        <Link href="/login" class="btn btn-outline-secondary text-light border-light">Войти</Link>
    </div>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";
import { HeaderNavigationBarMenuItem } from "../../../Types/types.ts";

const page = usePage();
const user = computed(() => page.props.user);

const menuItems = ref<HeaderNavigationBarMenuItem[]>([
    { title: 'Ссылка 1', url: '#', icon: null },
    { title: 'Ссылка 2', url: '#', icon: null },
]);
</script>
