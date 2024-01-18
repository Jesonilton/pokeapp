import './bootstrap';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
import PokemonListItem from '@/components/PokemonListItem.vue';

import Vue from 'vue';

new Vue({
  render: (h) => h(PokemonListItem),
}).$mount('#app');
// import { defineCustomElement } from 'vue'

// window.onload = function () {
//     customElements.define('pokemon-list-item', defineCustomElement(PokemonListItem))
// }