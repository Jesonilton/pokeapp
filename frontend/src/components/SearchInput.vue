<template>
    <div class="row d-flex justify-content-end pt-4">
        <div class="col-lg-4">
            <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="term" placeholder="Pesquisar..." aria-label="Pesquisar" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button type="button" v-if="enableReset" @click="resetSearchInput()" class="btn btn btn-default">X</button>
                    <button type="button" @click="findFromSearchInput()" class="btn btn-primary mr-3">Buscar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import {defineModel, ref} from 'vue'
    const term = defineModel()
    const enableReset = ref(false);
    const emit = defineEmits(['resetSearchInput', 'findFromSearchInput'])

    function resetSearchInput() {
        enableReset.value = false;
        term.value = '';
        emit('resetSearchInput', '');
    }

    function findFromSearchInput() {
        if(term.value) {
            enableReset.value = true;
            emit('findFromSearchInput', term);
        }
    }
</script>