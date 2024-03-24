<template>
    <Head title="Портфолио" />
    <DefaultLayout>

        <div class="d-flex mb-3 align-items-center justify-content-between">
            <h2>Портфолио</h2>
            <Link href="/portfolios/create">
                <i class="text-dark p-2 rounded-3 btn btn-light shadow-sm border-secondary-subtle lni lni-plus"></i>
            </Link>
        </div>

        <form @submit.prevent class="d-flex mb-3">
            <div class="d-flex gap-2">
                <input v-model="search" type="text" class="form-control shadow-sm" placeholder="Поиск">
                <button
                    data-bs-toggle="collapse"
                    data-bs-target="#filters"
                    class="btn btn-light shadow-sm border-secondary-subtle border-1 rounded-3"
                >
                    <i class="lni lni-funnel"></i>
                </button>
            </div>
        </form>

        <div id="filters" class="accordion-collapse collapse mb-3">
            <div>
                <label for="statusFilter" class="form-label">Статус</label>
                <select v-model="statusFilter" id="statusFilter" class="form-select">
                    <option value="all" selected>Все</option>
                    <option value="active">Активные</option>
                    <option value="inactive">Неактивные</option>
                </select>
            </div>
        </div>

        <template v-if="portfolios.data.length">
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped mb-5">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col">Название</th>
                        <th scope="col">Описание</th>
                        <th scope="col">Создано</th>
                        <th scope="col">Изменено</th>
                        <th scope="col" class="text-center">Активно</th>
                        <th scope="col" class="text-center">Управление</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="item in portfolios.data">
                        <th scope="row" class="text-center">{{ item.id }}</th>
                        <td v-html="textHighlight(item.title)" />
                        <td>
                            <div class="description-truncate" v-html="textHighlight(item.description)" />
                        </td>
                        <td v-html="formatDate(item.createdAt)" />
                        <td v-html="formatDate(item.updatedAt)" />
                        <td class="text-center">
                            <i v-if="item.isActive" class="lni lni-checkmark-circle text-success fs-5 shadow-sm rounded-5"></i>
                            <i v-else class="lni lni-ban text-secondary fs-5 shadow-sm"></i>
                        </td>
                        <td style="width: 150px">
                            <div class="d-flex gap-3 justify-content-center">
                                <Link href="#">
                                    <i class="bg-white shadow-sm text-brand-dark p-2 rounded-3 lni lni-clipboard"></i>
                                </Link>
                                <Link :href="`/portfolios/update/${item.id}`">
                                    <i class="bg-white shadow-sm text-brand-dark p-2 rounded-3 lni lni-pencil"></i>
                                </Link>
                                <Link as="button" method="DELETE" class="border-0 bg-transparent" :href="`/portfolios/${item.id}`">
                                    <i class="bg-danger shadow-sm text-light p-2 rounded-3 lni lni-trash-can"></i>
                                </Link>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <nav class="d-flex align-items-center justify-content-between">
                <small class="text-secondary">Показаны {{ portfolios.data.length }} из {{ portfolios.total }} записей.</small>

                <template v-if="portfolios.total > portfolios.per_page ">
                    <ul class="pagination pagination-sm">
                        <li v-for="item in portfolios.links" class="page-item">
                            <Link
                                :href="item.url ?? ''"
                                :class="getPaginationLinkClass(item)"
                                v-html="item.label"
                            />
                        </li>
                    </ul>
                </template>
            </nav>
        </template>

        <template v-else>
            <span class="text-secondary text-center">Список пуст.</span>
        </template>
    </DefaultLayout>
</template>

<script lang="ts" setup>
import { defineProps, PropType, ref, watch } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import DefaultLayout from "../../Layout/DefaultLayout.vue";
import { formatDate, getPaginationLinkClass, containsText } from "../../Helpers/helpers";
import PortfolioStatusFilter = App.Enums.PortfolioStatusFilter;
import { PortfolioDataPaginated } from "../../Types/types";
import PortfolioFilter = App.Enums.PortfolioFilter;

const props = defineProps({
    portfolios: {
        type: Object as PropType<PortfolioDataPaginated>,
        required: true
    },
    filters: {
        type: Object as PropType<{
            search: string,
            status: PortfolioStatusFilter
        }>,
        required: false
    },
});

const search = ref<string>(props.filters.search);
const statusFilter = ref<PortfolioStatusFilter>(props.filters.status ?? 'all');

const useFilter = (filter: PortfolioFilter, value: any): void => {
    const options = { preserveState: true, replace: true }
    let data = {}

    switch (filter) {
        case 'search':
            data = { search: value, status: statusFilter.value }
            break;
        case 'status':
            data = { search: search.value, status: value }
            break;
    }

    router.get('/portfolios', data, options)
}

const textHighlight = (text: string): string => {
    const searchingValue = search.value;

    if (!searchingValue || !searchingValue.trim()) {
        return text;
    }

    // Создаем регулярное выражение для поиска текста с игнорированием регистра
    const regex = new RegExp(searchingValue, 'gi');

    return text?.replace(regex, (match) => `
        <span class="shadow-sm bg-brand-pink px-1 rounded-3 text-white">${match}</span>
    `);
};

watch(search, value => useFilter('search', value));
watch(statusFilter, value => useFilter('status', value));

</script>

<style lang="scss" scoped>
.description-truncate {
    width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
