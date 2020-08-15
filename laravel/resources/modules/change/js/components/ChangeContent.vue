<template>
    <v-card>
        <v-card-text v-if="context == 'change'">
            <v-tabs light @change="onChangeTab">
                <v-tab>General</v-tab>
                <v-tab>Notes & Comments</v-tab>
                <v-tab>Attachments</v-tab>
                <!-- <v-tab>History</v-tab> -->
            </v-tabs>

            <form v-if="activeTab === 0" onsubmit="return false">
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
                        <v-label>Status</v-label>
                        <v-stepper alt-labels style="box-shadow:none;" value="2">
                            <v-stepper-header>
                                <v-stepper-step step="1" complete>Open</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="2">Screening</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="3">Design</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="4">Review</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="5">Implementation</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="6">Approval</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="7">Documents</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="8">Closed/Cancelled</v-stepper-step>
                            </v-stepper-header>
                        </v-stepper>
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
                        <v-textarea
                            v-model="justification"
                            :error-messages="justificationErrors"
                            label="Justification"
                            required
                            @input="$v.justification && $v.justification.$touch()"
                            @blur="$v.justification && $v.justification.$touch()"
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

                <v-row class="mb-n6">
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

                <v-row>
                    <v-col cols="4">
                        <v-btn class="mr-1" @click="submit">{{id ? "update" : "create"}}</v-btn>
                        <v-btn @click="clear">clear</v-btn>
                    </v-col>
                    <v-col cols="8" class="text-sm-right">
                        <v-btn class="mr-1 primary" @click="submit">Screening approved</v-btn>
                        <v-btn class="error" @click="clear">Screening not approved</v-btn>
                    </v-col>
                </v-row>
            </form>

            <form v-if="activeTab === 1" onsubmit="return false">
                <v-timeline dense clipped>
                    <v-timeline-item
                        fill-dot
                        class="white--text mb-12"
                        color="blue"
                        large
                    >
                        <template v-slot:icon>
                            <v-icon center color="white">mdi-message-bulleted</v-icon>
                        </template>
                        <v-textarea
                            v-model="input"
                            label="Leave a comment..."
                            solo
                        >
                            <template v-slot:append>
                                <v-btn
                                    class="mx-0"
                                    depressed
                                    @click="comment"
                                >
                                    Post
                                </v-btn>
                            </template>
                        </v-textarea>
                    </v-timeline-item>

                    <v-slide-x-transition
                        group
                    >
                        <v-timeline-item
                            v-for="event in timeline"
                            :key="event.id"
                            class="mb-4"
                            color="blue"
                            small
                            >
                            <v-row justify="space-between">
                                <v-col cols="12">
                                    <strong>tuankiet1708@gmail.com</strong>
                                    &nbsp;
                                    <span>{{event.time}}</span>
                                    <br/>
                                    <v-textarea
                                        v-model="event.text"
                                        readonly
                                        no-resize
                                        filled
                                        shaped
                                    />
                                </v-col>
                                <!-- <v-col class="text-right" cols="3" v-text="event.time"></v-col> -->
                            </v-row>
                        </v-timeline-item>
                    </v-slide-x-transition>

                    <v-timeline-item
                        color="grey"
                        small
                    >
                        <v-row justify="space-between">
                            <v-col cols="9">
                                <strong>tuankiet1708@gmail.com</strong>
                                <br/>
                                Something to do ...
                            </v-col>
                            <v-col class="text-right" cols="3">
                                {{now}}
                            </v-col>
                        </v-row>
                    </v-timeline-item>
                </v-timeline>
            </form>

            <form v-if="activeTab === 2" onsubmit="return false">
                <v-row>
                    <v-col>
                        <v-file-input
                            v-model="fileItems"
                            counter
                            label="File input"
                            multiple
                            placeholder="Select your files"
                            prepend-icon="mdi-paperclip"
                            outlined
                            :show-size="1000">
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
                                    +{{ fileItems.length - 2 }} File(s)
                                </span>
                            </template>
                        </v-file-input>
                    </v-col>
                </v-row>

                <v-row>
                    <v-list-item
                        v-for="item in files"
                        :key="item.id"
                        @click=""
                    >
                        <v-list-item-avatar>
                            <v-icon class="blue white--text">mdi-file</v-icon>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title v-text="item.name"></v-list-item-title>
                            <v-list-item-subtitle>
                                {{ moment(item.created_at).format("MM-DD-YYYY HH:mm:ss") }}
                            </v-list-item-subtitle>
                        </v-list-item-content>

                        <v-list-item-action>
                            <v-btn icon @click="e => download(e, item.id)">
                                <v-icon color="info">mdi-download</v-icon>
                            </v-btn>
                        </v-list-item-action>

                        <v-list-item-action>
                            <v-btn icon @click="e => deleteFile(e, item.id)">
                                <v-icon color="error">mdi-minus-circle-outline</v-icon>
                            </v-btn>
                        </v-list-item-action>
                    </v-list-item>
                </v-row>
            </form>
        </v-card-text>

        <v-card-text v-if="context == 'report'">
            <v-breadcrumbs :items="items4">
                <template v-slot:item="{ item }">
                    <v-breadcrumbs-item>
                        <strong>{{ item.text.toUpperCase() }}</strong>
                    </v-breadcrumbs-item>
                </template>
            </v-breadcrumbs>

            <v-row>
                <v-col
                    v-for="(item, i) in items3"
                    :key="i"
                    cols="4"
                >
                    <v-card
                        :color="item.color"
                        dark
                    >
                        <div class="d-flex flex-no-wrap justify-space-between">
                            <div>
                                <v-card-title
                                    class="headline"
                                    v-text="item.title"
                                ></v-card-title>

                                <v-card-subtitle>
                                    <h2>{{item.total}}</h2>
                                </v-card-subtitle>
                            </div>

                            <!-- <v-avatar
                                class="ma-3"
                                size="125"
                                tile
                            >
                                <v-img :src="item.src"></v-img>
                            </v-avatar> -->
                        </div>
                    </v-card>
                </v-col>
            </v-row>
            <v-row>
                <v-col class="text-center">
                    <v-btn
                        rounded
                        color="blue-grey"
                        class="ma-2 white--text"
                    >
                        Download Report
                        <v-icon right dark>mdi-cloud-download</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </v-card-text>

        <v-snackbar
            v-model="snackbar"
            :color="hasError ? 'error' : 'success'"
            :timeout="5000"
            :top="true">
            {{ hasError ? "Something went wrong. Please try again." : "Save successfully." }}

            <template v-slot:action="{ attrs }">
                <v-btn
                    dark
                    text
                    v-bind="attrs"
                    @click="snackbar = false"
                >
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </v-card>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex';
    import {
        validationMixin
    } from 'vuelidate';
    import {
        required,
        maxLength,
        email
    } from 'vuelidate/lib/validators';
    import moment from 'moment';

    const defaultData = {
        id: null,
        factory: null,
        unit: null,
        system: null,
        title: '',
        description: '',
        justification: '',
        creator: '',
        created_at: null,
        assigned_to: '',
        files: [],
    };

    export default {
        mixins: [validationMixin],

        validations: {
            title: {
                required,
                maxLength: maxLength(255)
            },
            justification: {
                required
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
            ...defaultData,

            events: [
                {
                    time: "08-13-2020 18:01:29",
                    text: "Something to do ..."
                }
            ],
            input: null,
            nonce: 0,
            snackbar: false,
            hasError: false,

            context: 'change',
            activeTab: 0,
            factoryItems: [],
            unitItems: [],
            systemItems: [],
            fileItems: null,
            moment,

            items3: [
                {
                    color: 'blue',
                    title: 'Open',
                    total: 1,
                },
                {
                    color: 'blue-grey',
                    title: 'Screening',
                    total: 1,
                },
                {
                    color: 'blue-grey',
                    title: 'Design',
                    total: 0,
                },
                {
                    color: 'blue-grey',
                    title: 'Review',
                    total: 0,
                },
                {
                    color: 'blue-grey',
                    title: 'Implementation',
                    total: 0,
                },
                {
                    color: 'blue-grey',
                    title: 'Approval',
                    total: 0,
                },
                {
                    color: 'blue-grey',
                    title: 'Update Documents',
                    total: 0,
                },
                {
                    color: 'success',
                    title: 'Closed Out',
                    total: 1,
                },
                {
                    color: 'error',
                    title: 'Cancelled',
                    total: 0,
                },
            ],
            items4: [
                {
                    text: 'Factory #1',
                    disabled: false,
                    href: 'breadcrumbs_dashboard',
                },
                {
                    text: 'Unit #1',
                    disabled: false,
                    href: 'breadcrumbs_link_1',
                },
                {
                    text: 'System #1',
                    disabled: true,
                    href: 'breadcrumbs_link_2',
                },
            ],
        }),

        mounted() {
            // load select options
            ['factory', 'unit', 'system'].forEach(item => {
                axios
                .get(`${baseRoute}/web/change/select-items/${item}`)
                .then(
                    response => this[`${item}Items`] = _.get(response, 'data.data', [])
                )
                .catch(
                    error => void(0)
                )
                .then(
                    () => void(0) // always executed
                );
            })
        },

        watch: {
            selectedNode: function (newValue, oldValue) {
                if (newValue && newValue != oldValue) {
                    console.log('@@@ node changed @@@', newValue);

                    if (newValue.level === 3) {
                        this.loadData(newValue.id);
                        this.context = 'change';
                    }
                    else if (newValue.level === 2) {
                        this.context = 'report';
                    }
                }
            },
            buttonNewChangeClicked: function (newValue, oldValue) {
                if (newValue.clicked && newValue.clicked != oldValue.clicked) {
                    this.clear();
                    this.activeTab = 0;
                    this.context = "change";
                    this.factory = newValue.meta.factory;
                    this.unit = newValue.meta.unit;
                    this.system = newValue.meta.system;
                }
            },
            fileItems: function(newValue, oldValue) {
                newValue && newValue.forEach(file => {
                    this.upload(file);
                })
            }
        },

        computed: {
            ...mapGetters([
                'foo',
                'selectedNode',
                'buttonNewChangeClicked'
            ]),
            timeline() {
                return this.events.slice().reverse()
            },
            now() {
                return moment().format("MM-DD-YYYY HH:mm:ss");
            },

            titleErrors() {
                const errors = [];
                if (!this.$v.title.$dirty) return errors;
                !this.$v.title.required && errors.push('Title is required.');
                return errors;
            },
            justificationErrors() {
                const errors = [];
                if (!this.$v.justification.$dirty) return errors;
                !this.$v.justification.required && errors.push('Justification is required.');
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
            ...mapActions({
                'changeData': 'changeData'
            }),
            comment () {
                const time = (new Date()).toTimeString()
                this.events.push({
                    id: this.nonce++,
                    text: this.input,
                    time: moment().format("MM-DD-YYYY HH:mm:ss"),
                })

                this.input = null
            },

            loadData(id) {
                this.clear();
                axios
                .get(`${baseRoute}/web/change/${id}`)
                .then(
                    response => {
                        //
                        const change = response.data.data;
                        _.keys(defaultData).map(key => {
                            this[key] = _.get(change, key);
                        });

                        this.created_at = moment(this.created_at).format("MM-DD-YYYY HH:mm:ss");
                        this.creator = defaultData.creator;
                        this.assigned_to = defaultData.assigned_to;
                    }
                )
                .catch(
                    error => void(0)
                )
                .then(
                    () => void(0)
                );
            },
            submit() {
                this.$v.$touch();

                if (this.$v.$error) return alert("Error! Please check the form.");

                const data = _.pick(this, _.keys(defaultData));

                console.info("@@@ submit @@@", data);

                axios
                .post(`${baseRoute}/web/change`, data)
                .then(
                    response => {
                        //
                        this.id = response.data.id;
                        this.snackbar = true;
                        this.hasError = false;
                    }
                )
                .catch(
                    error => {
                        this.snackbar = true;
                        this.hasError = true;
                    }
                )
                .then(
                    () => this.changeData()
                );
            },
            upload(file) {
                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                }
                let formData = new FormData();
                formData.append('file', file);
                formData.append('meta', JSON.stringify({
                    id: this.id
                }))

                axios
                .post(`${baseRoute}/web/attachment`,  formData, config)
                .then(
                    response => {
                        //
                        this.files.push(response.data.data);
                    }
                )
                .catch(
                    error => {

                    }
                )
                .then(
                    () => void(0)
                );
            },
            download(e, fileId) {
                window.open(`${baseRoute}/web/attachment/${fileId}`, "_blank");
            },
            deleteFile(e, fileId) {
                axios
                .delete(`${baseRoute}/web/attachment/${fileId}`)
                .then(
                    response => {
                        //
                        this.files = _.filter(this.files, o => fileId !== o.id);
                    }
                )
                .catch(
                    error => {

                    }
                )
                .then(
                    () => void(0)
                );
            },
            clear() {
                this.$v.$reset();

                const clonedDefault = {...defaultData};
                _.keys(clonedDefault).map(key => {
                    this[key] = _.get(clonedDefault, key);
                });
            },
            onChangeTab(index) {
                this.activeTab = index;
            }
        },
    }

</script>

<style lang="scss">
    .v-stepper__label {font-size: 10px !important;}
</style>
