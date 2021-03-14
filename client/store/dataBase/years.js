import axios from 'axios';
// http://213.230.96.125/api/years

export const state = () => ({
	years: []
});

export const mutations = { //изменяет состония в state очередь
	SET_YEARS_TO_STATE: (state, years) => {
		state.years = years;
	}
}

export const actions = { //изменяет состония в state без очереди
	GET_YEARS_FROM_API({commit}) {
		return axios('http://213.230.96.125/api/years', {
			method: "GET"
		})
		.then((years) => {
			commit('SET_YEARS_TO_STATE', years.data);
			return years;
		})
		.catch((error) => {
			console.log(error);
			return error;
		})
	}
}

export const getters = { //короткий путь до state
	YEARS(state) {
		return state.years;
	}
}