<template>
    <div class="card-body p-4">
        <div class="d-flex text-black">
            <div class="flex-shrink-0">
                <a htef="`/github-users/`" title="Ver Perfil">
                    <img :src="avatar_url" alt="User image" class="img-fluid" style="width: 180px; border-radius: 10px;">
                </a>
            </div>
            <div class="flex-grow-1 ms-3">
                <a htef="`/github-users/`" title="Ver Perfil" class="nav-item nav-link"><h5 class="mb-1 text-left text-uppercase" style="font-weight: 500;">{{ name }}</h5></a>
                <p class="mb-2 pb-1 text-left" style="color: #2b2a2a;"><a class="mb-4" target="_blank" :href="`https://github.com/`">{{ name }}</a></p>
                <div class="d-flex justify-content-around text-center rounded-3 p-2 mb-2" style="background-color: #efefef;">
                    <div class="px-3">
                        <p class="small text-muted mb-1">Weight</p>
                        <p class="mb-0">{{ weight }}</p>
                    </div>
                    <div>
                        <p class="small text-muted mb-1">Height</p>
                        <p class="mb-0">{{ height }}</p>
                    </div>
                </div>
                <div class="d-flex pt-1">
                    <button v-if="!hide_import_action" type="button" @click="$emit('handleImport', name)" class="btn btn-primary flex-grow-1">Importar</button>
                    <button v-if="!hide_delete_action" type="button" @click="$emit('handleDelete', name)" class="btn btn-danger flex-grow-1">Deletar</button>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import axios from 'axios';

    export default {
        props: ['avatar_url', 'name', 'weight', 'height', 'hide_import_action', 'hide_delete_action'],
        data() {
            return {
                message: 'Hello from!'
            };
        },
        methods() {

        },
        // async onMounted() {
        //     let response = await axios.get('http://localhost:8000/api/pokemons');

        //     console.log(response)
        // }
    };
</script>