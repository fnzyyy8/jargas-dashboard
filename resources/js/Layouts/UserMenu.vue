<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const user = {
    name: 'Farhan Septiansyah',
};

const toLoginMenu = () => {
    router.visit(route('login'))
}
</script>

<template>
    <v-menu width="150px" :offset="5" location="bottom end">
        <template v-slot:activator="{ props, isActive }">
            <v-btn
                v-bind="props"
                :append-icon="isActive ? 'mdi-chevron-up' : 'mdi-chevron-down'"
            >
                <div class="mr-2 flex flex-col items-start">
                    <span class="mb-1 text-sm leading-none font-bold">{{
                        user.name
                    }}</span>
                </div>
            </v-btn>
        </template>
        <v-list width="150">
            <v-list-item title="Profile" append-icon="mdi-account" />
            <v-list-item
                title="Logout"
                append-icon="mdi-logout"
                @click="toLoginMenu"
            />
        </v-list>
    </v-menu>
</template>

<style scoped></style>
