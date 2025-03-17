<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';  
import { Label } from '@/components/ui/label';

interface EmployeeForm {
  name: string;
  email: string;
  position: string;
  grade: number;
}

const form = ref<EmployeeForm>({
  name: '',
  email: '',
  position: '',
  grade: 0,
});

const resetForm = () => {
  form.value = { name: '', email: '', position: '', grade: 0 };
};

const submit = () => {
  router.post('/employees', form.value, {
    onSuccess: () => resetForm(),
  });
};
</script>

<template>
  <Head title="Create Employee" />
  <AppLayout :breadcrumbs="[{ title: 'Employees', href: '/employees' }]">
    <div class="flex flex-1 flex-col gap-4 rounded-xl p-4">
      <h1 class="text-2xl">Create Employee</h1>
      <form @submit.prevent="submit" class="space-y-6 max-w-lg">
        <div v-for="(label, key) in { name: 'Name', email: 'Email', position: 'Position', grade: 'Grade' }" :key="key">
          <Label :for="key">{{ label }}</Label>
          <Input
            :id="key"
            v-model="form[key]"
            :type="key === 'grade' ? 'number' : key === 'email' ? 'email' : 'text'"
          />
        </div>
        <div class="flex gap-4">
          <Button type="submit" class="bg-indigo-500 hover:bg-indigo-600">Save</Button>
          <Button type="button" class="bg-gray-500 text-white hover:bg-gray-700" @click="resetForm">
            Reset
          </Button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>
