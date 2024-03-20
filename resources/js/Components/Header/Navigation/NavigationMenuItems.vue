<template>
    <ul v-if="menuItems.length" class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item" v-for="(item, key) in menuItems" :key="key">
            <Link class="nav-link d-flex align-items-center mx-2" :class="{'active':isActive(item)}" :href="item.url">
                <i v-if="item.icon" style="font-size: 30px" class="mx-2" :class="getIconClass(item)"></i>
                <span>{{ item.title }}</span>
            </Link>
        </li>
    </ul>
</template>

<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";
import { HeaderNavigationBarMenuItem } from "../../../Types/types";

const props = defineProps({
    menuItems: {
        type: Array,
        required: false
    }
})

const isActive = (menuItem: HeaderNavigationBarMenuItem) => {
    return menuItem.url === window.location.pathname
}

const getIconClass = (menuItem: HeaderNavigationBarMenuItem) => 'lni lni-' + menuItem.icon
</script>
