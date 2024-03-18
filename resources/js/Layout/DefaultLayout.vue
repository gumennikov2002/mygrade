<template>
    <Header />

    <div class="container">
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
