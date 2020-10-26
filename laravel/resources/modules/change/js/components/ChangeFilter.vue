<template>
    <div>
            <v-tabs light @change="onChangeTask">
                <v-tab>My Task</v-tab>
                <v-tab>All Task</v-tab>
            </v-tabs>

        <v-card v-if="activeTab === 0">
            <v-card-text v-if="tasks" class="tree-container">
                <v-treeview
                    return-object
                    :items="tasks"
                    :filter="filter"
                    :open-all="true"
                    rounded
                    hoverable
                    activatable
                    @update:active="selectNodeTask"
                >
                    <template v-slot:prepend="{ task }">
                        <v-icon v-text="'mdi-checkbox-blank-circle'" :color="colors[task.color]">
                        </v-icon>

                    </template>
                </v-treeview>
            </v-card-text>
        </v-card>

        <v-card v-if="activeTab === 1">
            <v-sheet class="pa-4 dark lighten-2">
                <v-text-field v-model="search"
                              label="Search Factory / Unit / System / Change"
                              dark flat solo-inverted hide-details
                              clearable clear-icon="mdi-close-circle-outline"></v-text-field>
                 <!--<v-checkbox
                v-model="caseSensitive"
                dark
                hide-details
                label="Case sensitive search"
            ></v-checkbox> &ndash;&gt;-->
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
                        <v-icon v-text="`mdi-${item.level === 0 ? 'factory' : item.level === 1 ? 'view-stream' : 'view-stream'}`" v-if="item.level < 3">
                        </v-icon>
                        <v-icon v-text="'mdi-checkbox-blank-circle'" v-if="item.level == 3" :color="colors[Math.floor(Math.random() * colors.length)]">
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

    </div>

</template>

<script>
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "ChangeFilter",
        props: ['onAdd'],
        data: () => ({
            items: undefined,
            // open: [1, 2],
            search: null,
            caseSensitive: false,
            colors: ['green', 'red', 'grey', 'orange'],
            activeTab: 0,
            tasks: undefined
        }),
        mounted() {
            this.loadMyTask();
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
                    this.onAdd();
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
            loadMyTask() {
                axios
                    .get(`${baseRoute}/web/my-task`)
                    .then(
                        response => {
                            this.tasks = _.get(response, 'data.data', []);
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
            },
            selectNodeTask(node) {
                console.log("@@@ select node Task @@@", {...node[0]});
                this.$store.dispatch('selectNodeTask', {...node[0]});
            },
            onChangeTask(index) {
                this.activeTab = index;
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
