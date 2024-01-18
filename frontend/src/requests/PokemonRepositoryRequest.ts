import axios from "axios";

export default class PokemonRepositoryRequest {
    async getAll() {
        try {
            const response = await axios.get(`http://localhost:8000/api/pokemons-repository`);
            
            return {success: true, data: response.data.results, message: ''};
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao buscar dados'};
        }
    }

    async findByName(name: string) {
        try {
            const response = await axios.get(`http://localhost:8000/api/pokemons-repository/${name}`);
            
            return {success: true, data: response.data, message: ''};
        } catch (error) {
            return {success: false, data: [], message: 'Erro ao buscar dados'};
        }
    }
}