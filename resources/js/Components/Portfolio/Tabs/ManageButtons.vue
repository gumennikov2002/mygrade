<template>
    <div class="d-flex gap-3 justify-content-center align-items-center">
        <div class="d-flex align-items-center gap-1">
            <i @click="decreaseOrder(item)" role="button" class="bg-light shadow-sm text-dark p-2 rounded-3 lni lni-chevron-up"></i>
            <i @click="increaseOrder(item)" role="button" class="cursor-pointer bg-light shadow-sm text-dark p-2 rounded-3 lni lni-chevron-down"></i>
        </div>
        <div class="d-flex align-items-center gap-1">
            <Link :href="`${itemRootLink}/${item.id}/edit`">
                <i class="bg-white shadow-sm text-brand-dark p-2 rounded-3 lni lni-pencil"></i>
            </Link>
            <Link as="button" method="DELETE" class="border-0 bg-transparent" :href="`${itemRootLink}/${item.id}`">
                <i class="bg-danger shadow-sm text-light p-2 rounded-3 lni lni-trash-can"></i>
            </Link>
        </div>
    </div>
</template>

<script lang="ts" setup>
import { defineProps, PropType } from 'vue';
import { Link, useForm} from "@inertiajs/vue3";
import ProjectData = App.Data.ProjectData;
import LinkData = App.Data.LinkData;
import ServiceData = App.Data.ServiceData;

const props = defineProps({
    item: {
        type: Object as PropType<ProjectData|ServiceData|LinkData>,
        required: true
    },
    itemRootLink: {
        type: String,
        required: true
    }
});


const decreaseOrder = (item: ProjectData|ServiceData|LinkData): void => {
    item.sortOrder--;

    const form = useForm<ProjectData|ServiceData|LinkData>(item);

    form.put(`${props.itemRootLink}/${item.id}`);
};

const increaseOrder = (item: ProjectData|ServiceData|LinkData): void => {
    item.sortOrder++;

    const form = useForm<ProjectData|ServiceData|LinkData>(item);

    form.put(`${props.itemRootLink}/${item.id}`);
};
</script>
