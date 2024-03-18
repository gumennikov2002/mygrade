<template>
    <Head title="Редактирование профиля"/>
    <h1>Редактрование профиля</h1>
</template>

<script lang="ts">
import { computed, defineComponent, DefineComponent, ref } from "vue";
import { Head, Link, usePage } from "@inertiajs/vue3";

export default defineComponent({
    components: {Head, Link },
    setup() {
        const page = usePage();
        const user = computed(() => page.props.user);

        return { user }
    },
});
</script>
