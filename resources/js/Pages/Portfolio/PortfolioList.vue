<template>
    <Head title="Портфолио" />
    <DefaultLayout>

        <div class="d-flex mb-3 align-items-center justify-content-between">
            <h2>Портфолио</h2>
            <Link href="/portfolios/create">
                <i class="text-dark p-2 rounded-3 btn btn-light shadow-sm border-secondary-subtle lni lni-plus"></i>
            </Link>
        </div>

        <template v-if="portfolios.length">
            <form @submit.prevent class="d-flex mb-3">
                <div class="d-flex gap-2">
                    <input type="text" class="form-control shadow-sm" placeholder="Поиск">
                    <button class="btn btn-light shadow-sm border-secondary-subtle border-1 rounded-3">
                        <i class="lni lni-funnel"></i>
                    </button>
                </div>
            </form>

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
                    <tr v-for="item in portfolios">
                        <th scope="row" class="text-center">{{ item.id }}</th>
                        <td>{{ item.title }}</td>
                        <td>{{ item.description }}</td>
                        <td>{{ formatDate(item.createdAt) }}</td>
                        <td>{{ formatDate(item.updatedAt) }}</td>
                        <td class="text-center">
                            <i v-if="item.isActive" class="lni lni-checkmark-circle text-success fs-5 shadow-sm rounded-5"></i>
                            <i v-else class="lni lni-ban text-secondary fs-5 shadow-sm"></i>
                        </td>
                        <td style="width: 200px">
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

<!--            <nav class="d-flex align-items-center justify-content-between">-->
<!--                <small class="text-secondary">Показаны 4 из 20 записей.</small>-->
<!--                <ul class="pagination pagination-sm">-->
<!--                    <li class="page-item disabled">-->
<!--                        <a class="page-link" href="#" tabindex="-1">Назад</a>-->
<!--                    </li>-->
<!--                    <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>-->
<!--                    <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>-->
<!--                    <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>-->
<!--                    <li class="page-item">-->
<!--                        <a class="page-link text-dark" href="#">Вперед</a>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </nav>-->
        </template>

        <template v-else>
            <span class="text-secondary text-center">Список пуст.</span>
        </template>
    </DefaultLayout>
</template>

<script lang="ts" setup>
import { defineProps, PropType } from "vue";
import { Head, Link } from "@inertiajs/vue3";
import DefaultLayout from "../../Layout/DefaultLayout.vue";
import PortfolioData = App.Data.Portfolio.PortfolioData;
import { formatDate } from "../../Helpers/helpers";

const props = defineProps({
    portfolios: {
        type: Array as PropType<PortfolioData[]>,
        required: true
    }
})
</script>
