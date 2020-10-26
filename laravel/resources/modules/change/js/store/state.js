// root state object.
// each Vuex instance is just a single state tree.
const state = {
    foo: 'bar',
    selectedNode: null,
    selectedNodeTask: null,
    buttonNewChangeClicked: {
        clicked: false,
        meta: {
            factory: null,
            unit: null,
            system: null
        }
    },
    dataChanged: 0
}

export default state;
