<script setup lang="ts"></script>

<template>
    <v-menu>
        <template v-slot:activator="{ props }">
            <v-btn icon="mdi-dots-vertical" variant="text" v-bind="props" />
        </template>

        <v-list>
            <v-list-item
                prepend-icon="mdi-pencil"
                base-color="warning"
                title="Edit"
            />
            <v-list-item
                prepend-icon="mdi-delete"
                base-color="error"
                title="Delete"
            />
        </v-list>
    </v-menu>
</template>

<style scoped></style>
