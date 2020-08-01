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
        <v-card-text>
            <v-treeview :items="items" :search="search" :filter="filter" :open.sync="open">
                <template v-slot:prepend="{ item }">
                    <v-icon v-if="item.children"
                        v-text="`mdi-${item.level === 1 ? 'home-variant' : item.level === 2 ? 'folder-network' : item.level === 3 ? 'clipboard-list-outline' : ''}`">
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
            items: [{
                id: 1,
                name: 'Nhà máy',
                level: 0,
                children: [{
                        id: 2,
                        name: 'Nhà máy #1',
                        level: 1,
                        children: [{
                                id: 201,
                                name: 'Phân xưởng #1',
                                level: 2,
                                children: [{
                                        id: 2011,
                                        name: 'Change #1: Change số 1 ABC XYZ ...',
                                        level: 3,
                                        children: []
                                    },
                                    {
                                        id: 2013,
                                        name: 'Change #3: Thay đổi def ...',
                                        level: 3,
                                        children: []
                                    }
                                ]
                            },
                            {
                                id: 202,
                                name: 'Phân xưởng #2',
                                level: 2,
                                children: [{
                                    id: 2021,
                                    name: 'Change #2: Nâng cấp ...',
                                    level: 3,
                                    children: []
                                }]
                            },
                            {
                                id: 203,
                                name: 'Phân xưởng #3',
                                level: 2,
                                children: []
                            },
                            {
                                id: 204,
                                name: 'Phân xưởng #4',
                                level: 2,
                                children: []
                            },
                            {
                                id: 205,
                                name: 'Phân xưởng #5',
                                level: 2,
                                children: []
                            },
                        ],
                    },
                    {
                        id: 3,
                        name: 'Nhà máy #2',
                        level: 1,
                        children: [{
                                id: 301,
                                name: 'Phân xưởng #6',
                                level: 2,
                                children: []
                            },
                            {
                                id: 302,
                                name: 'Phân xưởng #7',
                                level: 2,
                                children: []
                            },
                        ],
                    },
                    {
                        id: 4,
                        name: 'Nhà máy #3',
                        level: 1,
                        children: [{
                                id: 401,
                                name: 'Phân xưởng #8',
                                level: 2,
                                children: []
                            },
                            {
                                id: 402,
                                name: 'Phân xưởng #9',
                                level: 2,
                                children: []
                            },
                            {
                                id: 403,
                                name: 'Phân xưởng #10',
                                level: 2,
                                children: []
                            },
                        ],
                    },
                ],
            }, ],
            open: [1, 2],
            search: null,
            caseSensitive: false,
        }),
        computed: {
            filter() {
                return this.caseSensitive ?
                    (item, search, textKey) => item[textKey].indexOf(search) > -1 :
                    undefined
            },
        },
    }

</script>
