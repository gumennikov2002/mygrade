<template>
    <Head :title="form.id ? 'Редактирование проекта' : 'Создание проекта'"/>
    <DefaultLayout>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />

        <h2 class="mb-3">{{ form.id ? 'Редактирование проекта' : 'Создание проекта' }}</h2>

        <template v-if="coverForm.recentlySuccessful">
            <AlertSuccess message="Обложка сохранена" />
        </template>

        <form v-if="form.id" @submit.prevent="saveCover()">
            <div class="mb-2">
                <img class="rounded-3" width="300px" :src="uploadedCover || form.cover">
            </div>

            <input
                @change="uploadCover($event)"
                type="file"
                class="form-control"
                id="cover"
            >
            <span class="text-danger" v-if="coverForm.errors.cover">{{ coverForm.errors.cover }}</span>

            <button v-if="coverForm.cover" type="submit" class="btn btn-light border-secondary border-1 mt-2">Сохранить</button>
        </form>

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
            <div v-if="!form.id" class="mb-3">
                <label for="cover" class="form-label">
                    Обложка
                    <span class="text-danger">*</span>
                </label>
                <input
                    @change="uploadCover($event)"
                    type="file"
                    class="form-control"
                    id="cover"
                >
                <span class="text-danger" v-if="form.errors.cover">{{ form.errors.cover }}</span>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">
                    Название
                    <span class="text-danger">*</span>
                </label>
                <input
                    v-model="form.title"
                    placeholder="Придумайте название проекта"
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
                >
                        </textarea>
                <span class="text-danger" v-if="form.errors.description">{{ form.errors.description }}</span>
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
import ProjectData = App.Data.ProjectData;
import ProjectCoverData = App.Data.ProjectCoverData;

const props = defineProps({
    portfolio: {
        type: Object as PropType<PortfolioData>,
        required: true
    },
    project: {
        type: Object as PropType<ProjectData>,
        required: false
    }
});

const form = useForm<ProjectData>(props.project ?? {
    portfolioId: props.portfolio.id,
    isActive: true,
    title: null,
    description: null,
    cover: null,
    sortOrder: 1,
});

const uploadedCover = ref<null|ArrayBuffer>(null);

const coverForm = useForm<ProjectCoverData>({
    cover: null
})

const breadcrumbs = ref<Breadcrumb[]>([
    { title: 'Портфолио', url: '/portfolios' },
    { title: props.portfolio.title, url: `/portfolios/${props.portfolio.id}/edit` },
    { title: form.id ?  'Редактирование проекта' : 'Создание проекта' }
]);

const uploadCover = (e): void => {
    const image = e.target.files[0];
    coverForm.cover = image;

    if (!form.id) {
        form.cover = image;
    }

    const reader = new FileReader();

    reader.readAsDataURL(image);
    reader.onload = e => {
        uploadedCover.value = e.target.result;
    };
}

const save = (): void => {
    const isUpdate = !!form.id;
    let url = `/portfolios/${props.portfolio.id}/projects`;

    if (isUpdate) {
        url += `/${form.id}`;
        return form.put(url);
    }

    form.post(url);
};

const saveCover = (): void => {
    coverForm.post(`/portfolios/${props.portfolio.id}/projects/${form.id}/cover`);
};
</script>
