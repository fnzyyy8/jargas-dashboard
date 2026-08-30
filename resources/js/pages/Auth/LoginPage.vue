<script setup lang="ts">
import { router } from '@inertiajs/vue3';

import { ref } from 'vue';

import GuestLayout from '@/Layouts/GuestLayout.vue';
import { route } from 'ziggy-js';

const showPassword = ref(false);

const toDashboard = () => {
    router.visit(route('home'));
};

const toRegister = () => {
    router.visit(route('register'));
};
</script>

<template>
    <GuestLayout>
        <v-card width="450">
            <div class="p-5">
                <v-card-title>
                    <div class="flex justify-center">
                        <h1>Jargas Dashboard</h1>
                    </div>
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
                    <div class="flex w-full flex-col gap-2">
                        <v-btn
                            variant="flat"
                            color="primary"
                            @click="toDashboard"
                        >
                            Login
                        </v-btn>
                        <v-btn size="small" variant="text" @click="toRegister"
                            >Register Account</v-btn
                        >
                    </div>
                </v-card-item>
            </div>
        </v-card>
    </GuestLayout>
</template>

<style scoped></style>
