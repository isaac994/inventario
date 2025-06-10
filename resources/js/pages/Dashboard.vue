<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { DevicePhoneMobileIcon, UsersIcon, ChartBarIcon } from '@heroicons/vue/24/solid';
import BarChart from '../components/BarChart.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const props = defineProps([
    'productosVendidos',
    'clientes',
    'ventasPorMesLabels',
    'ventasPorMesData'
]);
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl p-6 bg-gradient-to-br from-indigo-100 via-violet-100 to-purple-100">

            <!-- Tarjetas de Resumen -->
            <div class="grid auto-rows-min gap-6 md:grid-cols-2">
                <div class="flex items-center gap-4 p-6 bg-gradient-to-r from-green-100 to-green-300 rounded-xl shadow-lg border border-green-400">
                    <DevicePhoneMobileIcon class="h-12 w-12 text-green-700" />
                    <div>
                        <h3 class="text-xl font-bold text-green-800">Productos Vendidos</h3>
                        <p class="text-2xl font-semibold text-green-900">Cantidad: {{ productosVendidos }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 p-6 bg-gradient-to-r from-blue-100 to-blue-300 rounded-xl shadow-lg border border-blue-400">
                    <UsersIcon class="h-12 w-12 text-blue-700" />
                    <div>
                        <h3 class="text-xl font-bold text-blue-800">Clientes</h3>
                        <p class="text-2xl font-semibold text-blue-900">Cantidad: {{ clientes }}</p>
                    </div>
                </div>
            </div>

            <!-- Gráficos -->
            <div class="grid auto-rows-min gap-6 md:grid-cols-2">
                <div class="bg-white rounded-xl p-6 shadow-lg border border-purple-300">
                    <div class="flex items-center gap-2 mb-4">
                        <ChartBarIcon class="h-6 w-6 text-purple-700" />
                        <h3 class="text-lg font-semibold text-purple-800">Ventas por Mes</h3>
                    </div>
                    <BarChart
                      :labels="ventasPorMesLabels"
                      :values="ventasPorMesData"
                      label="Ventas"
                    />
                </div>

                <div class="bg-white rounded-xl p-6 shadow-lg border border-pink-300">
                    <div class="flex items-center gap-2 mb-4">
                        <ChartBarIcon class="h-6 w-6 text-pink-700" />
                        <h3 class="text-lg font-semibold text-pink-800">Ventas por Semana</h3>
                    </div>
                    <BarChart
                      :labels="ventasPorMesLabels"
                      :values="ventasPorMesData"
                      label="Ventas"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
