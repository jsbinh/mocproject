<template>
    <v-card>
        <v-sheet class="pa-4 dark lighten-2">
            <v-text-field v-model="search"
                label="Search Factory / Unit / System / Change"
                dark flat solo-inverted hide-details
                clearable clear-icon="mdi-close-circle-outline"></v-text-field>
            <!-- <v-checkbox
                v-model="caseSensitive"
                dark
                hide-details
                label="Case sensitive search"
            ></v-checkbox> -->
        </v-sheet>
        <v-card-text v-if="items" class="tree-container">
            <v-treeview
                return-object
                :items="items"
                :search="search"
                :filter="filter"
                :open-all="true"
                rounded
                hoverable
                activatable
                @update:active="selectNode"
            >
                <template v-slot:prepend="{ item }">
                    <v-icon v-text="`mdi-${item.level === 0 ? 'factory' : item.level === 1 ? 'view-stream' : item.level === 2 ? 'view-stream' : 'clipboard-list-outline'}`">
                    </v-icon>
                </template>
                <template slot="append" slot-scope="{ item }">
                    <v-btn rounded small v-if="item.level === 2" @click="e => newChange(e, item)" title="Create a new change">
                        <v-icon left>mdi-plus-circle</v-icon> New Change
                    </v-btn>
                </template>
            </v-treeview>
        </v-card-text>
    </v-card>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "ChangeFilter",
        data: () => ({
            items: undefined,
            // open: [1, 2],
            search: null,
            caseSensitive: false,
        }),
        mounted() {
            this.loadData();
        },
        watch: {
            dataChanged: function (newValue, oldValue) {
                if (newValue != oldValue) {
                    this.loadData();
                }
            }
        },
        methods: {
             ...mapActions({
                async newChange (dispatch, e, item) {
                    e.preventDefault();
                    e.stopPropagation();

                    console.log("@@@ createNewChange @@@", {...item});

                    const splits = _.split(item.id, '_');
                    dispatch('toggleButtonNewChange', {clicked: true, meta: {
                        factory: splits[1] >> 0,
                        unit: splits[3] >> 0,
                        system: splits[5] >> 0
                    }});
                    await setTimeout(() => null, 700);
                    dispatch('toggleButtonNewChange', {clicked: false, meta: null});
                },
            }),
            loadData() {
                axios
                .get(`${baseRoute}/web/change/tree`)
                .then(
                    response => {
                        this.items = _.get(response, 'data.data', []);
                    }
                )
                .catch(
                    error => void(0)
                )
                .then(
                    () => void(0)
                );
            },
            selectNode(node) {
                // console.log("@@@ select node @@@", {...node[0]});
                this.$store.dispatch('selectNode', {...node[0]});
            }
        },
        computed: {
            ...mapGetters([
                'dataChanged',
            ]),
            filter() {
                return this.caseSensitive ?
                    (item, search, textKey) => item[textKey].indexOf(search) > -1 :
                    undefined
            },
        },
    }

</script>

<style lang="scss" scoped>
.tree-container {
    max-height: calc(100vh - 208px);
    // max-height: 787px;
    overflow-y: auto;
}
</style>
