<template>
  <AppLayout>
    <div class="container mx-auto px-4 py-8">
      <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Lista de Usuarios</h1>
        <Link :href="route('usuarios.create')" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
          Nuevo Usuario
        </Link>
      </div>
      <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full min-w-max">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nombre</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Usuario</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Fecha Registro</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Acciones</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              <tr v-for="usuario in usuarios" :key="usuario.id">
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ usuario.nombre }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ usuario.usuario }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ usuario.email }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">{{ usuario.fecha_registro }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2 items-center">
                  <Link :href="route('usuarios.edit', usuario.id)" class="text-indigo-500 hover:text-indigo-300" title="Editar">
                    Editar
                  </Link>
                  <button @click="confirmDelete(usuario)" class="text-red-600 hover:text-red-400" title="Eliminar">
                    Eliminar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
defineProps({ usuarios: Array });
const confirmDelete = (usuario) => {
  if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
    router.delete(route('usuarios.destroy', usuario.id));
  }
};
</script> 