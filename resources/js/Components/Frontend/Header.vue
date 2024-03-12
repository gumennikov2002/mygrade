<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 mb-5">
        <div class="container">
            <Link href="/" class="navbar-brand">MyGrade</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <template v-if="user">
                        <Link href="#" class="text-light mx-4">{{ user.name }}</Link>
                        <Link href="/logout" method="post" class="btn btn-outline-secondary text-light border-light">Выйти</Link>
                    </template>
                    <template v-else>
                        <Link href="/register" class="btn text-light mx-2">Создать аккаунт</Link>
                        <Link href="/login" class="btn btn-outline-secondary text-light border-light">Войти</Link>
                    </template>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
import { defineComponent, computed } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";

export default defineComponent({
    components: { Link },
    setup() {
        const page = usePage()
        const user = computed(() => page.props.user)

        return { user }
    },
});
</script>
