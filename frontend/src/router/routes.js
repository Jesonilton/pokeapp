import { createRouter, createWebHistory } from "vue-router";
import HomePage from '../pages/HomePage.vue'

const routes = [
    {
        path: '/',
        name: 'HomePage',
        component: HomePage
    },
    {
        path: '/pokemons-repository',
        name: 'PokemonsRepository',
        component: () => import('../pages/pokemons-repository/IndexPage.vue')
    },
    {
        path: '/pokemons-repository/:pokemonName',
        name: 'PokemonDetail',
        props: true,
        component: () => import('../pages/pokemons-repository/PokemonDetail.vue'),
    },
    {
        path: '/:catchAll(.*)*',
        component: () => import('../pages/ErrorNotFound.vue'),
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;