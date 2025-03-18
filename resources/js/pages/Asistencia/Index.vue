<script setup lang="ts">
import { ref, onMounted } from 'vue';
import axios from 'axios'; 
import AppLayout from '@/layouts/AppLayout.vue';
import { Table, TableBody, TableCaption, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';

// Definir la estructura de datos
interface Asistencia {
  id: number;
  user: { name: string };
  fecha: string;
  hora_entrada?: string;
  hora_salida?: string;
  estado: string;
}

// Variable reactiva para almacenar asistencias
const asistencias = ref<Asistencia[]>([]);

// Función para obtener asistencias
const getAsistencias = async () => {
  try {
    const response = await axios.get<Asistencia[]>('http://localhost:8000/api/asistencias');
    asistencias.value = response.data;
  } catch (error) {
    console.error('Error al obtener asistencias:', error);
  }
};

// Obtener asistencias al montar el componente
onMounted(getAsistencias);
</script>

<template>
  <AppLayout>
    <div class="container mx-auto p-6">
      <h2 class="text-xl font-semibold text-white mb-4">Lista de Asistencias</h2>

      <div class="bg-gray-900 rounded-lg shadow-md overflow-hidden">
        <Table class="w-full border-collapse">
          <TableHead class="bg-gray-800 text-gray-300">
            <TableRow>
              <TableHead class="w-10 text-center">ID</TableHead>
              <TableHead class="w-1/4">Usuario</TableHead>
              <TableHead class="w-1/5">Fecha</TableHead>
              <TableHead class="w-1/6">Entrada</TableHead>
              <TableHead class="w-1/6">Salida</TableHead>
              <TableHead class="w-1/6">Estado</TableHead>
            </TableRow>
          </TableHead>

          <TableBody>
            <TableRow v-if="asistencias.length === 0">
              <TableCell colspan="6" class="py-4 text-center text-gray-400">
                No hay registros disponibles.
              </TableCell>
            </TableRow>

            <TableRow v-for="asistencia in asistencias" :key="asistencia.id" class="border-t border-gray-700">
              <TableCell class="text-center">{{ asistencia.id }}</TableCell>
              <TableCell>{{ asistencia.user.name }}</TableCell>
              <TableCell>{{ asistencia.fecha }}</TableCell>
              <TableCell>{{ asistencia.hora_entrada || 'No registrada' }}</TableCell>
              <TableCell>{{ asistencia.hora_salida || 'No registrada' }}</TableCell>
              <TableCell>{{ asistencia.estado }}</TableCell>
            </TableRow>
          </TableBody>
        </Table>
      </div>
    </div>
  </AppLayout>
</template>


<style scoped>
/* Contenedor para ocupar el ancho completo */
.container {
  width: 100%;
  max-width: 1200px;
  margin: auto;
}

/* Estilos de tabla */
table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  padding: 12px;
  text-align: left;
}

th {
  background-color: #333;
  color: #fff;
}

tbody tr {
  background-color: #222;
  color: #ddd;
}

tbody tr:nth-child(even) {
  background-color: #2a2a2a;
}

/* Responsividad */
@media (max-width: 768px) {
  th, td {
    font-size: 14px;
    padding: 8px;
  }
}
</style>
