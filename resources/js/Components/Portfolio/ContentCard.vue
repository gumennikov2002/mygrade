<template>
    <div>
        <span v-if="title" class="h1">{{ title }}</span>
        <div class="mt-3">
            <slot />
        </div>
    </div>
</template>

<script lang="ts" setup>
import { defineProps } from 'vue';

const props = defineProps({
    title: String
});
</script>
