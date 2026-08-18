<script setup lang="ts">
const user = {
    name: 'John Doe',
    role: 'Document Control',
};
</script>

<template>
    <v-menu width="150px">
        <template v-slot:activator="{ props, isActive }">
            <v-btn
                v-bind="props"
                :append-icon="isActive ? 'mdi-chevron-up' : 'mdi-chevron-down'"
            >
                <div class="mr-2 flex flex-col items-start">
                    <span class="mb-1 text-sm leading-none font-bold">{{
                        user.name
                    }}</span>
                    <span
                        class="text-xs leading-none font-normal text-blue-500"
                        >{{ user.role }}</span
                    >
                </div>
            </v-btn>
        </template>
        <v-list>
            <v-list-item title="Profile" append-icon="mdi-account" />
            <v-list-item title="Logout" append-icon="mdi-logout" />
        </v-list>
    </v-menu>
</template>

<style scoped></style>
