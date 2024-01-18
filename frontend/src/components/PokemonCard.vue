<template>
    <div class="card-body p-4">
        <div class="d-flex text-black">
            <div class="flex-shrink-0">
                <router-link :to="`/pokemon-repository/${name}`" title="Ver Detalhes">
                    <img :src="avatar_url" alt="Pokemon image" class="img-fluid" style="width: 200px; border-radius: 10px;">
                </router-link>
            </div>
            <div class="flex-grow-1 ms-3">
                <router-link :to="`/pokemons-repository/${name}`" @click="$emit('showDetails', name)" title="Ver Detalhes" class="nav-item nav-link"><h5 class="mb-1 text-left text-uppercase" style="font-weight: 500;">{{ name }}</h5></router-link>
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
                    <button v-if="!hide_favorite_action" :disabled="disable_favorite_action" type="button" @click="$emit('handleFavorite', name)" class="btn btn-primary flex-grow-1">Adicionar aos Favoritos</button>
                    <button v-if="!hide_delete_action" type="button" @click="$emit('handleDelete', name)" class="btn btn-danger flex-grow-1">Remover dos Favoritos</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { defineProps} from 'vue'
    
    const props = defineProps({
                        avatar_url: String,
                        name: String,
                        weight: Number,
                        height: Number,
                        hide_favorite_action: Boolean,
                        disable_favorite_action: {
                            type: Boolean,
                            default: false 
                        },
                        hide_delete_action: {
                            type: Boolean,
                            default: true 
                        },
                    });
</script>