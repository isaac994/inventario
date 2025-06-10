<template>
  <AppSidebarLayout>
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Lista de Ventas</h1>
        <Link :href="route('ventas.create')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" as="button">
          <span>Nueva Venta</span>
        </Link>
      </div>
      <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full min-w-max">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Cliente</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Vendedor</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              <tr v-for="venta in ventas" :key="venta.id">
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ venta.id }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ venta.cliente_nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ venta.usuario?.nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ venta.total }} Bs</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ venta.fecha_registro }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2 items-center">
                  <Link :href="route('ventas.show', venta.id)" class="text-blue-600 hover:text-blue-400" title="Ver Detalles">
                    Ver
                  </Link>
                  <button @click="confirmDelete(venta)" class="text-red-600 hover:text-red-400" title="Eliminar">
                    Eliminar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppSidebarLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppSidebarLayout from '@/layouts/app/AppSidebarLayout.vue';

const props = defineProps({
  ventas: {
    type: Array,
    required: true
  }
});

const confirmDelete = (venta) => {
  if (confirm('¿Estás seguro de que deseas eliminar esta venta?')) {
    router.delete(route('ventas.destroy', venta.id));
  }
};

// Verificar si hay ventas disponibles
if (!props.ventas.length) {
  console.log('No hay ventas disponibles');
}
</script> 