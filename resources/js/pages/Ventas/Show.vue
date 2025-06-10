<template>
  <AppLayout>
    <div class="container mx-auto px-4 py-8">
      <h1 class="text-2xl font-bold mb-6">Detalles de Venta</h1>
      <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <p class="text-sm font-medium text-gray-500">ID de Venta</p>
          <p class="mt-1">{{ venta.id }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Cliente</p>
          <p class="mt-1">{{ venta.cliente_nombre }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Vendedor</p>
          <p class="mt-1">{{ venta.usuario?.nombre }}</p>
        </div>
        <div>
          <p class="text-sm font-medium text-gray-500">Fecha</p>
          <p class="mt-1">{{ venta.fecha_registro }}</p>
        </div>
      </div>
      <div class="mt-8">
        <h3 class="text-lg font-medium text-gray-900">Productos</h3>
        <div class="mt-4">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Producto</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio Unitario</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="detalle in venta.detalles" :key="detalle.id">
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ detalle.producto?.nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ detalle.cantidad }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ detalle.producto_precio }} Bs</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ detalle.subTotal }} Bs</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="3" class="px-6 py-4 text-right font-medium">Total:</td>
                <td class="px-6 py-4 font-medium">{{ venta.total }} Bs</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="mt-6 flex items-center justify-end">
        <Link :href="route('ventas.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
          Volver
        </Link>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
defineProps({ venta: Object });
</script> 