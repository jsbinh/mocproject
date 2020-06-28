<template>
    <div :class="['container', { 'read-only': template }]">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <VJsoneditor v-model="json" :options="options" height="450px" @error="onError"/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-2 mt-2">
                <button type="button" class="btn btn-primary"
                    @click="onSubmit" v-if="!template"
                >
                    <i class="fas fa-save"></i>&nbsp;
                    Cập nhật bộ lọc
                    &nbsp;<i class="fas fa-spinner fa-spin" v-show="waitingUpdate"></i>
                </button>
                <button type="button" class="btn btn-secondary"
                    @click="onExport" v-if="!template"
                    data-toggle="tooltip" data-placement="top" title="Cập nhật bộ lọc trước khi thực hiện xuất kết quả"
                >
                    <i class="fas fa-file-excel"></i>&nbsp;
                    Xuất kết quả lọc
                    &nbsp;<i class="fas fa-spinner fa-spin" v-show="waitingExport"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm"
                    @click="clickButtonCopyJSONFilterTemplate" v-if="template"
                >
                    <i class="fas fa-copy"></i>&nbsp;
                    Sao chép bộ lọc gợi ý
                </button>
            </div>
        </div>

        <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="!template && updateResult === false">
            <strong>Đã có lỗi xảy ra!</strong> Không thể cập nhật.
            <button type="button" class="close" aria-label="Close" @click="dismiss">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="!template && updateResult === true">
            <strong>Cập nhật thành công!</strong>.
            <button type="button" class="close" aria-label="Close" @click="dismiss">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <filter-info-component v-if="template"/>

        <!-- <span>{{foo}}</span>
        <button @click="setFoo">set foo</button> -->
    </div>
</template>

<script>
    import VJsoneditor from 'v-jsoneditor';
    import { mapGetters, mapActions } from 'vuex';

    export default {
        name: "FilterEditor",
        components: {
            VJsoneditor
        },
        props: {
            "template": {
                type: Boolean,
                default: false
            }
        },
        mounted() {
            this.template ? this.getTemplate() : this.getMyFilter();
        },
        data() {
            return {
                json: {msg: "đang tải..."},
                options: {
                    "mode": this.template ? "preview" : "code",
                    "indentation": 2,
                    // "mainMenuBar": this.template ? false : true,
                    // "navigationBar": this.template ? false : true,
                },
                waitingUpdate: false,
                waitingExport: false,
                updateResult: undefined
            }
        },
        computed: {
            ...mapGetters([
                'foo',
                'stockJSONFilterTemplate',
                'buttonCopyJSONFilterTemplateClicked'
            ])
        },
        watch: {
            buttonCopyJSONFilterTemplateClicked: function (newValue, oldValue) {
                if (newValue && !this.template) {
                    this.json = this.stockJSONFilterTemplate;
                    this.$store.dispatch('clickButtonCopyJSONFilterTemplate', false);
                }
            }
        },
        methods: {
            ...mapActions({
                setFoo (dispatch) {
                    dispatch('setFoo', this.json)
                },
                copyStockJSONFilterTemplate: 'copyStockJSONFilterTemplate',
                clickButtonCopyJSONFilterTemplate (dispatch) {
                    dispatch('clickButtonCopyJSONFilterTemplate', true)
                },
            }),
            onError() {
                console.log('error')
            },
            async onSubmit() {
                this.waitingUpdate = true;

                axios
                .put('/loc-co-phieu/filter', this.json)
                .then(
                    response => this.updateResult = true
                )
                .catch(
                    error => this.updateResult = false
                )
                .then(
                    () => {
                        // always executed
                        this.waitingUpdate = false;
                        this.json = {msg: "tải lại nội dung..."};
                        this.getMyFilter();
                    }
                );
            },
            onExport() {
                this.waitingExport = true;

                axios({
                    url: '/loc-co-phieu/export', //your url
                    method: 'GET',
                    responseType: 'blob', // important
                })
                .then((response) => {
                    this.waitingExport = false;

                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', 'stocks_selection.xlsx'); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                });
            },
            getTemplate() {
                axios
                .get('/loc-co-phieu/filter-template')
                .then(
                    response => {
                        this.json = response.data.data || {msg: "không có dữ liệu."}
                        this.copyStockJSONFilterTemplate(this.json)
                    }
                )
                .catch(
                    error => this.json = {msg: "có lỗi xảy ra."}
                )
            },
            getMyFilter() {
                axios
                .get('/loc-co-phieu/filter')
                .then(
                    response => this.json = response.data.data || {msg: "không có dữ liệu."}
                )
                .catch(
                    error => this.json = {msg: "có lỗi xảy ra."}
                )
            },
            dismiss() {
                this.updateResult = undefined;
            }
        }
    }
</script>

<style lang="scss">
    .read-only {
        .jsoneditor {
            border: none;
        }
    }
</style>
