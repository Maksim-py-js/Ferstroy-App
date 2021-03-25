import axios from 'axios';
// http://213.230.96.125/api/houses

export const state = () => ({
	houses: []
});

export const mutations = { //изменяет состония в state очередь
	SET_HOUSES_TO_STATE: (state, houses) => {
		state.houses = houses;
	}
}

export const actions = { //изменяет состония в state без очереди
	GET_HOUSES_FROM_API({commit}) {
		return axios('http://213.230.96.125/api/houses', {
			method: "GET"
		})
		.then((houses) => {
			commit('SET_HOUSES_TO_STATE', houses.data);
			return houses;
		})
		.catch((error) => {
			console.log(error);
			return error;
		})
	}
}

export const getters = { //короткий путь до state
	HOUSES(state) {
		return state.houses;
	}
}