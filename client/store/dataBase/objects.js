import axios from 'axios';
// http://213.230.96.125/api/residential_complexes

export const state = () => ({
	objects: []
});

export const mutations = { //изменяет состония в state очередь
	SET_OBJECTS_TO_STATE: (state, objects) => {
		state.objects = objects;
	}
}

export const actions = { //изменяет состония в state без очереди
	GET_OBJECTS_FROM_API({commit}) {
		return axios('http://213.230.96.125/api/residential_complexes', {
			method: "GET"
		})
		.then((objects) => {
			commit('SET_OBJECTS_TO_STATE', objects.data);
			return objects;
		})
		.catch((error) => {
			console.log(error);
			return error;
		})
	}
}

export const getters = { //короткий путь до state
	OBJECTS(state) {
		return state.objects;
	}
}