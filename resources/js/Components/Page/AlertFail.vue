<template>
    <div class="d-flex align-items-center alert alert-danger">
        <i class="lni lni-warning bg-light text-danger p-1 rounded-5"></i>
        <span class="px-2">{{ message }}</span>
    </div>
</template>

<script lang="ts" setup>
import { defineProps } from 'vue';

const props = defineProps({
    message: {
        type: String,
        required: false,
        default: 'Произошла ошибка'
    }
})
</script>
