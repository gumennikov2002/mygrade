<template class="d-flex justify-content-between">
    <NavigationMenuItems :menuItems="menuItems" />

    <div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ user.name + '@' + user.username }}
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-light bg-brand-dark">
                    <li>
                        <Link class="dropdown-item text-light" href="/profile">Профиль</Link>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <Link class="dropdown-item text-danger" href="/logout" as="button" method="post">Выйти</Link>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";
import NavigationMenuItems from "./NavigationMenuItems.vue";
import { HeaderNavigationBarMenuItem } from "../../../Types/types";

const page = usePage();
const user = computed(() => page.props.user);

const menuItems = ref<HeaderNavigationBarMenuItem[]>([
    { title: 'Дашборд', url: '/dashboard', icon: 'dashboard' },
    { title: 'Портфолио', url: '/portfolios', icon: 'briefcase' },
    { title: 'Заявки', url: '#', icon: 'support' },
])
</script>
