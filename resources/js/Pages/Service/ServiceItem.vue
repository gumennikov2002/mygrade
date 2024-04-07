<template>
    <Head :title="form.id ? 'Редактирование услуги' : 'Создание услуги'"/>
    <DefaultLayout>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />

        <h2 class="mb-3">{{ form.id ? 'Редактирование услуги' : 'Создание услуги' }}</h2>

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
                    v-model="form.title"
                    placeholder="Придумайте название услуги"
                    type="text"
                    class="form-control"
                    id="title"
                    required
                >
                <span class="text-danger" v-if="form.errors.title">{{ form.errors.title }}</span>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea
                    v-model="form.description"
                    placeholder="Описание, можно использовать как заметки"
                    class="form-control"
                    id="description"
                    rows="3"
                />
                <span class="text-danger" v-if="form.errors.description">{{ form.errors.description }}</span>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">
                    Цена, руб.
                    <span class="text-danger">*</span>
                </label>
                <input
                    v-model="form.price"
                    placeholder="Цена услуги"
                    type="number"
                    min="0"
                    step="1"
                    class="form-control"
                    id="price"
                    required
                >
                <span class="text-danger" v-if="form.errors.price">{{ form.errors.price }}</span>
            </div>

            <div class="mb-3">
                <input
                    v-model="form.isFinalPrice"
                    type="checkbox"
                    class="form-check-input"
                    id="isFinalPrice"
                >
                <label for="isFinalPrice" class="form-check-label mx-2">Финальная цена</label>
                <span class="text-danger" v-if="form.errors.isFinalPrice">{{ form.errors.isFinalPrice }}</span>
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
import ServiceData = App.Data.ServiceData;
import PortfolioData = App.Data.PortfolioData;
import { formatDate } from "../../Helpers/helpers";
import AlertSuccess from "../../Components/Page/AlertSuccess.vue";
import { Breadcrumb } from "../../Types/types";
import Breadcrumbs from "../../Components/Page/Breadcrumbs.vue";

const props = defineProps({
    portfolio: {
        type: Object as PropType<PortfolioData>,
        required: true
    },
    service: {
        type: Object as PropType<ServiceData>,
        required: false
    }
});

const form = useForm<ServiceData>(props.service ?? {
    portfolioId: props.portfolio.id,
    isActive: true,
    title: null,
    description: null,
    price: 0,
    isFinalPrice: true,
    sortOrder: 1
});

const breadcrumbs = ref<Breadcrumb[]>([
    { title: 'Портфолио', url: '/portfolios' },
    { title: props.portfolio.title, url: `/portfolios/${props.portfolio.id}/edit` },
    { title: form.id ?  'Редактирование услуги' : 'Создание услуги' }
]);

const save = (): void => {
    const isUpdate = !!form.id;
    let url = `/portfolios/${props.portfolio.id}/services`;

    if (isUpdate) {
        url += `/${form.id}`
        form.put(url);
        return;
    }

    form.post(url);
}
</script>
