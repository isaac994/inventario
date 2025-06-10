<template>
  <AppLayout>
    <div class="max-w-md mx-auto bg-white dark:bg-gray-900 p-8 rounded shadow">
      <h1 class="text-2xl font-bold mb-6">Editar Usuario</h1>
      <form @submit.prevent="submitUsuario">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Nombre</label>
          <input v-model="form.nombre" type="text" class="mt-1 block w-full rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Usuario</label>
          <input v-model="form.usuario" type="text" class="mt-1 block w-full rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Email</label>
          <input v-model="form.email" type="email" class="mt-1 block w-full rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" required />
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Contraseña (dejar en blanco para mantener la actual)</label>
          <input v-model="form.contraseña" type="password" class="mt-1 block w-full rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" />
        </div>
        <div class="flex justify-end gap-2">
          <Link :href="route('usuarios.index')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</Link>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({ usuario: Object });
const form = ref({
  nombre: props.usuario.nombre,
  usuario: props.usuario.usuario,
  email: props.usuario.email,
  contraseña: ''
});

const submitUsuario = () => {
  router.put(route('usuarios.update', props.usuario.id), form.value);
};
</script> 