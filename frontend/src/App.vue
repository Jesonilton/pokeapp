<template>
  <!-- Alertas são repassados via pinia -->
  <BootstrapAlert></BootstrapAlert>

  <Menu></Menu>

  <div class="container p-4">
    <router-view />
  </div>

  <Footer></Footer>

</template>

<script>
import Menu from './layout/MenuPartial.vue'
import Footer from './layout/FooterPartial.vue'
import BootstrapAlert from './components/BootstrapAlert.vue'

export default {
  name: 'App',
  components: {
    Menu,
    Footer,
    BootstrapAlert
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
  padding-top: 56px;
}
</style>
