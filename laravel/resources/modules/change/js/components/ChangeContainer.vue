<template>
    <v-app id="app-change">
        <v-row align="start" justify="space-between">
            <v-col cols="12" md="5" sm="12">
                <ChangeFilter/>
            </v-col>
            <v-col cols="12" md="7" sm="12">
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
    }
}
</script>

<style lang="scss" scoped>

</style>
