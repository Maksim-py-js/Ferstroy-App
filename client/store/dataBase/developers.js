import axios from 'axios';
// http://213.230.96.125/api/developers

export const state = () => ({
	developers: []
});

export const mutations = { //изменяет состония в state очередь
	SET_DEVELOPERS_TO_STATE: (state, developers) => {
		state.developers = developers;
	}
}

export const actions = { //изменяет состония в state без очереди
	GET_DEVELOPERS_FROM_API({commit}) {
		return axios('http://213.230.96.125/api/developers', {
			method: "GET"
		})
		.then((developers) => {
			commit('SET_DEVELOPERS_TO_STATE', developers.data);
			return developers;
		})
		.catch((error) => {
			console.log(error);
			return error;
		})
	}
}

export const getters = { //короткий путь до state
	DEVELOPERS(state) {
		return state.developers;
	}
}