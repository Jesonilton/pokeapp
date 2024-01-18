<template>

    <TabsComponent :tabs_title="['Repositório', 'Favoritos']">
        <template v-slot:tab0>
            <PokemonRepositoryList></PokemonRepositoryList>
        </template>
        <template v-slot:tab1>
            <PokemonFavoriteList></PokemonFavoriteList>
        </template>
    </TabsComponent>

</template>
<script setup>
    import TabsComponent from '../../components/TabsComponent.vue';
    import PokemonRepositoryList from './PokemonRepositoryList.vue';
    import PokemonFavoriteList from './PokemonFavoriteList.vue';

</script>