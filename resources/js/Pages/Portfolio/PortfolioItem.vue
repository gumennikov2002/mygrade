<template>
    <Head title="Создание портфолио"/>
    <DefaultLayout>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />

        <h2 class="mb-3">{{ form.id ? 'Редактирование портфолио' : 'Создание портфолио' }}</h2>

        <template v-if="form.recentlySuccessful">
            <AlertSuccess message="Портфолио сохранено" />
        </template>

        <form @submit.prevent="save()" @input="form.clearErrors()">
            <div class="form-check form-switch mb-3">
                <input
                    v-model="form.isActive"
                    class="form-check-input bg-success shadow-sm border-light"
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
                    @input="slugifyTitle()"
                    placeholder="Придумайте название вашего портфолио"
                    type="text"
                    class="form-control"
                    id="title"
                    required
                >
                <span class="text-danger" v-if="form.errors.title">{{ form.errors.title }}</span>
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">
                    URL (Slug)
                    <span class="text-danger">*</span>
                </label>
                <input
                    v-model="form.slug"
                    placeholder="Slug по которому будет доступно портфолио"
                    type="text"
                    class="form-control"
                    id="slug"
                    required
                >
                <span class="text-danger" v-if="form.errors.slug">{{ form.errors.slug }}</span>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Описание</label>
                <textarea
                    v-model="form.description"
                    placeholder="Описание, можно использовать как заметки"
                    class="form-control"
                    id="description"
                    rows="3"
                >
                </textarea>
                <span class="text-danger" v-if="form.errors.description">{{ form.errors.description }}</span>
            </div>

            <div v-if="form.id" class="mb-3 d-flex flex-column">
                <small class="text-secondary">Создано: {{ formatDate(form.createdAt) }}</small>
                <small class="text-secondary">Последнее изменение: {{ formatDate(form.updatedAt) }}</small>
            </div>

            <div>
                <Link href="/portfolios" class="btn btn-secondary shadow-sm">Назад</Link>
                <button type="submit" class="btn btn-light border-secondary shadow-sm mx-2">Сохранить</button>
            </div>
        </form>
    </DefaultLayout>
</template>

<script lang="ts" setup>
import { Head, useForm, Link } from "@inertiajs/vue3";
import { defineProps, PropType, ref } from "vue";
import { Breadcrumb } from "../../Types/types";
import Breadcrumbs from "../../Components/Page/Breadcrumbs.vue";
import AlertSuccess from "../../Components/Page/AlertSuccess.vue";
import DefaultLayout from "../../Layout/DefaultLayout.vue";
import { formatDate, slugify } from "../../Helpers/helpers";
import PortfolioData = App.Data.Portfolio.PortfolioData;

const props = defineProps({
    portfolio: {
        type: Object as PropType<PortfolioData>,
        required: false
    },
});

const form = useForm<PortfolioData>(props.portfolio ?? {
    id: null,
    slug: null,
    isActive: true,
    title: null,
    description: null,
    createdAt: null,
    updatedAt: null
});

const slugifyTitle = (): void => {
    form.slug = slugify(form.title);
}

const breadcrumbs = ref<Breadcrumb[]>([
    { title: 'Портфолио', url: '/portfolios' },
    { title: form.id ?  'Редактирование портфолио' : 'Создание портфолио' }
]);

const save = (): void => {
    const isUpdate = !!form.id;

    if (isUpdate) {
        form.put(`/portfolios/${form.id}`);
        return;
    }

    form.post('/portfolios');
}
</script>
