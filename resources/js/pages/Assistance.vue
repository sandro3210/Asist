<template>
    <div>
        <h1>Asistencias</h1>

        <div v-if="successMessage" class="alert alert-success">
            {{ successMessage }}
        </div>

        <div v-if="errorMessage" class="alert alert-danger">
            {{ errorMessage }}
        </div>

        <div class="mb-3">
            <form @submit.prevent="checkIn">
                <button type="submit" class="btn btn-primary">Check-in</button>
            </form>
        </div>

        <div class="mb-3">
            <form @submit.prevent="checkOut">
                <button type="submit" class="btn btn-secondary">Check-out</button>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="assistance in assistances" :key="assistance.id">
                    <td>{{ assistance.id }}</td>
                    <td>{{ assistance.check_in }}</td>
                    <td>{{ assistance.check_out }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        assistances: Array,
        successMessage: String,
        errorMessage: String
    },
    methods: {
        checkIn() {
            this.$inertia.post(route('assistances.check-in'));
        },
        checkOut() {
            this.$inertia.post(route('assistances.check-out'));
        }
    }
}
</script>

<style scoped>
/* Estilos específicos para este componente */
</style>
