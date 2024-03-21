<template>
    <Head title="Регистрация"/>
    <DefaultLayout>
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
                        <button type="submit" class="btn btn-light border-secondary shadow-sm">Зарегистрироваться</button>
                    </form>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import DefaultLayout from "../../Layout/DefaultLayout.vue";
import { useForm } from '@inertiajs/vue3'
import RegisterUserData = App.Data.Auth.RegisterUserData;

const form = useForm<RegisterUserData>({
    email: null,
    name: null,
    password: null,
    password_confirmation: null
})
</script>
