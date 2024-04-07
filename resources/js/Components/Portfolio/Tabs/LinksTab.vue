<template>
    <div class="d-flex justify-content-between align-items-center">
        <Link
            href="links/create"
            class="mt-3 mb-3 border-secondary btn btn-light shadow-sm"
        >
            Добавить
        </Link>
    </div>

    <template v-if="links?.length">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped mb-5">
                <thead>
                <tr>
                    <th scope="col" class="text-center">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Ссылка</th>
                    <th scope="col">Создано</th>
                    <th scope="col">Изменено</th>
                    <th scope="col" class="text-center">Активно</th>
                    <th scope="col" class="text-center">Управление</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in links">
                    <th scope="row" class="text-center">{{ item.sortOrder }}</th>
                    <td v-html="item.label" />
                    <td>
                        <a class="text-brand-pink" target="_blank" :href="item.href">Ссылка</a>
                    </td>
                    <td v-html="formatDate(item.createdAt)" />
                    <td v-html="formatDate(item.updatedAt)" />
                    <td class="text-center">
                        <i v-if="item.isActive" class="lni lni-checkmark-circle text-success fs-5 shadow-sm rounded-5"></i>
                        <i v-else class="lni lni-ban text-secondary fs-5 shadow-sm"></i>
                    </td>
                    <td style="width: 150px">
                        <ManageButtons item-root-link="links" :item="item" />
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
import { formatDate } from "../../../Helpers/helpers";
import { Link, useForm } from "@inertiajs/vue3";
import LinkData = App.Data.LinkData;
import ManageButtons from "./ManageButtons.vue";

const props = defineProps({
    links: {
        type: Array as PropType<LinkData[]>,
        required: true
    },
    portfolioId: {
        type: Number,
        required: true
    }
});

const decreaseOrder = (item: LinkData): void => {
    item.sortOrder--;

    const form = useForm<LinkData>(item);

    form.put(`/links/${item.id}`)
};

const increaseOrder = (item: LinkData): void => {
    item.sortOrder++;

    const form = useForm<LinkData>(item);

    form.put(`/links/${item.id}`)
};

</script>
