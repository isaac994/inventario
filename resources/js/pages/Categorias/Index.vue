<template>
  <div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Lista de Categorias</h1>
      <Link :href="route('categorias.create')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
        Crear Categoría
      </Link>
    </div>

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full">
        <thead class="bg-gray-50 dark:bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Descripción</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
          <tr v-for="categoria in categorias.data" :key="categoria.id">
            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ categoria.nombre }}</td>
            <td class="px-6 py-4 text-gray-900 dark:text-white">{{ categoria.descripcion }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2 items-center">
              <Link :href="route('categorias.show', categoria.id)" class="text-blue-600 hover:text-blue-400" title="Ver">
                <Eye class="w-5 h-5" />
              </Link>
              <Link :href="route('categorias.edit', categoria.id)" class="text-indigo-500 hover:text-indigo-300" title="Editar">
                <Pencil class="w-5 h-5" />
              </Link>
              <button @click="confirmDelete(categoria)" class="text-red-600 hover:text-red-400" title="Eliminar">
                <Trash2 class="w-5 h-5" />
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      <Pagination :links="categorias.links" />
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
  categorias: Object
});

const confirmDelete = (categoria) => {
  if (confirm('¿Estás seguro de que deseas eliminar esta categoría?')) {
    router.delete(route('categorias.destroy', categoria.id));
  }
};
</script>

<script>
export default {
  layout: AppLayout
}
</script>
