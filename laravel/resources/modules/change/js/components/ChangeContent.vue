<template>
    <v-card>
        <v-card-text>
            <v-tabs light @change="onChangeTab">
                <v-tab>General</v-tab>
                <v-tab>Attachments</v-tab>
                <v-tab>History</v-tab>
            </v-tabs>

            <form v-if="activeTab === 0">
                <v-row class="mb-n6">
                    <v-col cols="6">
                        <v-text-field
                            v-model="id"
                            label="Change ID"
                            outlined
                            disabled
                        >
                        </v-text-field>
                    </v-col>
                </v-row>

                <v-row class="mb-n6">
                    <v-col cols="4">
                        <v-select
                            v-model="factory"
                            item-text="name"
                            item-value="id"
                            :items="factoryItems"
                            :error-messages="factoryErrors"
                            label="Factory"
                            required
                            outlined
                            @change="$v.factory && $v.factory.$touch()"
                            @blur="$v.factory && $v.factory.$touch()"
                        ></v-select>
                    </v-col>
                    <v-col cols="4">
                        <v-select
                            v-model="unit"
                            item-text="name"
                            item-value="id"
                            :items="unitItems"
                            :error-messages="unitErrors"
                            label="Unit"
                            required
                            outlined
                            @change="$v.unit && $v.unit.$touch()"
                            @blur="$v.unit && $v.unit.$touch()"
                        ></v-select>
                    </v-col>
                    <v-col cols="4">
                        <v-select
                            v-model="system"
                            item-text="name"
                            item-value="id"
                            :items="systemItems"
                            :error-messages="systemErrors"
                            label="System"
                            required
                            outlined
                            @change="$v.system && $v.system.$touch()"
                            @blur="$v.system && $v.system.$touch()"
                        ></v-select>
                    </v-col>
                </v-row>

                <v-row class="mb-n6">
                    <v-col>
                        <v-text-field
                            v-model="title"
                            :error-messages="titleErrors"
                            :counter="255"
                            label="Title"
                            required
                            @input="$v.title && $v.title.$touch()"
                            @blur="$v.title && $v.title.$touch()"
                            outlined>
                        </v-text-field>
                    </v-col>
                </v-row>

                <v-row class="mb-n6">
                    <v-col>
                        <v-textarea
                            v-model="description"
                            label="Description"
                            @input="$v.description && $v.description.$touch()"
                            @blur="$v.description && $v.description.$touch()"
                            outlined>
                        </v-textarea>
                    </v-col>
                </v-row>

                <v-row class="mb-n6">
                    <v-col>
                        <v-text-field
                            v-model="creator"
                            label="Creator"
                            @input="$v.creator && $v.creator.$touch()"
                            @blur="$v.creator && $v.creator.$touch()"
                            outlined
                            disabled>
                        </v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field
                            v-model="created_at"
                            label="Created At"
                            @input="$v.created_at && $v.created_at.$touch()"
                            @blur="$v.created_at && $v.created_at.$touch()"
                            outlined
                            disabled>
                        </v-text-field>
                    </v-col>
                </v-row>

                <v-row>
                    <v-col cols="6">
                        <v-text-field
                            v-model="assigned_to"
                            label="Assigned To"
                            @input="$v.assigned_to && $v.assigned_to.$touch()"
                            @blur="$v.assigned_to && $v.assigned_to.$touch()"
                            outlined
                            disabled>
                        </v-text-field>
                    </v-col>
                </v-row>

                <v-btn class="mr-4" @click="submit">submit</v-btn>
                <v-btn @click="clear">clear</v-btn>
            </form>

            <form v-if="activeTab === 1">
                <v-row class="mb-n6">
                    <v-col>
                        <v-file-input
                            v-model="files"
                            counter
                            label="File input"
                            multiple
                            placeholder="Select your files"
                            prepend-icon="mdi-paperclip"
                            outlined
                            :show-size="1000"
                        >
                            <template v-slot:selection="{ index, text }">
                                <v-chip
                                    v-if="index < 2"
                                    dark
                                    label
                                    small
                                >
                                    {{ text }}
                                </v-chip>

                                <span
                                    v-else-if="index === 2"
                                    class="overline grey--text text--darken-3 mx-2"
                                >
                                    +{{ files.length - 2 }} File(s)
                                </span>
                            </template>
                        </v-file-input>
                    </v-col>
                </v-row>
            </form>
        </v-card-text>
    </v-card>
</template>

<script>
    import {
        validationMixin
    } from 'vuelidate';
    import {
        required,
        maxLength,
        email
    } from 'vuelidate/lib/validators';

    export default {
        mixins: [validationMixin],

        validations: {
            title: {
                required,
                maxLength: maxLength(255)
            },
            factory: {
                required
            },
            unit: {
                required
            },
            system: {
                required
            }
        },

        // props: {
        //     "template": {
        //         type: Boolean,
        //         default: false
        //     }
        // },

        data: () => ({
            activeTab: 0,
            id: null,
            factory: null,
            unit: null,
            system: null,
            title: '',
            description: null,
            creator: null,
            created_at: null,
            assigned_to: null,
            files: [],

            factoryItems: [
                { id: 0, name: "Factory #1" },
                { id: 1, name: "Factory #2" },
            ],
            unitItems: [
                { id: 0, name: "Unit #1" },
                { id: 1, name: "Unit #2" },
            ],
            systemItems: [
                { id: 0, name: "System #1" },
                { id: 1, name: "System #2" },
            ]
        }),

        computed: {
            titleErrors() {
                const errors = [];
                if (!this.$v.title.$dirty) return errors;
                !this.$v.title.required && errors.push('Title is required.');
                return errors;
            },
            factoryErrors() {
                const errors = [];
                if (!this.$v.factory.$dirty) return errors;
                !this.$v.factory.required && errors.push('Factory is required.');
                return errors;
            },
            unitErrors() {
                const errors = [];
                if (!this.$v.unit.$dirty) return errors;
                !this.$v.unit.required && errors.push('Unit is required.');
                return errors;
            },
            systemErrors() {
                const errors = [];
                if (!this.$v.system.$dirty) return errors;
                !this.$v.system.required && errors.push('System is required.');
                return errors;
            }
        },

        methods: {
            submit() {
                this.$v.$touch();

                if (this.$v.$error) alert("Error!");
            },
            clear() {
                this.$v.$reset();
                this.title = '';
                this.description = '';
            },
            onChangeTab(index) {
                this.activeTab = index;
            }
        },
    }

</script>
