<template>
    <div class="modal fade" id="createLinkModal" tabindex="-1" aria-labelledby="createLinkModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form @submit.prevent="form.post('/links'); console.log(form.errors)" @input="form.clearErrors()" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLinkModalLabel">Создание ссылки</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <AlertSuccess v-if="form.recentlySuccessful" message="Ссылка успешно создана" />
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
import SaveLinkData = App.Data.Link.SaveLinkData;

const props = defineProps({
    portfolioId: {
        type: Number,
        required: true,
    }
});

const form = useForm<SaveLinkData>({
    portfolioId: props.portfolioId,
    isActive: true,
    label: null,
    href: null,
    sortOrder: 1,
});

</script>
