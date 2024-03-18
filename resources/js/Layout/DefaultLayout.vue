<template>
    <Header />

    <div class="container bg-white py-5 p-5 rounded-3 shadow-sm">
        <slot />
    </div>
</template>

<script lang="ts">
import {defineComponent} from "vue";
import Header from "../Components/Header/Header.vue";

export default defineComponent({
    components: { Header },
})
</script>
