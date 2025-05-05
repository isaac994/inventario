<template>
  <div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Detalles del Producto</h1>
        <div class="flex space-x-2">
          <Link
            :href="route('productos.edit', producto.id)"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
          >
            Editar
          </Link>
          <Link
            :href="route('productos.index')"
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
            <p class="text-gray-900">{{ producto.nombre }}</p>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Identificador</label>
            <p class="text-gray-900">{{ producto.identificador }}</p>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Descripción</label>
            <p class="text-gray-900">{{ producto.descripcion }}</p>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Precio</label>
            <p class="text-gray-900">${{ producto.precio }}</p>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Stock</label>
            <p class="text-gray-900">{{ producto.stock }}</p>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Categoría</label>
            <p class="text-gray-900">{{ producto.categoria?.nombre }}</p>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Estado</label>
            <span
              :class="producto.estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
            >
              {{ producto.estado ? 'Activo' : 'Inactivo' }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
  producto: Object
});
</script>

<script>
export default {
  layout: AppLayout
}
</script> 