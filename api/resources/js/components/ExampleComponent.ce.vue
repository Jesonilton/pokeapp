<template>
    <div>
        asdasd
        <h1>{{ message }}</h1>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            message: 'Hello from!'
        };
    },
    methods() {

    },
    async onMounted() {
        let response = await axios.get('http://localhost:8000/api/pokemons');

        console.log(response)
    }
};
</script>