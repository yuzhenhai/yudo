<?php /* Template_ 2.2.6 2019/11/04 14:12:28 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/ManageInfoView/WEI_0100_Lists.html 000013495 */ ?>
<?php $this->print_("yudoHeaderStart",$TPL_SCP,1);?>

<?php $this->print_("yudoCss",$TPL_SCP,1);?>

<style type="text/css">
    .yudo-window{
        animation-duration: 0.5s
    }
    .yudo-window-trans{
        animation-duration: 0.3s
    }
</style>
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
                <div class="info-class">
                    <div class="info-body">
                        <div v-bind:class="yearItem" style="width: 25%" @click="changeInfoItem(0)">$((lang.year))</div>
                        <div v-bind:class="monthSumItem" style="width: 25%"  @click="changeInfoItem(1)">$((lang.monthSum))</div>
                        <div v-bind:class="monthItem" style="width: 25%"  @click="changeInfoItem(2)">$((lang.month))</div>
                        <div v-bind:class="dayItem" style="width: 25%"  @click="changeInfoItem(3)">$((lang.day))</div>
                    </div>
                </div>
                <div class="info-search" style="height:130px">
                    <div class="info-search-input" style="width: 71%">
                        <div class="write-input" @click="searchDate()" style="margin-top: 10px">
                            <div style="float:left;margin-top: 4px;display: inline-block;width: 25px;height: 25px" class="icon-date" ></div>
                            <div style="float:left;margin-top: 8px;margin-left: 15px;">$((salesTargetDate))</div>
                        </div>
                        <div class="write-input">
                            <div class="left-icon icon-expclass" style="height: 22px;width: 22px;top: 7px"></div>
                            <select v-model="input.db">
                                <option :value="item.value" v-for="(item,index) in list.db">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                    <div class="search-btn" style="height: 90%;width: 29%;margin-top: 5px">
                        <button class="mui-btn noborder" style="font-size: 16px;line-height: 100%" @click="getResults()" >
                            $((lang.search))
                        </button>
                    </div>
                </div>
                <div class="info-minute">
                    <div class="minute-header">
                        <div class="left-text" style="color: #212121;margin-top: 2px" >$((lang.dataMinute))</div>
                        <div class="right-text" style="margin: 2px 0 0 10px;">$((lang.unit)):<span style="color: red">$((lang.unitInfo))</span></div>
                    </div>
                    <div class="minute-project" style="position: absolute;top:260px;bottom: 0">
                        <div class="minute-table" style="height: 100%">
                            <div v-if="view.targetNoData" class="nodata"  >$((lang.nodata))</div>
                            <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in list.summarizeList" @click="buildDataMinute(index)" >
                                <div class="minute-body flex" style="height: 95px;padding: 3px 10px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" >
                                    <div class="minute-body-left" >
                                        <div>
                                            <div v-bind:style="{'color':item.percentColor}" style="font-weight: 700;text-align: center;height: 40px;line-height: 35px;font-size: 26px;">$((item.percent))%</div>
                                            <div style="height: 13px;line-height: 12px;text-align: center;font-size: 14px;color: #2f2d30">↑$((lang.growRate))</div>
                                        </div>
                                    </div>
                                    <div class="little-line"></div>
                                    <div class="minute-body-right" >
                                        <div>
                                            <div style="text-align: left;height: 20px;line-height: 20px;font-size: 14px;color: #211f22">$((item.name))</div>
                                            <div style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30">$((lang.lastYear))：$((item.ForAmt_Pre))</div>
                                            <div style="text-align: left;height: 16px;line-height: 16px;font-size: 12px;color: #2f2d30">$((lang.toYear))：$((item.ForAmt))</div>
                                        </div>
                                        <div class="mui-icon mui-icon-arrowright" style="font-size: 15px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="yudo-window-trans animated fadeInRight trans-one" v-if="view.dataMinute">
            <div class="header-ios">
                <div class="header-body">
                    <div class="header-left-btn" @click="closeDataMinute()">
                        <div class="left-icon icon-back-2"></div>
                    </div>
                    <div class="header-center-btn" >$((lang.transTitle))</div>
                    <div class="header-right-btn">
                        <div class="right-icon icon-extend"></div>
                    </div>
                </div>
            </div>
            <div class="center-ios">
                <div class="info-minute" style="height: 100%">
                    <div class="minute-header">
                        <div class="left-text" style="color: #212121;margin-top: 2px" >$((lang.dataMinute))</div>
                        <div class="right-text" style="margin: 2px 0 0 10px;">$((lang.unit)):<span style="color: red">$((lang.unitInfo))</span></div>
                    </div>
                    <div class="minute-project" style="position: absolute;top:90px;bottom: 0">
                        <div class="minute-th">
                            <div style="width: 100%">
                                <div class="long record-family-data" style="float: left;padding-right:10px;width: 24%;color: #2471D2" >$((lang.class))</div>
                                <div class="long record-family-data" style="float: left;padding-right:10px;width: 24%;color: #2471D2;text-align: right" >$((lang.lastYear))</div>
                                <div class="long record-family-data" style="float: left;padding-right:10px;width: 24%;color: #2471D2;text-align: right" >$((lang.toYear))</div>
                                <div class="long record-family-data" style="float: left;padding-right:10px;width: 24%;color: #2471D2;text-align: right" >$((lang.growRate))</div>
                            </div>
                        </div>
                        <div class="minute-table" style="position: absolute;top:30px;bottom: 0" >
                            <div v-if="view.targetNoData" class="nodata" >$((lang.nodata))</div>
                            <div class="minute-body-title2" style="font-size: 15px" v-bind:style="{'color':'#2471D2'}">
                                <div class="minute-body-th">
                                    <div style="width: 24%" class="minute-body-td long">External</div>
                                    <div style="width: 24%;text-align: right;font-size: 13px;font-weight: 400;" class="minute-body-td long">$((list.sumExternalDisplay.ForAmt_Pre))</div>
                                    <div style="width: 24%;text-align: right;font-size: 13px;font-weight: 400;" class="minute-body-td long">$((list.sumExternalDisplay.ForAmt))</div>
                                    <div style="width: 24%;text-align: right;font-size: 13px;font-weight: 400;" class="minute-body-td long">$((list.sumExternalDisplay.percent))%</div>
                                </div>
                            </div>

                            <div class="minute-list" style="border-bottom: 0" v-for="(item,index) in list.minuteListDisplay.external" >
                                <div class="minute-body" style="height: 25px;padding: 3px 10px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" >
                                    <div class="minute-body-th">
                                        <div style="width: 24%" class="minute-body-td long">$((item.DeptNm))</div>
                                        <div style="width: 24%;text-align: right" class="minute-body-td long">$((item.ForAmt_Pre))</div>
                                        <div style="width: 24%;text-align: right" class="minute-body-td long">$((item.ForAmt))</div>
                                        <div style="width: 24%;text-align: right" class="minute-body-td long" v-bind:style="{'color':item.percentMinuteColor}">$((item.percent))%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="minute-body-title2" style="font-size: 15px" v-bind:style="{'color':'#2471D2'}">
                                <div class="minute-body-th">
                                    <div style="width: 24%" class="minute-body-td long">Internal</div>
                                    <div style="width: 24%;text-align: right;font-size: 13px;font-weight: 400;" class="minute-body-td long">$((list.sumInternalDisplay.ForAmt_Pre))</div>
                                    <div style="width: 24%;text-align: right;font-size: 13px;font-weight: 400;" class="minute-body-td long">$((list.sumInternalDisplay.ForAmt))</div>
                                    <div style="width: 24%;text-align: right;font-size: 13px;font-weight: 400;" class="minute-body-td long">$((list.sumInternalDisplay.percent))%</div>
                                </div>
                            </div>
                            <div class="minute-list" style="border-bottom: 0" v-for="(item,index) in list.minuteListDisplay.internal" >
                                <div class="minute-body" style="height: 25px;padding: 3px 10px" v-bind:style="{'background':item.background,'border-left-color':item.background,'color':item.color}" >
                                    <div class="minute-body-th">
                                        <div style="width: 24%" class="minute-body-td long">$((item.DeptNm))</div>
                                        <div style="width: 24%;text-align: right" class="minute-body-td long">$((item.ForAmt_Pre))</div>
                                        <div style="width: 24%;text-align: right" class="minute-body-td long">$((item.ForAmt))</div>
                                        <div style="width: 24%;text-align: right" class="minute-body-td long" v-bind:style="{'color':item.percentMinuteColor}">$((item.percent))%</div>
                                    </div>
                                </div>
                            </div>
                            <div class="minute-body-title2" style="font-size: 15px" v-bind:style="{'color':'#2471D2'}">
                                <div class="minute-body-th">
                                    <div style="width: 24%" class="minute-body-td long">Totol</div>
                                    <div style="width: 24%;text-align: right;font-size: 13px;font-weight: 400;" class="minute-body-td long">$((list.sumDataDisplay.ForAmt_Pre))</div>
                                    <div style="width: 24%;text-align: right;font-size: 13px;font-weight: 400;" class="minute-body-td long">$((list.sumDataDisplay.ForAmt))</div>
                                    <div style="width: 24%;text-align: right;font-size: 13px;font-weight: 400;" class="minute-body-td long">$((list.sumDataDisplay.percent))%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<script src="/js/WEI_0100/WEI_0100_Lists.js?v=<?php $this->print_("WEI_0100Version",$TPL_SCP,1);?>"></script>
<?php $this->print_("yudoFooter",$TPL_SCP,1);?>