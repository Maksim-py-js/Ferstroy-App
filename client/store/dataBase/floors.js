import axios from 'axios';
// http://213.230.96.125/api/floors

export const state = () => ({
	floors: []
});

export const mutations = { //изменяет состония в state очередь
	SET_FLOORS_TO_STATE: (state, floors) => {
		state.floors = floors;
	}
}

export const actions = { //изменяет состония в state без очереди
	GET_FLOORS_FROM_API({commit}) {
		return axios('http://213.230.96.125/api/floors', {
			method: "GET"
		})
		.then((floors) => {
			commit('SET_FLOORS_TO_STATE', floors.data);
			return floors;
		})
		.catch((error) => {
			console.log(error);
			return error;
		})
	}
}

export const getters = { //короткий путь до state
	FLOORS(state) {
		return state.floors;
	}
}