<template class="d-flex justify-content-between">
    <ul v-if="menuItems.length" class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item" v-for="(item, key) in menuItems" :key="key">
            <div class="d-flex align-items-center mx-3">
                <i v-if="item.icon" style="font-size: 30px" class="lni text-white" :class="'lni-' + item.icon"></i>
                <Link class="nav-link" :href="item.url">{{ item.title }}</Link>
            </div>
        </li>
    </ul>

    <div>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ user.name + '@' + user.username }}
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-light bg-brand-dark">
                    <li><a class="dropdown-item text-light" href="#">Профиль</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <Link class="dropdown-item text-danger" href="/logout" as="button" method="post">Выйти</Link>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</template>

<script lang="ts">
import { defineComponent, computed, ref } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";
import { HeaderNavigationBarMenuItem } from "../../../Types/types.ts";

export default defineComponent({
    components: { Link },
    setup() {
        const page = usePage();
        const user = computed(() => page.props.user);

        const menuItems = ref<HeaderNavigationBarMenuItem[]>([
            { title: 'Дашборд', url: '/dashboard', icon: 'dashboard' },
            { title: 'Портфолио', url: '#', icon: 'briefcase' },
            { title: 'Сообщения', url: '#', icon: 'envelope' },
            { title: 'Заявки', url: '#', icon: 'support' },
        ])

        return { user, menuItems }
    },
});
</script>
