<template>
    <div class="d-flex justify-content-between align-items-center">
        <Link
            href="services/create"
            class="mt-3 mb-3 border-secondary btn btn-light shadow-sm"
        >
            Добавить
        </Link>
    </div>

    <template v-if="services?.length">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped mb-5">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Создано</th>
                    <th scope="col">Изменено</th>
                    <th scope="col" class="text-center">Активно</th>
                    <th scope="col" class="text-center">Управление</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in services">
                    <th scope="row" class="text-center">{{ item.sortOrder }}</th>
                    <td v-html="item.title" />
                    <td>
                        <div class="description-truncate" v-html="item.description" />
                    </td>
                    <td v-html="(!item.isFinalPrice ? 'от ' : '') + formatCurrency(item.price)" />
                    <td v-html="formatDate(item.createdAt)" />
                    <td v-html="formatDate(item.updatedAt)" />
                    <td class="text-center">
                        <i v-if="item.isActive" class="lni lni-checkmark-circle text-success fs-5 shadow-sm rounded-5"></i>
                        <i v-else class="lni lni-ban text-secondary fs-5 shadow-sm"></i>
                    </td>
                    <td style="width: 150px">
                        <ManageButtons item-root-link="services" :item="item" />
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </template>
    <template v-else>
        <span class="text-secondary">Список услуг пуст.</span>
    </template>
</template>

<script lang="ts" setup>
import { defineProps, PropType } from 'vue';
import ServiceData = App.Data.ServiceData;
import { formatCurrency, formatDate } from "../../../Helpers/helpers";
import { Link, useForm } from "@inertiajs/vue3";
import ManageButtons from "./ManageButtons.vue";

const props = defineProps({
    services: {
        type: Array as PropType<ServiceData[]>,
        required: true
    },
    portfolioId: {
        type: Number,
        required: true
    }
});

const decreaseOrder = (item: ServiceData): void => {
    item.sortOrder--;

    const form = useForm<ServiceData>(item);

    form.put(`/services/${item.id}`)
};

const increaseOrder = (item: ServiceData): void => {
    item.sortOrder++;

    const form = useForm<ServiceData>(item);

    form.put(`/services/${item.id}`)
};

</script>
