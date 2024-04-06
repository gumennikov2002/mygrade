<template>
    <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="createProjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form @submit.prevent="form.post('/projects');" @input="form.clearErrors()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProjectModalLabel">Добавление работы</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <AlertSuccess v-if="form.recentlySuccessful" message="Проект успешно создан" />
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
                        >
                        </textarea>
                        <span class="text-danger" v-if="form.errors.description">{{ form.errors.description }}</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="submit" class="border-secondary btn btn-light shadow-sm">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { defineProps } from 'vue';
import { useForm } from "@inertiajs/vue3";
import AlertSuccess from "../../Page/AlertSuccess.vue";
import ProjectData = App.Data.ProjectData;

const props = defineProps({
    portfolioId: {
        type: Number,
        required: true,
    }
});

const form = useForm<ProjectData>({
    portfolioId: props.portfolioId,
    isActive: true,
    title: null,
    description: null,
    sortOrder: 1,
});

</script>
