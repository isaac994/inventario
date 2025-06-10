<template>
  <AppSidebarLayout>
    <div class="container mx-auto px-6 py-8">
      <!-- Encabezado -->
      <div class="bg-blue-100 dark:bg-gray-700 p-6 rounded-lg shadow-lg mb-6">
        <div class="flex justify-between items-center">
          <h1 class="text-3xl font-bold text-blue-800 dark:text-white">📊 Reportes de Ventas</h1>
            <div class="flex justify-end mt-8">
        <a
          href="/pdf"
          class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition"
          target="_blank"
        >
          Descargar PDF
        </a>
      </div>
        </div>
      </div>

      <!-- Filtros -->
      <div class="flex gap-6 bg-white dark:bg-gray-800 p-4 rounded-lg shadow mb-6">
        <div class="flex flex-col">
          <label for="fechaInicio" class="text-sm font-semibold text-gray-700 dark:text-gray-300">Desde:</label>
          <input
            type="date"
            v-model="fechaInicio"
            id="fechaInicio"
            class="border border-gray-300 rounded px-3 py-2 mt-1 dark:bg-gray-700 dark:text-white"
          />
        </div>
        <div class="flex flex-col">
          <label for="fechaFin" class="text-sm font-semibold text-gray-700 dark:text-gray-300">Hasta:</label>
          <input
            type="date"
            v-model="fechaFin"
            id="fechaFin"
            class="border border-gray-300 rounded px-3 py-2 mt-1 dark:bg-gray-700 dark:text-white"
          />
        </div>
      </div>

      <!-- Tabla de Ventas -->
      <div v-if="ventasFiltradas.length" class="overflow-x-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-blue-600 text-white">
            <tr>
              <th class="py-3 px-4 text-left">ID</th>
              <th class="py-3 px-4 text-left">Cliente</th>
              <th class="py-3 px-4 text-left">Total</th>
              <th class="py-3 px-4 text-left">Fecha</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            <tr v-for="venta in ventasFiltradas" :key="venta.id" class="hover:bg-gray-100 dark:hover:bg-gray-700">
              <td class="py-3 px-4">{{ contador++ }}</td>
              <td class="py-3 px-4">{{ venta.cliente_nombre }}</td>
              <td class="py-3 px-4 text-green-600 dark:text-green-400 font-semibold">{{ venta.total }}</td>
              <td class="py-3 px-4">{{ venta.fecha_registro }}</td>
            </tr>
          </tbody>
        </table>

        <!-- Total -->

      </div>

      <!-- Sin ventas -->
      <div v-else class="text-center text-gray-500 dark:text-gray-400 p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <p>No hay ventas disponibles en el rango seleccionado.</p>
      </div>

      <!-- PDF -->

    </div>
  </AppSidebarLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';
import { ref, computed } from 'vue';

const props = defineProps({
  ventas: {
    type: Array,
    required: true
  }
});

const contador = 1;
const fechaInicio = ref('');
const fechaFin = ref('');

const ventasFiltradas = computed(() => {
  return props.ventas.filter(venta => {
    const fecha = venta.fecha_registro.substring(0, 10);
    const desde = fechaInicio.value ? fechaInicio.value : '0000-00-00';
    const hasta = fechaFin.value ? fechaFin.value : '9999-12-31';
    return fecha >= desde && fecha <= hasta;
  });
});
</script>
