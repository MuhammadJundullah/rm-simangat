<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayoutAdmin.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Admin" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Pesanan Pelanggan
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="p-6 text-gray-900">
                        <ul>
                            <p v-if="pesanan.length === 0" class="text-gray-500">Belum ada pesanan dari pelanggan.</p>
                            <li v-if="pesanan.length != 0">
                                <Orders :data="pesanan" :rute="route"/>      
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import Orders from './Order/Orders.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

export default {
    props: {
        pesanan: Array,
        route: Array
    },
    components: {
        Orders,
        PrimaryButton
    }
}
</script>
