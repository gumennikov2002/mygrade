<template>
    <div class="card bg-dark text-white shadow-sm" :style="`width:${width}`">
        <img src="https://proza.ru/pics/2015/10/02/461.jpg" class="card-img">
        <div class="card-img-overlay bg-brand-dark" style="opacity: 0.8">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { defineProps } from 'vue';

const props = defineProps({
    work: {
        type: Object,
        required: true
    },
    width: {
        type: String,
        required: false,
        default: 'auto'
    }
});
</script>
