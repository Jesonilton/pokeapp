import axios from "axios";

export default class FavoritePokemonsRequest {
    async getAll(term:string) {
        try {
            let url = `http://localhost:8000/api/favorite-pokemons`;
            
            if(term) {
                url += '?q='+term;
            }

            const response = await axios.get(url);
                console.log(response.data);
            return response.data;
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao buscar dados'};
        }
    }

    async findByName(name: string) {
        try {
            const response = await axios.get(`http://localhost:8000/api/favorite-pokemons/${name}`);
            
            return {success: true, data: response.data, message: ''};
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao buscar dados'};
        }
    }

    async addToFavorites(pokemonName: string) {
        try {
            const response = await axios.post(`http://localhost:8000/api/favorite-pokemons`, {name: pokemonName});
            return {success: true, data: response.data, message: 'Adicionado com sucesso'};
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao importar'};
        }
    }

    async removeFromFavorites(pokemonName: string) {
        try {
            const response = await axios.delete(`http://localhost:8000/api/favorite-pokemons/${pokemonName}`);
            return {success: true, data: response.data, message: 'Removido com sucesso'};
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao deletar usuário'};
        }
    }
}