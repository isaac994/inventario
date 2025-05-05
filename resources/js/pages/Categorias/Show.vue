<template>
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Detalles de la Categoría</h1>
        <div class="flex space-x-2">
          <Link
            :href="route('categorias.edit', categoria.id)"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
          >
            Editar
          </Link>
          <Link
            :href="route('categorias.index')"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
          >
            Volver
          </Link>
        </div>
      </div>

      <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="grid grid-cols-2 gap-4">
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
            <p class="text-gray-900">{{ categoria.nombre }}</p>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
            <p class="text-gray-900">{{ categoria.descripcion }}</p>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Productos</label>
            <p class="text-gray-900">{{ categoria.productos?.length || 0 }}</p>
          </div>
        </div>

        <div v-if="categoria.productos?.length" class="mt-8">
          <h2 class="text-xl font-bold mb-4">Productos en esta categoría</h2>
          <table class="min-w-full">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="producto in categoria.productos" :key="producto.id">
                <td class="px-6 py-4 whitespace-nowrap">{{ producto.nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap">${{ producto.precio }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ producto.stock }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
  categoria: Object
});
</script>

<script>
export default {
  layout: AppLayout
}
</script> 