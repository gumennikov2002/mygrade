<template>
    <Head title="Войти в аккаунт"/>
    <Header />

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="d-flex align-items-center justify-content-center">
                    <form
                        @submit.prevent="form.post('/login')"
                        @input="form.clearErrors()"
                        class="w-100"
                    >
                        <h2>Войти в аккаунт</h2>
                        <div class="mb-3">
                            <label for="email" class="form-label">Адрес электронной почты</label>
                            <input
                                v-model="form.email"
                                id="email"
                                type="email"
                                class="form-control"
                                placeholder="Введите email"
                            >
                            <span class="text-danger" v-if="form.errors.email">{{ form.errors.email }}</span>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Пароль</label>
                            <input
                                v-model="form.password"
                                id="password"
                                type="password"
                                class="form-control"
                                placeholder="Придумайте пароль"
                            >
                            <span class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
                        </div>
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </form>
                </div>
            </div>
            </div>
        </div>

</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import { Head } from "@inertiajs/vue3";
import Header from "../../../Components/Header/Header.vue";
import { useForm } from '@inertiajs/vue3'

export default defineComponent({
    components: { Head, Header },
    setup() {
        const form = useForm({
            email: null as String | null,
            password: null as String | null
        })

        return { form }
    }
});
</script>
