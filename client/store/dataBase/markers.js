import axios from 'axios';
// http://213.230.96.125/api/map_markers

export const state = () => ({
	map_markers: []
});

export const mutations = { //изменяет состония в state очередь
	SET_MARKERS_TO_STATE: (state, map_markers) => {
		state.map_markers = map_markers;
	}
}

export const actions = { //изменяет состония в state без очереди
	GET_MARKERS_FROM_API({commit}) {
		return axios('http://213.230.96.125/api/map_markers', {
			method: "GET"
		})
		.then((map_markers) => {
			commit('SET_MARKERS_TO_STATE', map_markers.data);
			return map_markers;
		})
		.catch((error) => {
			console.log(error);
			return error;
		})
	}
}

export const getters = { //короткий путь до state
	MARKERS(state) {
		return state.map_markers;
	}
}