<template>
    <div class="d-flex align-items-center alert alert-success bg-brand-pink">
        <i class="lni lni-thumbs-up bg-light text-brand-pink p-1 rounded-5"></i>
        <span class="px-2">{{ message }}</span>
    </div>
</template>

<script lang="ts" setup>
import { defineProps } from 'vue';

const props = defineProps({
    message: {
        type: String,
        required: true
    }
})
</script>
