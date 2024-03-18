<template>
    <Head title="Главная страница" />
    <Header />
</template>

<script lang="ts">
import { defineComponent } from 'vue';
import Header from "../../Components/Header/Header.vue";
import { Head } from "@inertiajs/vue3";

export default defineComponent({
    components: { Head, Header }
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
