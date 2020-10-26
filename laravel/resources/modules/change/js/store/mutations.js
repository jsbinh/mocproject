const mutations = {
    setFoo (state, value) {
        state.foo = value;
    },
    selectNode (state, value) {
        state.selectedNode = value;
    },
    selectNodeTask (state, value) {
        state.selectedNodeTask = value;
    },
    toggleButtonNewChange (state, value) {
        state.buttonNewChangeClicked = value;
    },
    changeData (state, value) {
        state.dataChanged++;
    }
}

export default mutations;
