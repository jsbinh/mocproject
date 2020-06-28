<template>
    <div class="accordion" :id="id">
        <div class="card">
            <div class="card-header" :id="id + 'headingOne'">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse"
                        :[attributes.dataTarget]="'#' + id + 'collapseOne'" aria-expanded="true" :[attributes.ariaControls]="id + 'collapseOne'">
                        Bảng chú thích điều kiện lọc
                    </button>
                </h2>
            </div>

            <div :id="id + 'collapseOne'" class="collapse" :[attributes.ariaLabelledby]="id + 'headingOne'" :[attributes.dataParent]="'#' + id">
                <div class="card-body">
                    <ul class="narrow">
                        <li>
                            <strong>ttdt4q | ttdtqgn | ttdtqgn2:</strong>
                            Tăng trưởng doanh thu (%) 4 quý, quý gần nhất, quý gần nhì
                        </li>
                        <li>
                            <strong>ttlnst4qgn | ttlnstqgn | ttlnstqgn2:</strong>
                            Tăng trưởng lợi nhuận sau thuế (%) 4 quý, quý gần nhất, quý gần nhì
                        </li>
                        <li>
                            <strong>roe | roa:</strong>
                            ROE, ROA
                        </li>
                        <li>
                            <strong>tllg | tllr:</strong>
                            Tỉ lệ lãi gộp, lãi ròng (%)
                        </li>
                        <li>
                            <strong>tspe | tspb:</strong>
                            Tỉ số P/E, P/B
                        </li>
                        <li>
                            <strong>vhtt:</strong>
                            Vốn hoá thị trường, đơn vị 1 đồng
                        </li>
                        <li>
                            <strong>tbkl10 | tbkl20:</strong>
                            Khối lượng giao dịch trung bình 10 phiên, 20 phiên
                        </li>
                        <li>
                            <strong>code:</strong>
                            Mã cổ phiếu
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" :id="id + 'headingTwo'">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse"
                        :[attributes.dataTarget]="'#' + id + 'collapseTwo'" aria-expanded="false" :[attributes.ariaControls]="id + 'collapseTwo'">
                        P/E, P/B, ROE là gì?
                    </button>
                </h2>
            </div>
            <div :id="id + 'collapseTwo'" class="collapse" :[attributes.ariaLabelledby]="id + 'headingTwo'" :[attributes.dataParent]="'#' + id">
                <div class="card-body">
                    <img src="/img/pe-pb-roe.jpg" class="hinh-pe-pb-roe" />
                    Xem thêm tại <a href="https://cophieux.com/chi-so-roe/" target="_blank">đây</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "FilterInfo",
        data() {
            return {
                "id": `accordion-${new Date().getTime()}-`,
                "attributes": {
                    dataTarget: "data-target",
                    ariaControls: "aria-controls",
                    ariaLabelledby: "aria-labelledby",
                    dataParent: "data-parent"
                }
            }
        }
    }
</script>

<style lang="scss" scoped>
    ul {
        &.narrow {
            padding-left: 10px;
        }
    }
    img {
        &.hinh-pe-pb-roe {
            width: 100%;
            /* height: 400px; */
            object-fit: cover;
        }
        margin-bottom: 5px;
    }
    .accordion {
        .card-header {
            padding: 0px;
        }
    }
</style>
