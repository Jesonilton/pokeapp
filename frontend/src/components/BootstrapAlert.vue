<template>
    <div class="container">
        <div v-if="alert.hasAlert" :class="`alert fade alert-fixed alert-${alert.type} show my-3`">
            {{ alert.message }}
        </div>
    </div>
</template>

<script setup>
    import {ref} from 'vue'
    import {alertStorage} from '../storage/alertStorage'
    const alert = ref(alertStorage());
</script>