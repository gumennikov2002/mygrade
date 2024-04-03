<template>
    <div class="accordion">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button
                    class="accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    :data-bs-target="`#service${service.id}`"
                    aria-expanded="true"
                    :aria-controls="`#service${service.id}`"
                >
                    <div class="d-flex w-100 justify-content-between">
                        <span>{{ service.title }}</span>
                        <span class="mx-3">{{ (service.isFinalPrice ? '' : 'От ') + formatCurrency(service.price) }}</span>
                    </div>
                </button>
            </h2>
            <div :id="`service${service.id}`" class="accordion-collapse collapse">
                <div class="accordion-body">
                    {{ service.description }}

                    <div v-if="manageButtons" class="d-flex align-items-center">
                        <button class="btn btn-light shadow-sm rounded-3">
                            <i class="lni text-brand-dark lni-pencil"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import {defineProps, PropType} from 'vue';
import { formatCurrency } from "../../Helpers/helpers";
import ServiceData = App.Data.Service.ServiceData;
import {Link} from "@inertiajs/vue3";

const props = defineProps({
    service: {
        type: Object as PropType<ServiceData>,
        required: true
    },
    width: {
        type: String,
        required: false,
        default: 'auto'
    },
    manageButtons: {
        type: Boolean,
        required: false,
        default: false
    }
});
</script>
