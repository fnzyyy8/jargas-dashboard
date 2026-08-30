<script setup lang="ts">
import { ref } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const showPassword = ref(false);

const toDashboard = () => {
    router.visit(route('home'));
};
</script>

<template>
    <GuestLayout>
        <v-card width="400" class="py-3">
            <v-card-title>
                <div class="flex justify-center">Login</div>
            </v-card-title>
            <v-card-item>
                <div class="my-3">
                    <v-text-field
                        class="mt-2"
                        variant="outlined"
                        density="comfortable"
                        label="Email"
                    />
                    <v-text-field
                        class="mt-2"
                        variant="outlined"
                        density="comfortable"
                        label="Password"
                        :type="showPassword ? 'text' : 'password'"
                        :append-inner-icon="
                            showPassword ? 'mdi-eye' : 'mdi-eye-off'
                        "
                        @click:append-inner="showPassword = !showPassword"
                    />
                </div>
                <v-card-actions class="flex justify-end p-0!">
                    <v-btn
                        variant="flat"
                        color="primary"
                        @click="toDashboard"
                    >
                        Login
                    </v-btn>
                </v-card-actions>
            </v-card-item>
        </v-card>
    </GuestLayout>
</template>

<style scoped></style>
