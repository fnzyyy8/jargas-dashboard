<script setup lang="ts">
import type {
    Boq,
    ItemDetail,
} from '@/pages/projectControl/PlanDetail/Types/plan.detail';
import { useFormatNumber } from '@/composable/useFormatNumber';

defineProps<{
    boq: Boq;
    itemDetail: ItemDetail;
}>();

const { formatDate } = useFormatNumber();
</script>

<template>
    <v-card>
        <div class="flex flex-col gap-3 p-3">
            <div class="flex flex-col gap-1">
                <div class="grid grid-rows-2 gap-3">
                    <div>
                        <span>Project :</span>
                        <h3>{{ boq.projectName }}</h3>
                    </div>
                    <div class="flex gap-5">
                        <div>
                            <span>Nomor SPK :</span>
                            <h3>{{ boq.projectNumber }}</h3>
                        </div>
                        <v-divider vertical />
                        <div>
                            <span>Client :</span>
                            <h3>{{ boq.client }}</h3>
                        </div>
                        <v-divider vertical />
                        <div>
                            <span>Area :</span>
                            <h3>{{ boq.area }}</h3>
                        </div>
                        <v-divider vertical />
                        <div>
                            <span>Detailed Area :</span>
                            <h3>{{ boq.detailedArea ?? '-' }}</h3>
                        </div>
                        <v-divider vertical />
                        <div>
                            <span>Start Date :</span>
                            <h3>{{ formatDate(boq.startDate) ?? '-' }}</h3>
                        </div>
                        <v-divider vertical />
                        <div>
                            <span>End Date :</span>
                            <h3>{{ formatDate(boq.endDate) ?? '-' }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <v-divider />
            <div class="grid grid-cols-3">
                <div>
                    <span>Section : </span>
                    <h3>{{ itemDetail.section }}</h3>
                </div>
                <div>
                    <span>Kategori : </span>
                    <h3>{{ itemDetail.category }}</h3>
                </div>
                <div>
                    <span>Sub Kategori : </span>
                    <h3>{{ itemDetail.subCategory }}</h3>
                </div>
            </div>
            <v-divider />
            <div class="min-h-32">
                <span>Nama Pekerjaan : </span>
                <h3>{{ itemDetail.name }}</h3>
            </div>
        </div>
    </v-card>
</template>

<style scoped>
span {
    color: #90a4ae;
}
</style>
