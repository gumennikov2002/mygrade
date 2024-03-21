<template>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" v-for="item in breadcrumbs">
                <Link class="text-brand-pink" v-if="item.url" :href="item.url">{{ item.title }}</Link>
                <span v-else>{{ item.title }}</span>
            </li>
        </ol>
    </nav>
</template>

<script lang="ts" setup>
import { Link } from "@inertiajs/vue3";
import { PropType, defineProps } from "vue";
import { Breadcrumb } from "../../../Types/types";

const props = defineProps({
    breadcrumbs: {
        type: Array as PropType<Breadcrumb[]>,
        required: true
    }
})

</script>
