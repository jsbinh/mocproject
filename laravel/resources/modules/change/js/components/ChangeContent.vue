<template>
    <v-card>
        <v-card-text>
            <form>
                <v-row class="mb-n6">
                    <v-col>
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
                    <v-col>
                        <v-text-field
                            v-model="title"
                            :error-messages="titleErrors"
                            :counter="255"
                            label="Title"
                            required
                            @input="$v.title.$touch()"
                            @blur="$v.title.$touch()"
                            outlined>
                        </v-text-field>
                    </v-col>
                </v-row>

                <v-row class="mb-n6">
                    <v-col>
                        <v-textarea
                            v-model="description"
                            label="Description"
                            @input="$v.description.$touch()"
                            @blur="$v.description.$touch()"
                            outlined>
                        </v-textarea>
                    </v-col>
                </v-row>

                <v-row class="mb-n6">
                    <v-col>
                        <v-text-field
                            v-model="creator"
                            label="Creator"
                            @input="$v.creator.$touch()"
                            @blur="$v.creator.$touch()"
                            outlined
                            disabled>
                        </v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field
                            v-model="created_at"
                            label="Created At"
                            @input="$v.created_at.$touch()"
                            @blur="$v.created_at.$touch()"
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
                            @input="$v.assigned_to.$touch()"
                            @blur="$v.assigned_to.$touch()"
                            outlined
                            disabled>
                        </v-text-field>
                    </v-col>
                </v-row>

                <v-btn class="mr-4" @click="submit">submit</v-btn>
                <v-btn @click="clear">clear</v-btn>
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
            }
        },

        data: () => ({
            id: null,
            title: '',
            description: null,
        }),

        computed: {
            titleErrors() {
                const errors = [];
                if (!this.$v.title.$dirty) return errors;
                !this.$v.title.required && errors.push('Title is required.');
                return errors;
            },
        },

        methods: {
            submit() {
                this.$v.$touch();
            },
            clear() {
                this.$v.$reset();
                this.title = '';
                this.description = '';
            },
        },
    }

</script>
