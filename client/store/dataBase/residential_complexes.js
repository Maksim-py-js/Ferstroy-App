import axios from 'axios';
// http://213.230.96.125/api/residential_complexes

export const state = () => ({
	residential_complexes: []
});

export const mutations = { //изменяет состония в state очередь
	SET_RESIDENTIAL_COMPLEXES_TO_STATE: (state, residential_complexes) => {
		state.residential_complexes = residential_complexes;
	}
}

export const actions = { //изменяет состония в state без очереди
	GET_RESIDENTIAL_COMPLEXES_FROM_API({commit}) {
		return axios('http://213.230.96.125/api/residential_complexes', {
			method: "GET"
		})
		.then((residential_complexes) => {
			commit('SET_RESIDENTIAL_COMPLEXES_TO_STATE', residential_complexes.data);
			return residential_complexes;
		})
		.catch((error) => {
			console.log(error);
			return error;
		})
	}
}

export const getters = { //короткий путь до state
	RESIDENTIAL_COMPLEXES(state) {
		return state.residential_complexes;
	}
}