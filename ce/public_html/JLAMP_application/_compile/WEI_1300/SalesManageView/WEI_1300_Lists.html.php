<?php /* Template_ 2.2.6 2019/08/02 15:34:47 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/SalesManageView/WEI_1300_Lists.html 000008306 */ ?>
<?php $this->print_("yudoHeaderStart",$TPL_SCP,1);?>

<?php $this->print_("yudoCss",$TPL_SCP,1);?>

<?php $this->print_("yudoJs",$TPL_SCP,1);?>

<style type="text/css">
    .yudo-window {
        animation-duration: 0.4s
    }

    .yudo-window-trans {
        animation-duration: 0.2s
    }
</style>
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
                <div class="header-center-btn">$((lang.targetAndResults))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" id="centerControl" style="background: white;">
            <div class="info-search" style="height:80px">
                <div class="info-search-input" style="width: 75%">
                    <div class="write-input" @click="searchDate()" style="margin-top: 10px">
                        <div style="float:left;margin-top: 4px;display: inline-block;width: 25px;height: 25px"
                            class="icon-date"></div>
                        <div style="float:left;margin-top: 8px;margin-left: 15px;">$((salesTargetDate))</div>
                    </div>
                </div>
                <div class="search-btn" style="height: 90%;width: 25%;margin-top: 5px">
                    <button class="mui-btn noborder" style="font-size: 14px;line-height: 100%" @click="getResults()"
                        j-word-label="W2018082711232500387">
                        $((lang.search))
                    </button>
                </div>
            </div>
            <div class="info-minute">
                <div class="minute-header">
                    <div class="left-text" style="color: #212121;margin-top: 2px">$((lang.dataMinute))</div>
                    <div class="right-text" style="margin: 2px 0 0 10px;">$((lang.unit)):<span
                            style="color: red">$((lang.unitInfo))</span></div>
                </div>
                <div class="minute-project">
                    <div class="minute-table" style="max-height: 300px">
                        <div v-if="view.targetNoData" class="nodata" j-word-label="W2018062810475725084">
                            $((lang.nodata))</div>
                        <div class="minute-list" v-for="(item,index) in list.resultsList"
                            @click="getResultsMinute(index)">
                            <div class="minute-body" style="height: 90px"
                                v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}"
                                v-bind:class="{minuteAcitve:index==isactive}">
                                <div class="minute-body-title" v-bind:style="{'color':item.titlecolor}">
                                    $((item.DeptDiv1))</div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.noInvocie)):$((item.MiInvoiceForAmt))</div>
                                    <div class="minute-body-td long">$((lang.noBill)):$((item.MiBillForAmt))</div>
                                    <div class="minute-body-td long">$((lang.noReceipt)):$((item.MiReceiptForAmt))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long">$((lang.productNoInvoce)):$((item.MiProductForAmt))</div>
                                    <div class="minute-body-td long">$((lang.productNoAccept)):$((item.MiWkAptForAmt))</div>
                                    <div class="minute-body-td long">$((lang.productNoOutDraw)):$((item.DrawMiOutForAmt))</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="minute-header">
                    <div class="left-text" style="color: #212121;margin-top: 2px" j-word-label="W2018102617085239791">
                        $((lang.pictrolTable))</div>
                    <!--<div class="right-text" style="margin-top: 2px" @click="changeTheme();" j-word-label="W2018110618023964046">$((lang.changeTheme))</div>-->
                    <div id="echartsHeader" class="echarts-header" style="display: none">
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div
                                style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #76ccff">
                            </div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.noInvocie))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div
                                style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #55aeff">
                            </div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.noBill))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div
                                style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #2196ff">
                            </div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.noReceipt))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div
                                style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #f6e993">
                            </div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.productNoInvoce))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div
                                style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #fff244">
                            </div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.productNoAccept))</div>
                        </div>
                        <div style="width: 33.33333%;float: left;height: 18px;padding: 0 0 4px 0">
                            <div
                                style="border-radius: 5px;float: left;height: 100%;width: 25px;background-color: #ffe000">
                            </div>
                            <div style="height: 100%;margin: -2px 0 0 5px;font-size: 12px;float: left">$((lang.productNoOutDraw))</div>
                        </div>
                    </div>
                </div>
                <div class="nodata" v-if="view.echartsNoData" j-word-label="W2018062810475725084">$((lang.nodata))</div>
                <div class="echarts" id="echarts">
                </div>
            </div>
        </div>
    </div>

</div>
<script src="/js/WEI_1300/WEI_1300_Lists.js?v=<?php $this->print_("WEI_1300Version",$TPL_SCP,1);?>"></script>
<?php $this->print_("footer",$TPL_SCP,1);?>