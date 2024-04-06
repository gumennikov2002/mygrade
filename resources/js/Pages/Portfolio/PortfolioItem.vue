<template>
    <Head title="Создание портфолио"/>
    <DefaultLayout>
        <Breadcrumbs :breadcrumbs="breadcrumbs" />

        <h2 class="mb-3">{{ form.id ? 'Редактирование портфолио' : 'Создание портфолио' }}</h2>

        <template v-if="form.recentlySuccessful">
            <AlertSuccess message="Портфолио сохранено" />
        </template>

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-common-tab" data-bs-toggle="tab" data-bs-target="#nav-common" type="button" role="tab" aria-controls="nav-common" aria-selected="true">Основное</button>
                <button v-if="form.id" class="nav-link" id="nav-services-tab" data-bs-toggle="tab" data-bs-target="#nav-services" type="button" role="tab" aria-controls="nav-services" aria-selected="false">Услуги</button>
                <button v-if="form.id" class="nav-link" id="nav-works-tab" data-bs-toggle="tab" data-bs-target="#nav-works" type="button" role="tab" aria-controls="nav-works" aria-selected="false">Работы</button>
                <button v-if="form.id" class="nav-link" id="nav-links-tab" data-bs-toggle="tab" data-bs-target="#nav-links" type="button" role="tab" aria-controls="nav-links" aria-selected="false">Ссылки</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-common" role="tabpanel" aria-labelledby="nav-common-tab">
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
                        <label for="aboutMe" class="form-label">
                            О себе
                            <span class="text-danger">*</span>
                        </label>
                        <textarea
                            v-model="form.aboutMe"
                            placeholder="Расскажите о себе"
                            class="form-control"
                            id="aboutMe"
                            rows="6"
                        >
                        </textarea>
                        <div class="d-flex flex-column gap-1">
                            <small :class="form.aboutMe.length >= 100 ? 'text-brand-pink' : 'text-secondary'">{{ form.aboutMe.length }} символов</small>
                            <span class="text-danger" v-if="form.errors.aboutMe">{{ form.errors.aboutMe }}</span>
                        </div>
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
            </div>

            <div v-if="form.id" class="tab-pane fade" id="nav-services" role="tabpanel" aria-labelledby="nav-services-tab">
                <ServicesTab :services="services" :portfolio-id="form.id" />
            </div>

            <div v-if="form.id" class="tab-pane fade" id="nav-works" role="tabpanel" aria-labelledby="nav-works-tab">
                ...
            </div>

            <div v-if="form.id" class="tab-pane fade" id="nav-links" role="tabpanel" aria-labelledby="nav-links-tab">
                <LinksTab :links="links" :portfolio-id="form.id" />
            </div>
        </div>
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
import PortfolioData = App.Data.PortfolioData;
import ServiceData = App.Data.ServiceData;
import ServicesTab from "../../Components/Portfolio/Tabs/ServicesTab.vue";
import LinkData = App.Data.LinkData;
import LinksTab from "../../Components/Portfolio/Tabs/LinksTab.vue";

const props = defineProps({
    portfolio: {
        type: Object as PropType<PortfolioData>,
        required: false
    },
    services: {
        type: Object as PropType<ServiceData[]>,
        required: false
    },
    links: {
        type: Object as PropType<LinkData[]>,
        required: false
    }
});

const form = useForm<PortfolioData>(props.portfolio ?? {
    id: null,
    slug: null,
    isActive: true,
    title: null,
    aboutMe: null,
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
