<template>
    <div class="row d-flex justify-content-between">
        <SearchInput v-model="filterTerm" @findFromSearchInput="filterByTerm" @resetSearchInput="resetFilterByTerm"></SearchInput>

        <Loading :loading="loading"></Loading>

        <div class="col-lg-12 mb-2" v-if="pokemonResponse && pokemonResponse.name">
            <PokemonCard :disable_favorite_action="pokemonResponse.favorite" @handle-favorite="handleFavorite" @show-details="showDetails" :avatar_url="pokemonResponse.avatarUrl" :name="pokemonResponse.name" :weight="pokemonResponse.weight" :height="pokemonResponse.height"></PokemonCard>
        </div>

        <template v-if="pokemonNotFound">
            <h4 class="text-center text-muted pt-2">Pokemon não encontrado</h4>
        </template>
    </div>
</template>
<script setup>
    import FavoritePokemonsRequest from '../../requests/FavoritePokemonsRequest.ts';
    import PokemonRepositoryRequest from '../../requests/PokemonRepositoryRequest.ts';
    import {alertStorage} from '../../storage/alertStorage'
    import Loading from '../../components/Loading.vue'
    import PokemonCard from '../../components/PokemonCard.vue'
    import SearchInput from '../../components/SearchInput.vue'
    import {ref} from 'vue'

    const loading = ref(false);
    const favoritePokemonsRequest = new FavoritePokemonsRequest();
    const filterTerm = ref('');
    const pokemonRepositoryRequest = new PokemonRepositoryRequest();
    const alert = alertStorage();
    const pokemonResponse = ref(null);
    const pokemonNotFound = ref(false);

    function resetFilterByTerm() {
        pokemonResponse.value = null
    }

    async function filterByTerm() {
        if(!filterTerm.value) {
            pokemonResponse.value = null
            return;
        }

        loading.value = true;
        let response = await pokemonRepositoryRequest.findByName(filterTerm.value)
        pokemonResponse.value = response.data
        pokemonNotFound.value = !response.success;
        loading.value = false;
    }

    async function handleFavorite(name) {
        loading.value = true;
        let response = await favoritePokemonsRequest.addToFavorites(name);
        alert.showAlert(response.message, response.success? 'success' : 'danger');
        filterByTerm();
        loading.value = false;
    }
</script>