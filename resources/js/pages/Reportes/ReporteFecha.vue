<template>
  <AppSidebarLayout>
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Reportes ventas</h1>
        <a
          :href="`/pdf?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`"
          class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
          target="_blank"
        >
          <span>Descargar PDF</span>
        </a>
        <a
          :href="`/xls?fechaInicio=${fechaInicio}&fechaFin=${fechaFin}`"          class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 ml-2"
          target="_blank"
        >
          <span>Descargar XLS</span>
        </a>
      </div>
      <div class="flex gap-4 mb-4">
        <div class="flex flex-col">
          <label for="fechaInicio" class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Desde:</label>
          <div class="relative">
            <input type="date" v-model="fechaInicio" id="fechaInicio"
              class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 pr-10 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-700 dark:text-white transition-all outline-none shadow-sm hover:border-blue-400"
            />
            <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </span>
          </div>
        </div>
        <div class="flex flex-col">
          <label for="fechaFin" class="block text-xs font-semibold text-gray-700 dark:text-gray-200 mb-1">Hasta:</label>
          <div class="relative">
            <input type="date" v-model="fechaFin" id="fechaFin"
              class="border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 pr-10 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 dark:bg-gray-700 dark:text-white transition-all outline-none shadow-sm hover:border-blue-400"
            />
            <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </span>
          </div>
        </div>
      </div>
      <div v-if="ventas.length">
        <table class="min-w-full bg-white dark:bg-gray-800">
          <thead>
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nro</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cliente</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(venta, idx) in ventasFiltradas" :key="venta.id">
              <td class="px-6 py-3">{{ idx + 1 }}</td>
              <td class="px-6 py-3">{{ venta.cliente_nombre }}</td>
              <td class="px-6 py-3">{{ venta.total }}</td>
              <td class="px-6 py-3">{{ venta.fecha_registro }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div v-else>
        <p class="text-gray-500">No hay ventas disponibles.</p>
      </div>
    </div>
  </AppSidebarLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import { ref, computed } from 'vue';

const props = defineProps({
  ventas: {
    type: Array,
    required: true
  }
});

const fechaInicio = ref('');
const fechaFin = ref('');

const ventasFiltradas = computed(() => {
  return props.ventas.filter(venta => {
    const fecha = venta.fecha_registro.substring(0, 10); // yyyy-mm-dd
    const desde = fechaInicio.value ? fechaInicio.value : '0000-00-00';
    const hasta = fechaFin.value ? fechaFin.value : '9999-12-31';
    return fecha >= desde && fecha <= hasta;
  });
});
</script>
