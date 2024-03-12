<template>
    <Header />
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import Header from '@/Components/Frontend/Header.vue';

export default defineComponent({
    components: { Header }
});
</script>

<style scoped>
.center-div {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
