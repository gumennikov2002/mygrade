<template>
    <div class="d-flex justify-content-between align-items-center">
        <button
            class="mt-3 mb-3 border-secondary btn btn-light shadow-sm"
            data-bs-toggle="modal"
            data-bs-target="#createProjectModal"
        >
            Добавить
        </button>
    </div>

    <template v-if="projects?.length">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped mb-5">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Создано</th>
                    <th scope="col">Изменено</th>
                    <th scope="col" class="text-center">Активно</th>
                    <th scope="col" class="text-center">Управление</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in projects">
                    <th scope="row" class="text-center">{{ item.sortOrder }}</th>
                    <td v-html="item.title" />
                    <td>
                        <div class="description-truncate" v-html="item.description" />
                    </td>
                    <td v-html="formatDate(item.createdAt)" />
                    <td v-html="formatDate(item.updatedAt)" />
                    <td class="text-center">
                        <i v-if="item.isActive" class="lni lni-checkmark-circle text-success fs-5 shadow-sm rounded-5"></i>
                        <i v-else class="lni lni-ban text-secondary fs-5 shadow-sm"></i>
                    </td>
                    <td style="width: 150px">
                        <div class="d-flex gap-3 justify-content-center align-items-center">
                            <div class="d-flex align-items-center gap-1">
                                <i @click="decreaseOrder(item)" role="button" class="bg-light shadow-sm text-dark p-2 rounded-3 lni lni-chevron-up"></i>
                                <i @click="increaseOrder(item)" role="button" class="cursor-pointer bg-light shadow-sm text-dark p-2 rounded-3 lni lni-chevron-down"></i>
                            </div>
                            <Link as="button" method="DELETE" class="border-0 bg-transparent" :href="`/links/${item.id}`">
                                <i class="bg-danger shadow-sm text-light p-2 rounded-3 lni lni-trash-can"></i>
                            </Link>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </template>
    <template v-else>
        <span class="text-secondary">Список услуг пуст.</span>
    </template>

    <CreateProjectModal :portfolio-id="portfolioId" />
</template>

<script lang="ts" setup>
import { defineProps, PropType } from 'vue';
import { formatDate } from "../../../Helpers/helpers";
import { Link, useForm } from "@inertiajs/vue3";
import ProjectData = App.Data.ProjectData;
import CreateProjectModal from "../Modals/CreateProjectModal.vue";

const props = defineProps({
    projects: {
        type: Array as PropType<ProjectData[]>,
        required: true
    },
    portfolioId: {
        type: Number,
        required: true
    }
});

const decreaseOrder = (item: ProjectData): void => {
    item.sortOrder--;

    const form = useForm<ProjectData>(item);

    form.put(`/projects/${item.id}`)
};

const increaseOrder = (item: ProjectData): void => {
    item.sortOrder++;

    const form = useForm<ProjectData>(item);

    form.put(`/projects/${item.id}`)
};

</script>
