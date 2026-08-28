<script setup lang="ts">
const tHead = ['Detail Pekerjaan', 'Satuan', 'Volume', 'Harga Satuan'];
</script>

<template>
    <div class="flex flex-col gap-3">
        <v-card> </v-card>
        <v-card>
            <v-card-item>
                <v-table>
                    <thead>
                        <tr>
                            <th v-for="(item, index) in tHead" :key="index">
                                {{ item }}
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </v-table>
            </v-card-item>
        </v-card>
    </div>
</template>

<style scoped></style>
