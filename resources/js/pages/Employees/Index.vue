<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import { Employee, type BreadcrumbItem, type SharedData } from '@/types';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { CirclePlus, Pencil, Trash } from 'lucide-vue-next';
import { computed } from 'vue';

interface EmployeePageProps extends SharedData {
    employees: Employee[];
}

const { props } = usePage<EmployeePageProps>();
const employees = computed(() => props.employees);

const breadcrumbs: BreadcrumbItem[] = [{ title: 'Empleados', href: '/employees' }];

const deleteEmployee = async (id: number) => {
    if (!window.confirm('¿Estás seguro de que deseas eliminar este empleado?')) return;

    router.delete(`/employees/${id}`, {
        preserveScroll: true,
        onSuccess: () => {
            router.visit('/employees', { replace: true });
        },
        onError: (errors) => {
            console.error('Error al eliminar el empleado', errors);
        }
    });
};
</script>

<template>
    <Head title="Empleados" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-col gap-4 rounded-xl p-4">
            <div class="flex">
                <Button as-child size="sm" class="bg-indigo-500 text-white hover:bg-indigo-700">
                    <Link href="/employees/create"> <CirclePlus /> Crear </Link>
                </Button>
            </div>

            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar/70 dark:border-sidebar-border md:min-h-min">
                <Table>
                    <TableCaption>Lista de Empleados.</TableCaption>
                    <TableHeader>
                        <TableRow>
                            <TableHead>Nombre</TableHead>
                            <TableHead>Correo Electrónico</TableHead>
                            <TableHead>Posición</TableHead>
                            <TableHead class="text-right">Grado</TableHead>
                            <TableHead class="text-center">Acciones</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="employee in employees" :key="employee.id">
                            <TableCell class="font-medium">{{ employee.name }}</TableCell>
                            <TableCell>{{ employee.email ?? 'N/A' }}</TableCell>
                            <TableCell>{{ employee.position ?? 'N/A' }}</TableCell>
                            <TableCell class="text-right">
                                {{ new Intl.NumberFormat('es-ES', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(employee.grade) }}
                            </TableCell>
                            <TableCell class="text-center">
                                <div class="flex items-center gap-2 justify-center">
                                    <Link :href="`/employees/${employee.id}/edit`" class="p-2 rounded bg-indigo-500 text-white hover:bg-indigo-700 flex items-center">
                                        <Pencil />
                                    </Link>
                                    <Button size="sm" class="bg-rose-500 text-white hover:bg-rose-700 flex items-center p-2" @click="deleteEmployee(employee.id)">
                                        <Trash />
                                    </Button>
                                </div>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>