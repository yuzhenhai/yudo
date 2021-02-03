<?php /* Template_ 2.2.6 2019/08/02 15:34:56 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/SalesManageView/WEI_1410_Lists.html 000006977 */ ?>
<?php $this->print_("yudoHeaderStart",$TPL_SCP,1);?>

<?php $this->print_("yudoCss",$TPL_SCP,1);?>

<?php $this->print_("yudoJs",$TPL_SCP,1);?>

<?php $this->print_("yudoHeaderEnd",$TPL_SCP,1);?>

<div class="yudo-content" id="leon">
    <div class="download-script" v-if="view.downLoadScript"></div>
    <div class="yudo-window" v-if="view.viewTargetMinute">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" onclick="multi.backMenu()">
                    <div class="left-icon icon-backmenu"></div>
                    <div class="left-text">$((lang.menuBack))</div>
                </div>
                <div class="header-center-btn" >$((lang.headerTitle))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" id="centerControl" style="background: white;">
            <div class="info-search" >
                <div class="info-search-input" style="width: 75%">
                    <div class="write-input">
                        <div class="left-icon icon-expclass" style="height: 22px;width: 22px;top: 7px"></div>
                        <select v-model="input.expClass">
                            <option :value="item.value" v-for="(item,index) in list.expClass">$((item.text))</option>
                        </select>
                    </div>
                    <div class="write-input">
                        <div class="left-icon icon-search-class"></div>
                        <select v-model="input.groupClass">
                            <option :value="item.value" v-for="(item,index) in list.groupClass">$((item.text))</option>
                        </select>
                    </div>
                    <div class="write-input">
                        <div class="left-icon icon-search-class"></div>
                        <select v-model="input.deptCd">
                            <option :value="item.value" v-for="(item,index) in list.deptCd">$((item.text))</option>
                        </select>
                    </div>
                </div>
                <div class="search-btn" style="padding: 0  0  0 10px;height: 30px;width: 25%;margin-top: 5px">
                    <button class="mui-btn noborder" style="font-size: 14px;line-height: 100%" @click="getResults()" j-word-label="W2018082711232500387">
                        $((lang.search))
                    </button>
                </div>
            </div>
            <div class="info-minute">
                <div class="minute-header">
                    <div class="left-text" style="color: #212121;margin-top: 2px" >$((lang.dataMinute))</div>
                    <div class="right-text" @click="searchDate()">
                        <div style="display: inline-block" class="icon-date"></div>
                        <div style="float: right;margin-left: 5px;margin-top: 2px">$((salesTargetDate))</div>
                    </div>
                    <div class="right-text" style="margin: 2px 10px 0 10px;">$((lang.unit)):<span style="color: red">$((lang.nowUnit))</span></div>
                </div>
                <div class="minute-project">
                    <div class="minute-table" style="max-height: 300px">
                        <div v-if="view.targetNoData" class="nodata" j-word-label="W2018062810475725084" >$((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.resultsList" @click="getResultsMinute(index)">
                            <div class="minute-body" style="height: 140px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" v-bind:class="{minuteAcitve:index==isactive}">
                                <div class="minute-body-title"  v-bind:style="{'color':item.titlecolor}">$((item.Month))</div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.lastYearOrder)):$((item.PreYYOrderAmt))</div>
                                    <div class="minute-body-td long">$((lang.nowYearOrder)):$((item.DueYYOrderAmt))</div>
                                    <div class="minute-body-td long">$((lang.percent)):$((item.OrderAchRate))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.lastYearInvoice)):$((item.PreYYInvoiceAmt))</div>
                                    <div class="minute-body-td long">$((lang.nowYearInvoice)):$((item.DueYYInvoiceAmt))</div>
                                    <div class="minute-body-td long">$((lang.percent)):$((item.InvoiceAchRate))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.lastYearBill)):$((item.PreYYBillAmt))</div>
                                    <div class="minute-body-td long">$((lang.nowYearBill)):$((item.DueYYBillAmt))</div>
                                    <div class="minute-body-td long">$((lang.percent)):$((item.BillAchRate))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.lastYearReceipt)):$((item.PreYYReceiptAmt))</div>
                                    <div class="minute-body-td long">$((lang.nowYearReceipt)):$((item.DueYYReceiptAmt))</div>
                                    <div class="minute-body-td long">$((lang.percent)):$((item.ReceiptAchRate))</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="minute-header">
                    <div class="left-text" style="color: #212121;margin-top: 2px" j-word-label="W2018102617085239791">$((lang.pictrolTable))</div>
                    <!--<div class="right-text" style="margin-top: 2px" @click="changeTheme();" j-word-label="W2018110618023964046">$((lang.changeTheme))</div>-->
                </div>
                <div class="nodata" v-if="view.echartsNoData"  j-word-label="W2018062810475725084">$((lang.nodata))</div>
                <div class="echarts" id="echarts">
                </div>
            </div>
        </div>
    </div>

</div>
<script src="/js/WEI_1410/WEI_1410_Lists.js?v=<?php $this->print_("WEI_1410Version",$TPL_SCP,1);?>"></script>
<?php $this->print_("footer",$TPL_SCP,1);?>