<template>
    <Head title="Редактирование профиля"/>

    <DefaultLayout>
        <h2 class="mb-4">Редактрование профиля</h2>
        <div v-if="form.recentlySuccessful" class="d-flex align-items-center alert alert-success">
            <i class="lni lni-thumbs-up bg-light text-success p-1 rounded-5"></i>
            <span class="px-2">Информация успешно обновлена</span>
        </div>

        <div v-if="form.hasErrors" class="d-flex align-items-center alert alert-danger">
            <i class="lni lni-warning bg-light text-danger p-1 rounded-5"></i>
            <span class="px-2">Произошла ошибка</span>
        </div>

        <form
            @submit.prevent="form.put('/profile')"
            @input="form.clearErrors()"
            class="w-100"
        >
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
                <label for="name" class="form-label">Имя/Псевдоним</label>
                <input
                    v-model="form.name"
                    id="name"
                    type="text"
                    class="form-control"
                    placeholder="Введите Имя или псевдоним"
                >
                <span class="text-danger" v-if="form.errors.name">{{ form.errors.name }}</span>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input
                    v-model="form.username"
                    id="username"
                    type="text"
                    class="form-control"
                    placeholder="Введите username"
                >
                <span class="text-danger" v-if="form.errors.username">{{ form.errors.username }}</span>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Новый пароль</label>
                <input
                    v-model="form.password"
                    id="password"
                    type="password"
                    class="form-control"
                    placeholder="Придумайте пароль"
                >
                <span class="text-danger" v-if="form.errors.password">{{ form.errors.password }}</span>
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </form>
    </DefaultLayout>
</template>

<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import DefaultLayout from "../../Layout/DefaultLayout.vue";
import { computed } from "vue";
import { usePage, useForm } from "@inertiajs/vue3";
import {UserUpdateForm} from "../../Types/types";

const page = usePage();
const user = computed(() => page.props.user);

const form = useForm<UserUpdateForm>({
    email: user.value.email,
    name: user.value.name,
    username: user.value.username,
    password: null
})
</script>
