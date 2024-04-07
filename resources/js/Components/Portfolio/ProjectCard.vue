<template>
    <div class="card bg-dark text-white shadow-sm" :style="`width:${width}`">
        <img :src="project.cover ?? 'https://proza.ru/pics/2015/10/02/461.jpg'" class="card-img">
        <div class="card-img-overlay bg-brand-dark" style="opacity: 0.8">
            <h5 class="card-title">{{ project.title }}</h5>
            <p class="card-text">{{ project.description }}</p>
        </div>
    </div>
</template>

<script lang="ts" setup>
import {defineProps, PropType} from 'vue';
import ProjectData = App.Data.ProjectData;

const props = defineProps({
    project: {
        type: Object as PropType<ProjectData>,
        required: true
    },
    width: {
        type: String,
        required: false,
        default: 'auto'
    }
});
</script>
