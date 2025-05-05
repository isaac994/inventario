<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Lista de Productos</h1>
      <Link :href="route('productos.create')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Crear Producto
      </Link>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full min-w-max">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Identificador</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Categoría</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Precio</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Existencias</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            <tr v-for="producto in productos.data" :key="producto.id">
              <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ producto.nombre }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ producto.identificador }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ producto.categoria?.nombre }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ producto.precio }} Bs</td>
              <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ producto.stock }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span
                  :class="producto.estado ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300'"
                  class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
                >
                  {{ producto.estado ? 'Activo' : 'Inactivo' }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2 items-center">
                <Link :href="route('productos.show', producto.id)" class="text-blue-600 hover:text-blue-400" title="Ver">
                  <Eye class="w-5 h-5" />
                </Link>
                <Link :href="route('productos.edit', producto.id)" class="text-indigo-500 hover:text-indigo-300" title="Editar">
                  <Pencil class="w-5 h-5" />
                </Link>
                <button @click="confirmDelete(producto)" class="text-red-600 hover:text-red-400" title="Eliminar">
                  <Trash2 class="w-5 h-5" />
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-4">
      <Pagination :links="productos.links" />
    </div>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import Pagination from '@/components/Pagination.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { Trash2 } from 'lucide-vue-next';
import { Pencil } from 'lucide-vue-next';
import { Eye } from 'lucide-vue-next';

defineProps({
  productos: Object
});

const confirmDelete = (producto) => {
  if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
    router.delete(route('productos.destroy', producto.id));
  }
};
</script>

<script>
export default {
  layout: AppLayout
}
</script>