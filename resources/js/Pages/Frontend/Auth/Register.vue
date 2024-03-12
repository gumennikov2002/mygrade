<template>
    <Header />

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="d-flex align-items-center justify-content-center">
                    <form
                        @submit.prevent="form.post('/register')"
                        @input="form.clearErrors()"
                        class="w-100"
                    >
                        <h2>Регистрация</h2>
                        <div class="mb-3">
                            <label for="name" class="form-label">Имя</label>
                            <input
                                v-model="form.name"
                                id="name"
                                type="text"
                                class="form-control"
                                placeholder="Введите имя или псевдоним"
                            >
                            <span class="text-danger" v-if="form.errors.name">{{ form.errors.name }}</span>
                        </div>
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
                        <div v-if="form.password" class="mb-3">
                            <label for="passwordConfirmation" class="form-label">Повторите пароль</label>
                            <input
                                v-model="form.password_confirmation"
                                id="passwordConfirmation"
                                type="password"
                                class="form-control"
                                placeholder="Повторите пароль"
                            >
                        </div>
                        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
            </div>
        </div>

</template>

<script lang="ts">
import { defineComponent, ref } from 'vue';
import Header from '@/Components/Frontend/Header.vue';
import { useForm } from '@inertiajs/vue3'

export default defineComponent({
    components: { Header },
    setup() {
        const form = useForm({
            email: null as String | null,
            name: null as String | null,
            password: null as String | null,
            password_confirmation: null as String | null
        })

        return { form }
    }
});
</script>
