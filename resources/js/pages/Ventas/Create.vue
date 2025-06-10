<template>
  <AppLayout>
    <div class="container mx-auto px-4 py-8">
      <div class="max-w-4xl mx-auto bg-white dark:bg-gray-900 p-8 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Registrar Nueva Venta</h1>
        <form @submit.prevent="submitVenta">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Nombre del Cliente</label>
            <input v-model="form.cliente_nombre" type="text" class="mt-1 block w-full rounded border border-gray-500 bg-gray-800 text-white" required />
          </div>
          <div class="mb-4">
            <h3 class="text-lg font-medium mb-2">Productos</h3>
            <div v-if="!productos.length" class="text-red-500 mb-4">
              No hay productos disponibles para la venta.
            </div>
            <div v-for="(item, idx) in form.productos" :key="idx" class="mb-2 flex flex-wrap gap-2 items-center w-full">
              <select
                v-model="item.id"
                class="rounded border border-gray-500 bg-gray-800 text-white"
                required
                @change="updatePrecio(idx)"
              >
                <option value="">Seleccione un producto</option>
                <option v-for="producto in productos" :key="producto.id" :value="producto.id">
                  {{ producto.nombre }} - {{ producto.precio }} Bs
                </option>
              </select>
              <input
                v-model.number="item.cantidad"
                type="number"
                min="1"
                class="w-20 rounded border border-gray-500 bg-gray-800 text-white"
                required
                @input="updateSubtotal(idx)"
              />
              <input
                :value="item.precio_unitario + ' Bs'"
                type="text"
                class="w-24 rounded border border-gray-500 bg-gray-800 text-white"
                readonly
                tabindex="-1"
              />
              <input
                :value="item.subtotal + ' Bs'"
                type="text"
                class="w-24 rounded border border-gray-500 bg-gray-800 text-white"
                readonly
                tabindex="-1"
              />
              <button type="button" @click="removeProducto(idx)" class="bg-red-500 hover:bg-red-700 text-white font-semibold px-3 py-2 rounded transition flex-shrink-0 h-10">Eliminar</button>
            </div>
            <button type="button" @click="addProducto" class="bg-green-500 text-white px-2 py-1 rounded">Agregar Producto</button>
          </div>
          <div class="mb-4">
            <label class="block text-sm font-medium text-white">Total</label>
            <input :value="total + ' Bs'" type="text" class="mt-1 block w-full rounded border-gray-300 bg-gray-800 text-white" readonly />
          </div>
          <div class="flex justify-end gap-2">
            <Link :href="route('ventas.index')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</Link>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Registrar Venta</button>
          </div>
        </form>
        <div v-if="Object.keys(form.errors).length" class="text-red-500 mt-2">
          <div v-for="(msg, key) in form.errors" :key="key">{{ msg }}</div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { ref, computed, onMounted, watch } from 'vue';
import AppLayout from '@/layouts/AppLayout.vue';

const props = defineProps({
  productos: {
    type: Array,
    default: () => []
  },
  usuarios: {
    type: Array,
    default: () => []
  }
});

console.log('Productos recibidos:', props.productos);

// Verificar si hay productos y usuarios disponibles
if (!props.productos.length) {
  console.log('No hay productos disponibles para la venta.');
}

if (!props.usuarios.length) {
  console.log('No hay vendedores disponibles.');
}

const form = useForm({
  cliente_nombre: '',
  productos: []
});

const addProducto = () => {
  form.productos.push({
    id: '',
    cantidad: 1,
    precio_unitario: 0,
    subtotal: 0
  });
  console.log('Productos en el form:', form.productos);
};

const removeProducto = (idx) => {
  form.productos.splice(idx, 1);
};

const updatePrecio = (idx) => {
  if (props && props.productos && Array.isArray(props.productos)) {
    const producto = props.productos.find(p => p.id === form.productos[idx].id);
    if (producto) {
      form.productos[idx].precio_unitario = producto.precio;
      updateSubtotal(idx);
    }
  }
};

const updateSubtotal = (idx) => {
  form.productos[idx].subtotal = form.productos[idx].cantidad * form.productos[idx].precio_unitario;
};

const total = computed(() => {
  return form.productos.reduce((sum, item) => sum + item.subtotal, 0);
});

const submitVenta = () => {
  // Filtra productos válidos (id y cantidad > 0)
  const productosValidos = form.productos.filter(
    item => item.id && item.cantidad > 0
  );
  if (productosValidos.length === 0) {
    alert('Debes agregar al menos un producto válido.');
    return;
  }
  // Prepara los datos para enviar solo lo necesario
  const formData = {
    cliente_nombre: form.cliente_nombre,
    productos: productosValidos.map(item => ({
      id: item.id,
      cantidad: item.cantidad
    }))
  };
  router.post(route('ventas.store'), formData, {
    preserveScroll: true,
    onSuccess: () => {
      form.reset();
      // Opcional: window.location.reload();
    },
    onError: (errors) => {
      alert('Error al registrar la venta');
    }
  });
};

onMounted(() => {
  // Si no hay productos en el form, agrega uno por defecto
  if (form.productos.length === 0) {
    addProducto();
  }
});

watch(
  () => (props && props.productos ? form.productos.map(item => item.id) : []),
  (newIds, oldIds) => {
    if (props && props.productos && Array.isArray(props.productos)) {
      newIds.forEach((id, idx) => {
        if (id && (!oldIds || id !== oldIds[idx])) {
          updatePrecio(idx);
        }
      });
    }
  }
);
</script> 