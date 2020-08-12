<template>
    <v-card>
        <v-sheet class="pa-4 primary lighten-2">
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
        <v-card-text v-if="items">
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
        methods: {
             ...mapActions({
                async newChange (dispatch, e, item) {
                    e.preventDefault();
                    e.stopPropagation();

                    console.log("@@@ createNewChange @@@", {...item});
                    dispatch('toggleButtonNewChange', true);
                    await setTimeout(() => null, 700);
                    dispatch('toggleButtonNewChange', false);
                },
            }),
            selectNode(node) {
                // console.log("@@@ select node @@@", {...node[0]});
                this.$store.dispatch('selectNode', {...node[0]});
            }
        },
        computed: {
            filter() {
                return this.caseSensitive ?
                    (item, search, textKey) => item[textKey].indexOf(search) > -1 :
                    undefined
            },
        },
    }

</script>
