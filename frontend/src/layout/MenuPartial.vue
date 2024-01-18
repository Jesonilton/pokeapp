<template>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <router-link to="/" class="navbar-brand">PokeApp</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <router-link to="/pokemons-repository" class="nav-item nav-link">Ver todos</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
</script>

<style scoped>

    .navbar {
      background-color: #007BFF;
      box-shadow: 0 4px 2px -2px gray;
    }

    .navbar-brand, .navbar-nav .nav-link {
      color: white;
    }

    .navbar-toggler-icon {
      background-color: white;
    }

    .navbar-toggler {
      border-color: white;
    }

    .navbar-toggler:hover {
      background-color: white;
    }

    .navbar-collapse {
      background-color: #007BFF;
    }

    .navbar-nav .nav-link {
      padding: 0.5rem 1rem;
    }

    .navbar-nav .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
</style>