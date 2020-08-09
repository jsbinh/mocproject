<template>
    <v-card>
        <v-sheet class="pa-4 primary lighten-2">
            <v-text-field v-model="search" label="Search Platform / Unit / Change" dark flat solo-inverted hide-details
                clearable clear-icon="mdi-close-circle-outline"></v-text-field>
            <!-- <v-checkbox
        v-model="caseSensitive"
        dark
        hide-details
        label="Case sensitive search"
      ></v-checkbox> -->
        </v-sheet>
        <v-card-text v-if="items">
            <v-treeview :items="items" :search="search" :filter="filter" open-all="true">
                <template v-slot:prepend="{ item }">
                    <v-icon v-if="item.children"
                        v-text="`mdi-${item.level === 0 ? 'factory' : item.level === 1 ? 'view-stream' : item.level === 2 ? 'view-stream' : 'clipboard-list-outline'}`">
                    </v-icon>
                </template>
            </v-treeview>
        </v-card-text>
    </v-card>
</template>

<script>
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
        computed: {
            filter() {
                return this.caseSensitive ?
                    (item, search, textKey) => item[textKey].indexOf(search) > -1 :
                    undefined
            },
        },
    }

</script>
