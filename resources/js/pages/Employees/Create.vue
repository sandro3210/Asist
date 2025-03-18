<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';  
import { Label } from '@/components/ui/label';

interface EmployeeForm {
  nombre: string;
  correo: string;
  puesto: string;
  calificacion: number;
}

const form = ref<EmployeeForm>({
  nombre: '',
  correo: '',
  puesto: '',
  calificacion: 0,
});

const resetForm = () => {
  form.value = { nombre: '', correo: '', puesto: '', calificacion: 0 };
};

const submit = () => {
  router.post('/employees', form.value, {
    onSuccess: () => resetForm(),
  });
};
</script>

<template>
  <Head title="Crear Empleado" />
  <AppLayout :breadcrumbs="[{ title: 'Empleados', href: '/employees' }]">
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-4">
      <h1 class="text-2xl">Crear Empleado</h1>
      <form @submit.prevent="submit" class="space-y-6 max-w-lg">
        <div v-for="(label, key) in { nombre: 'Nombre', correo: 'Correo', puesto: 'Puesto', calificacion: 'Calificación' }" :key="key">
          <Label :for="key">{{ label }}</Label>
          <Input
            :id="key"
            v-model="form[key]"
            :type="key === 'calificacion' ? 'number' : key === 'correo' ? 'email' : 'text'"
          />
        </div>
        <div class="flex gap-4">
          <Button type="submit" class="bg-indigo-500 hover:bg-indigo-600">Guardar</Button>
          <Button type="button" class="bg-gray-500 text-white hover:bg-gray-700" @click="resetForm">
            Restablecer
          </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
