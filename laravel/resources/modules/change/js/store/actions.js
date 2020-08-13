export const setFoo = ({commit}, payload) => {
    commit('setFoo', payload)
}

export const selectNode = ({commit}, payload) => {
    commit('selectNode', payload);
}

export const toggleButtonNewChange = ({commit}, payload) => {
    commit('toggleButtonNewChange', payload);
}

export const changeData = ({commit}) => {
    commit('changeData');
}
