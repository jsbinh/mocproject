<template>
    <v-card>
        <v-card-text v-if="context == 'change'">
            <v-tabs light @change="onChangeTab">
                <v-tab>{{status}}</v-tab>
                <v-tab>History</v-tab>
                <v-tab>Attachment List</v-tab>
                <!-- <v-tab>History</v-tab> -->
            </v-tabs>

            <form v-if="activeTab === 0" onsubmit="return false">
                <v-row class="mb-n6">
                    <v-col>
                        <v-label>Status <strong class="text-primary">{{status}}</strong></v-label>
                        <v-stepper alt-labels style="box-shadow:none;" :value="statusValue">
                            <v-stepper-header>
                                <v-stepper-step step="1" :complete="statusValue >= 0">Initiate</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="2" :complete="statusValue >= 2">Screening</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="3" :complete="statusValue >= 3">Design</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="4" :complete="statusValue >= 4">Design Review/Approve</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="5" :complete="statusValue >= 5">Implement</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="6" :complete="statusValue >= 6">Implement Review/Approve</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="7" :complete="statusValue >= 7">Closeout</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="8" :complete="statusValue >= 8">Closeout Review/Approve</v-stepper-step>
                                <v-divider></v-divider>
                                <v-stepper-step step="9" :complete="statusValue >= 9">Closed/Cancelled</v-stepper-step>
                            </v-stepper-header>
                        </v-stepper>
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
                            @change="generateChangeId()"
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
                            @blur="$v.unit && $v.unit.$touch()"
                            @change="generateChangeId()"
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

                            @change="generateChangeId()"
                            @blur="$v.system && $v.system.$touch()"
                        ></v-select>
                    </v-col>
                </v-row>

                <input type="hidden" id="id" name="id" :value="id">

                <v-row class="mb-n6">
                    <v-col cols="6">
                        <v-text-field
                            v-model="change_id"
                            label="Change ID"
                            @input="$v.change_id && $v.change_id.$touch()"
                            @blur="$v.change_id && $v.change_id.$touch()"
                            disabled
                            outlined>
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
                            v-model="created_by"
                            label="Initiator"
                            @input="$v.created_by && $v.created_by.$touch()"
                            @blur="$v.created_by && $v.created_by.$touch()"
                            outlined
                            disabled>
                        </v-text-field>
                    </v-col>
                    <v-col>
                        <v-text-field
                            v-model="created_at"
                            label="Initiator At"
                            @input="$v.created_at && $v.created_at.$touch()"
                            @blur="$v.created_at && $v.created_at.$touch()"
                            outlined
                            disabled>
                        </v-text-field>
                    </v-col>
                </v-row>

                <v-row class="mb-n6">
                    <v-col cols="6" v-if="status!='Screening' || status!='Design Review/Approve' || status!='Implement Review/Approve' || status!='Closeout Review/Approve'">
                        <v-text-field
                            v-model="assigned_to"
                            label="Assignment"
                            @input="$v.assigned_to && $v.assigned_to.$touch()"
                            @blur="$v.assigned_to && $v.assigned_to.$touch()"
                            outlined
                            disabled>
                        </v-text-field>
                    </v-col>
                </v-row>

                <v-row class="mb-n8" v-if="status!='' || status!=null">
                    <v-col cols="12">
                        <v-textarea
                            v-model="commentText"
                            label="Leave a comment..."
                            solo
                        >
                        </v-textarea>
                    </v-col>
                </v-row>

                <v-row class="mb-n8" v-if="status=='Screening'">
                    <v-col cols="4">
                        <v-select
                            v-model="color"
                            item-text="text"
                            item-value="value"
                            :items="priorityLevels"
                            label="Priority Level"
                            required
                            outlined
                            @change=""
                        ></v-select>
                    </v-col>

                    <v-col cols="4">
                        <v-select
                            v-model="statusNext"
                            item-text="text"
                            item-value="value"
                            :items="statusListScreen"
                            label="Next Assignment"
                            required
                            outlined
                            @change=""
                        ></v-select>
                    </v-col>
                </v-row>

                <v-row class="mb-md-n12" v-if="status=='Design Review/Approve'">
                    <v-col cols="4">
                        <v-select
                            v-model="statusNext"
                            item-text="text"
                            item-value="value"
                            :items="statusListDesignApprove"
                            label="Next Assignment"
                            required
                            outlined
                            @change=""
                        ></v-select>
                    </v-col>
                </v-row>

                <v-row class="mb-n8" v-if="status=='Implement Review/Approve'">
                    <v-col cols="4">
                        <v-select
                            v-model="statusNext"
                            item-text="text"
                            item-value="value"
                            :items="statusListImplementApprove"
                            label="Next Assignment"
                            required
                            outlined
                            @change=""
                        ></v-select>
                    </v-col>
                </v-row>

                <v-row class="mb-n8" v-if="status=='Closeout Review/Approve'">
                    <v-col cols="4">
                        <v-select
                            v-model="statusNext"
                            item-text="text"
                            item-value="value"
                            :items="statusListCloseoutApprove"
                            label="Next Assignment"
                            required
                            outlined
                            @change=""
                        ></v-select>
                    </v-col>
                </v-row>


                <v-row>
                    <v-col cols="4">
                        <v-btn v-if="status==''" class="mr-1" @click="submit">{{id ? "update" : "create"}}</v-btn>
                        <v-btn v-if="status==''" @click="clear">clear</v-btn>
                    </v-col>
                    <v-col cols="8" class="text-sm-right" v-if="status != 'Closed' || status != 'Cancelled' || status != null">
                        <v-btn class="primary" @click="e => submit(e, 2, 1)" v-if="id != null">Submit</v-btn>
                        <!-- <v-btn class="mr-1 primary" @click="submit">Screening approved</v-btn>
                        <v-btn class="error" @click="clear">Screening not approved</v-btn> -->

                        <v-btn class="mr-1 primary" v-for="(item, index) in allowedStatuses"
                            :key="index"
                            @click="e => submit(e, item)">
                            {{item}}
                        </v-btn>
                    </v-col>
                </v-row>
            </form>


            <form v-if="activeTab === 1" onsubmit="return false">
                <v-timeline dense clipped>
                    <v-timeline-item
                        fill-dot
                        class="white--text"
                        color="blue"
                        large
                    >
                        <template v-slot:icon>
                            <v-icon center color="white">mdi-message-bulleted</v-icon>
                        </template>
                        <v-textarea
                            v-model="inputComment"
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

                    <v-slide-x-transition group>
                        <v-timeline-item
                            v-for="item in timelineComments"
                            :key="item.id"
                            color="blue"
                            small>
                            <v-row justify="space-between">
                                <v-col cols="12">
                                    <span>
                                        <v-icon>mdi-account</v-icon>
                                        {{ lodash.get(item, 'user.email') }}
                                    </span>
                                    &nbsp;
                                    <span class="float-right">
                                        <v-icon>mdi-calendar</v-icon>
                                        {{ moment(item.created_at).format("MM-DD-YYYY HH:mm:ss") }}
                                    </span>
                                    <br/>
                                    <v-textarea
                                        v-model="item.content"
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
                        @click="() => null"
                    >
                        <v-list-item-avatar>
                            <v-icon class="blue white--text">mdi-file</v-icon>
                        </v-list-item-avatar>

                        <v-list-item-content>
                            <v-list-item-title v-text="item.name"></v-list-item-title>
                            <v-list-item-subtitle class="mt-2">
                                <v-icon>mdi-calendar</v-icon>
                                {{ moment(item.created_at).format("MM-DD-YYYY HH:mm:ss") }}
                                <v-icon class="ml-2">mdi-account</v-icon>
                                {{ lodash.get(item, 'user.email') }}
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
            <v-breadcrumbs :items="reportChartNavigation">
                <template v-slot:item="{ item }">
                    <v-breadcrumbs-item>
                        <strong>{{ item.text.toUpperCase() }}</strong>
                    </v-breadcrumbs-item>
                </template>
            </v-breadcrumbs>

            <v-row v-if="reportChart.length">
                <v-col class="text-center">
                    <v-btn
                        rounded
                        color="blue-grey"
                        class="ma-2 white--text"
                        :href="reportLink"
                    >
                        View List
                        <!-- <v-icon right dark>mdi-cloud-download</v-icon> -->
                        <v-icon right dark>mdi-format-list-text</v-icon>
                    </v-btn>
                </v-col>
            </v-row>
            <v-row>
                <v-col
                    v-for="(item, i) in reportChart"
                    :key="i"
                    cols="6"
                >
                    <v-card
                        :color="item.color"
                        dark
                    >
                        <div class="d-flex flex-no-wrap justify-space-between">
                            <div>
                                <v-card-title v-text="item.title" style="font-size:16px;"
                                ></v-card-title>

                                <v-card-subtitle>
                                    <h2>{{item.total}}</h2>
                                </v-card-subtitle>
                            </div>
                            <div>
                                <v-btn
                                    rounded
                                    color="blue-grey"
                                    class="ma-2 white--text"
                                    :href="viewDetailReport(item)"
                                >
                                    View Details
                                    <!-- <v-icon right dark>mdi-cloud-download</v-icon> -->
                                    <!--<v-icon right dark>mdi-format-list-text</v-icon>-->
                                </v-btn>
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

    const defaultData = {
        id: null,
        change_id: null,
        status: '',
        factory: null,
        unit: null,
        system: null,
        title: '',
        description: '',
        justification: '',
        created_by: '',
        created_at: null,
        color: '',
        assigned_to: '',
        flow: '',
        flowJson: {},
        files: [],
        comments: [],
        statusNext: '',
        commentText: '',
        inputComment: ''
    };

    var month = new Date();
    var currentMonth = month.getMonth();
    var currentYear =  (new Date()).getFullYear();
    var twoLastDigits = currentYear%100;
    var formatedTwoLastDigits = "";

    if (twoLastDigits <10 ) {
        formatedTwoLastDigits = "0" + twoLastDigits;
    } else {
        formatedTwoLastDigits = "" + twoLastDigits;
    }

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
            },
            change_id: {
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

            nonce: 0,
            snackbar: false,
            hasError: false,

            context: 'change',
            activeTab: 0,
            factoryItems: [],
            unitItems: [],
            systemItems: [],
            fileItems: null,
            moment: window.moment,
            lodash: window._,

            reportChart: [],
            reportChartNavigation: [],
            reportLink: '',
            priorityLevels: [
                { text: 'High', value: 'red' },
                { text: 'Medium', value: 'orange' },
                { text: 'Low', value: 'green' }
            ],

            statusListScreen: [
                { text: 'Screening Approve', value: '3' },
                { text: 'Revisit Change', value: '1' },
                { text: 'Reject Change', value: '9' }
            ],
            statusListDesignApprove: [
                { text: 'Design Approve, go to Implement', value: 5 },
                { text: 'Revisit, return to Design', value: 3 },
            ],
            statusListImplementApprove: [
                { text: 'Implement Approve, go to Closeout', value: 7 },
                { text: 'Implement not Approve, return to Implement', value: 5 },
            ],
            statusListCloseoutApprove: [
                { text: 'Closeout Approve, Change Closed', value: 9 },
                { text: 'Closeout not Approve, return to Closeout', value: 7 },
            ]
        }),

        mounted() {
            // load select options
            ['factory', 'unit', 'system'].forEach(item => {
                console.log(item);
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

            let id = utils.findGetParameter('id');
            if (id) {
                this.loadData(id);
            }
        },

        watch: {
            selectedNodeTask: function (newValue, oldValue) {
                if (newValue && newValue != oldValue) {
                    console.log('@@@ node task changed @@@', newValue);
                    this.id = newValue.id;
                    this.loadData(newValue.id);
                    this.context = 'change';
                    /*else {
                        this.reportChart = [];
                        this.reportChartNavigation = [];
                        const splits = _.split(newValue.id, '_');
                        const meta = {
                            factory: splits[1] >> 0,
                            unit: splits[3] >> 0,
                            system: splits[5] >> 0
                        };
                        let linkTags = [`factory=${meta.factory}`];
                        if (meta.unit) linkTags.push(`unit=${meta.unit}`);
                        if (meta.system) linkTags.push(`system=${meta.system}`);
                        this.reportLink = `${baseRoute}/change?${linkTags.join('&')}`;
                        // console.log('@@@ linkTags @@@', linkTags, this.reportLink);
                        this.loadReport(meta);
                        this.context = 'report';
                    }*/
                }
            },
            selectedNode: function (newValue, oldValue) {
                if (newValue && newValue != oldValue) {
                    console.log('@@@ node changed @@@', newValue);

                    if (newValue.level === 3) {
                        this.loadData(newValue.id);
                        this.context = 'change';
                    }
                    else {
                        this.reportChart = [];
                        this.reportChartNavigation = [];
                        const splits = _.split(newValue.id, '_');
                        const meta = {
                            factory: splits[1] >> 0,
                            unit: splits[3] >> 0,
                            system: splits[5] >> 0
                        };
                        let linkTags = [`factory=${meta.factory}`];
                        if (meta.unit) linkTags.push(`unit=${meta.unit}`);
                        if (meta.system) linkTags.push(`system=${meta.system}`);
                        this.reportLink = `${baseRoute}/change?${linkTags.join('&')}`;
                        // console.log('@@@ linkTags @@@', linkTags, this.reportLink);
                        this.loadReport(meta);
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
                'selectedNodeTask',
                'buttonNewChangeClicked'
            ]),
            timelineComments() {
                return this.comments.slice().reverse()
            },
            allowedStatuses() {
                let list = _.get(this.flowJson, 'allowed_statuses', '');
                return _.filter(_.split(list, ','));
            },
            statusValue() {
                switch (this.status) {
                    /*case "Draft":
                        return 0;*/

                    case "Initial":
                        return 1;

                    case "Screening":
                        return 2;

                    case "Design":
                        return 3;

                    case "Design Review/Approve":
                        return 4;

                    case "Implement":
                        return 5;

                    case "Implement Review/Approve":
                        return 6;

                    case "Closeout":
                        return 7;

                    case "Closeout Review/Approve":
                        return 8;

                    case "Closed/Cancelled":
                        return 9;

                    default:
                        return 0;
                }
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
            },
            changeId() {
                const change_id = this.factory+'-'+this.unit+'-'+this.system+currentMonth+formatedTwoLastDigits+'-xxx';
                console.log(change_id);
                return this.change_id = change_id;
            },
        },

        methods: {
            ...mapActions({
                'changeData': 'changeData'
            }),
            showError () {
                this.snackbar = true;
                this.hasError = true;
            },
            showSuccess () {
                this.snackbar = true;
                this.hasError = false;
            },
            comment () {
                if (! this.id) {
                    return alert("Please create a new change first.");
                }
                axios
                .post(`${baseRoute}/web/comment`, {change_id: this.id, content: this.inputComment})
                .then(
                    response => {
                        //
                        this.comments.push(response.data.data);
                        this.showSuccess();
                    }
                )
                .catch(
                    error => this.showError()
                )
                .then(
                    () => void(0)
                );

                this.inputComment = null
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
                        this.flowJson = JSON.parse(this.flow);
                        console.log("@@@ flow @@@", this.flowJson);
                    }
                )
                .catch(
                    error => void(0)
                )
                .then(
                    () => void(0)
                );
            },
            generateChangeId() {
                axios
                    .get(`${baseRoute}/web/generate-change-id?factory=${this.factory}&unit=${this.unit}&system=${this.system}`)
                    .then(
                        response => {
                            this.change_id = response.data.data;
                        }
                    )
                    .catch(
                        error => void(0)
                    )
                    .then(
                        () => void(0)
                    );
            },
            viewDetailReport(item) {
                axios
                    .get(`${baseRoute}/web/view-detail-report?factory=${item.factory}&unit=${item.unit}&system=${item.system}&status_name=${item.id}`)
                    .then(
                        response => {
                            this.detailReport = response.data.data;
                        }
                    )
                    .catch(
                        error => void(0)
                    )
                    .then(
                        () => void(0)
                    );
            },
            loadReport(meta) {
                axios
                .get(`${baseRoute}/web/change/report?factory=${meta.factory}&unit=${meta.unit}&system=${meta.system}`)
                .then(
                    response => {
                        //
                        this.reportChart = response.data.data;
                        this.reportChartNavigation = response.data.navigation;
                    }
                )
                .catch(
                    error => void(0)
                )
                .then(
                    () => void(0)
                );
            },
            submit(e, status = null, is_approve) {
                console.log('id', this.id);

                this.$v.$touch();

                if (this.$v.$error) return alert("Error! Please check the form.");

                const data = _.pick(this, _.keys(defaultData));

                console.info("@@@ submit @@@", data);

                axios
                .post(`${baseRoute}/web/change`, {...data, assigned_status: status, is_approve: is_approve})
                .then(
                    response => {
                        //
                        this.id = response.data.id;
                        this.loadData(this.id);
                        this.showSuccess();
                    }
                )
                .catch(
                    error => this.showError()
                )
                .then(
                    () => this.changeData()
                );
            },
            upload(file) {
                if (! this.id) {
                    return alert("Please create a new change first.");
                }

                const config = {
                    headers: { 'content-type': 'multipart/form-data' }
                };
                let formData = new FormData();
                formData.append('file', file);
                formData.append('meta', JSON.stringify({
                    change_id: this.id
                }));

                axios
                .post(`${baseRoute}/web/attachment`,  formData, config)
                .then(
                    response => {
                        //
                        this.files.push(response.data.data);
                        this.showSuccess();
                    }
                )
                .catch(
                    error => this.showError()
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
                        this.showSuccess();
                    }
                )
                .catch(
                    error => this.showError()
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
