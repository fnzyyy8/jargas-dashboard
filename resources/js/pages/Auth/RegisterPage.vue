<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const toLogin = () => {
    router.visit(route('login'));
};
</script>

<template>
    <v-card width="450">
        <div class="p-5">
            <div class="flex justify-between px-3">
                <h1>Register</h1>
                <v-btn color="warning" variant="plain" @click="toLogin"
                    >Login</v-btn
                >
            </div>
            <v-card-item>
                <div class="my-3">
                    <div>
                        <v-text-field
                            density="comfortable"
                            variant="outlined"
                            label="Full Name"
                        />
                    </div>
                    <div>
                        <v-text-field
                            density="comfortable"
                            variant="outlined"
                            label="Email"
                        />
                    </div>
                    <div>
                        <v-combobox
                            :items="['PROJECT', 'PSCM']"
                            density="comfortable"
                            variant="outlined"
                            label="Division"
                        />
                    </div>
                    <div>
                        <v-combobox
                            :items="[
                                'Keuangan',
                                'QAQC',
                                'Engineering',
                                'Project Control',
                                'Adcon',
                                'HSSE',
                                'General Affair',
                            ]"
                            density="comfortable"
                            variant="outlined"
                            label="Position"
                        />
                    </div>
                    <div class="flex w-full flex-col">
                        <v-btn variant="flat" color="success">Register</v-btn>
                    </div>
                </div>
            </v-card-item>
        </div>
    </v-card>
</template>

<style scoped></style>
