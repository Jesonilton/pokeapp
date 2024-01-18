<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="col col-lg-9 col-xl-8">
                <div class="card">
                    <div class="rounded-top text-white d-flex flex-row" style="background-color: #007bff; height:200px;">
                        <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                            <img :src="pokemonResponse.avatarUrl" alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2" style="width: 150px; z-index: 1">
                        </div>
                        <div class="ms-3" style="margin-top: 130px;">
                            <h5>{{ pokemonResponse.name }}</h5>
                        </div>
                    </div>
                    <div class="p-4 text-black" style="background-color: #f8f9fa;">
                        <div class="d-flex justify-content-end text-center py-1">
                            <div class="px-3">
                                <p class="mb-1 h5">{{ pokemonResponse.weight }}</p>
                                <p class="small text-muted mb-0">Peso</p>
                            </div>
                            <div>
                                <p class="mb-1 h5">{{ pokemonResponse.height }}</p>
                                <p class="small text-muted mb-0">Altura</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4 text-black">
                        <div class="mb-5">
                            <p class="lead fw-normal mb-1">Sobre</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <p class="lead fw-normal mb-0">{{pokemonResponse.name}} é um pokemon de tipo {{ pokemonResponse.types.join(', ')}}.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { defineProps, ref, onMounted} from 'vue'
    import PokemonRepositoryRequest from '../../requests/PokemonRepositoryRequest.ts';
    
    const pokemonRepositoryRequest = new PokemonRepositoryRequest();
    const pokemonResponse = ref({types: []});

    const props = defineProps({
        pokemonName: String,
    });

    onMounted(async() => {
        pokemonResponse.value = await pokemonRepositoryRequest.findByName(props.pokemonName);
        pokemonResponse.value = pokemonResponse.value.data;
    });
</script>