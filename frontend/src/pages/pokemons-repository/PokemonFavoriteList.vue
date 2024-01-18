<template>
    <div class="row d-flex justify-content-between">

        <SearchInput v-model="filterTerm" @findFromSearchInput="filterByTerm" @resetSearchInput="resetFilterByTerm"></SearchInput>

        <Loading :loading="loading"></Loading>

        <div class="col-lg-2 mb-2">
            <button class="btn btn-sm btn-primary text-white" @click="filterByTerm()"><i class="fas fa-refresh"></i></button>
        </div>

        <template v-for="pokemon in pokemonList">
            <div class="col-lg-12 mb-2">
                <PokemonCard disable_favorite_action hide_favorite_action :hide_delete_action="false" @handle-delete="deleteFavorite" @show-details="showDetails" :avatar_url="pokemon.avatar" :name="pokemon.name" :weight="pokemon.weight" :height="pokemon.height"></PokemonCard>
            </div>
        </template>

        <template v-if="pokemonNotFound">
            <h4 class="text-center text-muted pt-2">Pokemon não encontrado</h4>
        </template>
    </div>
</template>
<script setup>
    import FavoritePokemonsRequest from '../../requests/FavoritePokemonsRequest.ts';
    import PokemonCard from '../../components/PokemonCard.vue'
    import Loading from '../../components/Loading.vue'
    import SearchInput from '../../components/SearchInput.vue'
    import {alertStorage} from '../../storage/alertStorage'
    import { onMounted, ref } from 'vue'

    const loading = ref(false);
    const filterTerm = ref('');
    const favoritePokemonsRequest = new FavoritePokemonsRequest();
    const alert = alertStorage();
    const pokemonList = ref([]);
    const pokemonResponse = ref(null);
    const pokemonNotFound = ref(false);

    function resetFilterByTerm() {
        filterByTerm();
    }

    async function filterByTerm() {
        loading.value = true;

        if(!filterTerm.value) {
            pokemonList.value = await favoritePokemonsRequest.getAll();
            loading.value = false;
            return;
        }

        pokemonList.value = await favoritePokemonsRequest.getAll(filterTerm.value)
        loading.value = false;
    }

    async function showDetails() {
        piniaPokemonStore.setPokemon(pokemonResponse.value);
    }

    async function deleteFavorite(pokemonName) {
        loading.value = true;
        let response = await favoritePokemonsRequest.removeFromFavorites(pokemonName);
        alert.showAlert(response.message, response.success? 'success' : 'danger');
        filterByTerm();
        loading.value = false;
    }

    onMounted(async() => {
        pokemonList.value = await favoritePokemonsRequest.getAll();
        console.log(pokemonList);
    }); 
</script>