<template>
    <v-app id="app-change">
        <v-btn
            class="mx-2 btn-toggle-filter"
            fab
            dark
            small
            color="primary"
            @click="toggle"
        >
            <v-icon dark>
                mdi-file-tree-outline
            </v-icon>
        </v-btn>
        <v-row align="start" justify="space-between">
            <v-col cols="12" md="3" sm="12" v-if="!filterHidden">
                <ChangeFilter :onAdd="closeFilter" />
            </v-col>
            <v-col cols="12" :md="filterHidden ? 12 : 9" sm="12">
                <ChangeContent/>
            </v-col>
        </v-row>
    </v-app>
</template>

<script>
import ChangeContent from './ChangeContent';
import ChangeFilter from './ChangeFilter';

export default {
    components: {
        ChangeContent,
        ChangeFilter
    },
    data: () => ({
        filterHidden: false,
    }),
    methods: {
        toggle() {
            this.filterHidden = ! this.filterHidden;
        },
        closeFilter() {
            this.filterHidden = true;
        }
    }
}
</script>

<style lang="scss" scoped>
    #app-change {
        background: transparent !important;

        .btn-toggle-filter {
            position: absolute;
            top: -45px;
            left: 120px;
            z-index: 1;
        }
    }
</style>
