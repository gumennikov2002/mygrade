<template>
    <Head :title="portfolio.title" />
    <div class="banner bg-brand-dark d-flex" style="min-height: 500px">
        <div class="container py-5 align-items-center gap-5 d-flex flex-column flex-xl-row mt-5 mb-3">
            <div class="d-flex flex-column align-items-center">
                <img class="bg-light object-fit-cover" style="width: 300px; height: 300px; border-radius: 100%" src="https://proza.ru/pics/2015/10/02/461.jpg">
                <div>
                    <h1 class="text-light text-center mt-2">
                        {{ portfolio.title }}
                    </h1>
                </div>
            </div>

            <div class="d-xl-block d-md-none position-relative">
                <p class="text-light p-4" style="opacity: .8">
                    {{ portfolio.aboutMe }}
                </p>
                <div class="text-light position-absolute top-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-quote" viewBox="0 0 16 16">
                        <path d="M12 12a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1h-1.388q0-.527.062-1.054.093-.558.31-.992t.559-.683q.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 9 7.558V11a1 1 0 0 0 1 1zm-6 0a1 1 0 0 0 1-1V8.558a1 1 0 0 0-1-1H4.612q0-.527.062-1.054.094-.558.31-.992.217-.434.559-.683.34-.279.868-.279V3q-.868 0-1.52.372a3.3 3.3 0 0 0-1.085.992 4.9 4.9 0 0 0-.62 1.458A7.7 7.7 0 0 0 3 7.558V11a1 1 0 0 0 1 1z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-white">
        <div class="container pt-5">
            <ContentCard class="d-xl-none d-md-block pb-5" id="aboutMe" title="О себе">
                <p>
                    {{ portfolio.aboutMe }}
                </p>
            </ContentCard>

            <ContentCard class="pb-5" id="works" title="Работы">
                <div class="d-flex flex-wrap gap-3">
                    <WorkCard width="40rem" :work="item" v-for="item in works" />
                </div>
            </ContentCard>

            <ContentCard v-if="services?.length" class="pb-5" id="services" title="Услуги">
                <div class="d-flex flex-column gap-3">
                    <ServiceCard v-for="item in services" :service="item" />
                </div>
            </ContentCard>

            <ContentCard v-if="links?.length" class="pb-5" id="links" title="Ссылки">
                <div class="d-flex gap-4">
                    <a v-for="item in links" :href="item.href" target="_blank">{{ item.label }}</a>
                </div>
            </ContentCard>
        </div>
    </div>

    <div class="container-fluid bg-brand-dark">
        <div class="container d-flex flex-column gap-2 py-5">
            <Logo width="110" height="30"></Logo>
            <span class="text-secondary">
                Сервис для создания и публикации портфолио.
            </span>
        </div>
    </div>
    <div class="position-fixed bottom-0 end-0 p-3">
        <button class="floater btn btn-success p-3 rounded-pill shadow-lg">
            Оставить заявку
        </button>
    </div>
</template>

<script lang="ts" setup>
import ContentCard from "../../Components/Portfolio/ContentCard.vue";
import ServiceCard from "../../Components/Portfolio/ServiceCard.vue";
import WorkCard from "../../Components/Portfolio/WorkCard.vue";
import Logo from "../../Components/Logo.vue";
import { defineProps, PropType, ref } from 'vue';
import { Head } from "@inertiajs/vue3";
import PortfolioData = App.Data.PortfolioData;
import UserData = App.Data.User.UserData;
import ServiceData = App.Data.ServiceData;
import LinkData = App.Data.LinkData;

const props = defineProps({
    portfolio: {
        type: Object as PropType<PortfolioData>,
        required: true
    },
    services: {
        type: Object as PropType<ServiceData[]>,
        required: false
    },
    links: {
        type: Object as PropType<LinkData[]>,
        required: false
    },
    user: {
        type: Object as PropType<UserData>,
        required: true
    }
});

const works = ref([
    { title: 'Работа 1', description: 'Работа .........'},
    { title: 'Работа 2', description: 'Работа .........'},
    { title: 'Работа 3', description: 'Работа .........'},
    { title: 'Работа 4', description: 'Работа .........'},
    { title: 'Работа 5', description: 'Работа .........'},
    { title: 'Работа 6', description: 'Работа .........'}
]);
</script>

