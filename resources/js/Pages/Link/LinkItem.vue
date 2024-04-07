<template>
    <Head :title="form.id ? 'Редактирование ссылки' : 'Создание ссылки'"/>
    <DefaultLayout>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />

        <h2 class="mb-3">{{ form.id ? 'Редактирование ссылки' : 'Создание ссылки' }}</h2>

        <template v-if="form.recentlySuccessful">
            <AlertSuccess message="Портфолио сохранено" />
        </template>

        <form @submit.prevent="save()" @input="form.clearErrors()" class="mt-4">
            <div class="form-check form-switch mb-3">
                <input
                    v-model="form.isActive"
                    class="form-check-input shadow-sm border-light"
                    type="checkbox"
                    id="isActive"
                    checked
                >
                <label class="form-check-label" for="isActive">Активен</label>
                <span class="text-danger" v-if="form.errors.isActive">{{ form.errors.isActive }}</span>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">
                    Название
                    <span class="text-danger">*</span>
                </label>
                <input
                    v-model="form.label"
                    placeholder="Придумайте название ссылки"
                    type="text"
                    class="form-control"
                    id="title"
                    required
                >
                <span class="text-danger" v-if="form.errors.label">{{ form.errors.label }}</span>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">
                    Ссылка
                    <span class="text-danger">*</span>
                </label>
                <input
                    v-model="form.href"
                    placeholder="Ссылка"
                    type="text"
                    class="form-control"
                    id="title"
                    required
                >
                <span class="text-danger" v-if="form.errors.href">{{ form.errors.href }}</span>
            </div>

            <div v-if="form.id" class="mb-3 d-flex flex-column">
                <small class="text-secondary">Создано: {{ formatDate(form.createdAt) }}</small>
                <small class="text-secondary">Последнее изменение: {{ formatDate(form.updatedAt) }}</small>
            </div>

            <div>
                <Link :href="`/portfolios/${portfolio.id}/edit`" class="btn btn-secondary shadow-sm">Назад</Link>
                <button type="submit" class="btn btn-light border-secondary shadow-sm mx-2">Сохранить</button>
            </div>
        </form>
    </DefaultLayout>
</template>

<script lang="ts" setup>
import { defineProps, PropType, ref } from 'vue';
import { Head, Link, useForm } from "@inertiajs/vue3";
import DefaultLayout from "../../Layout/DefaultLayout.vue";
import PortfolioData = App.Data.PortfolioData;
import { formatDate } from "../../Helpers/helpers";
import AlertSuccess from "../../Components/Page/AlertSuccess.vue";
import { Breadcrumb } from "../../Types/types";
import Breadcrumbs from "../../Components/Page/Breadcrumbs.vue";
import LinkData = App.Data.LinkData;

const props = defineProps({
    portfolio: {
        type: Object as PropType<PortfolioData>,
        required: true
    },
    link: {
        type: Object as PropType<LinkData>,
        required: false
    }
});

const form = useForm<LinkData>(props.link ?? {
    id: null,
    portfolioId: props.portfolio.id,
    isActive: true,
    label: null,
    href: null,
    sortOrder: 1,
});

const breadcrumbs = ref<Breadcrumb[]>([
    { title: 'Портфолио', url: '/portfolios' },
    { title: props.portfolio.title, url: `/portfolios/${props.portfolio.id}/edit` },
    { title: form.id ?  'Редактирование ссылки' : 'Создание ссылки' }
]);

const save = (): void => {
    const isUpdate = !!form.id;
    let url = `/portfolios/${props.portfolio.id}/links`;

    if (isUpdate) {
        url += `/${form.id}`
        form.put(url);
        return;
    }

    form.post(url);
}
</script>
