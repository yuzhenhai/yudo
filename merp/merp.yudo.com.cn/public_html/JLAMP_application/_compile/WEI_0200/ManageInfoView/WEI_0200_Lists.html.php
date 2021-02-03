<?php /* Template_ 2.2.6 2020/03/30 14:56:58 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/ManageInfoView/WEI_0200_Lists.html 000019902 */ ?>
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
                <div class="info-search" style="height:130px">
                    <div class="info-search-input" style="width: 71%">
                        <div class="write-input" @click="searchDate()" style="margin-top: 10px">
                            <div style="float:left;margin-top: 4px;display: inline-block;width: 25px;height: 25px" class="icon-date" ></div>
                            <div style="float:left;margin-top: 8px;margin-left: 15px;">$((salesTargetDate))</div>
                        </div>
                        <div class="write-input">
                            <div class="left-icon icon-money" style="height: 22px;width: 22px;top: 7px"></div>
                            <select v-model="input.amtClass">
                                <option :value="item" v-for="(item,index) in list.amtClass">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                    <div class="search-btn" style="height: 90%;width: 29%;margin-top: 5px">
                        <button class="mui-btn noborder" style="font-size: 16px;line-height: 100%" @click="getResults()">
                            $((lang.search))
                        </button>
                    </div>
                </div>
                <div class="info-minute">
                    <div class="minute-header">
                        <div class="left-text" style="color: #212121;margin-top: 2px" >$((lang.dataMinute))</div>
                        <div class="right-text" style="margin: 2px 0 0 10px;">$((lang.unit)):<span style="color: red">$((lang.unitInfo))</span></div>
                        <!--<div class="right-text" @click="changeTubiao()" style="margin: 2px 0 0 10px;">切换样式</div>-->
                    </div>
                    <div class="minute-project" style="position: absolute;top:220px;bottom: 0">
                        <div class="minute-table" style="height: 100%">
                            <div v-if="view.resultsNoData" :key="1" class="nodata">$((lang.nodata))</div>
                            <div v-if="list.amtList.SZ.show" :key="2"  class="minute-list"  style="position: relative;border-bottom: 5px solid #f9f9f9;" >
                                <div class="minute-body flex" style="height: 180px;padding: 3px 10px 3px 10%" >
                                    <div class="minute-body-left" style="padding: 0">
                                        <div style="width: 100%">
                                            <div style="height: 20px;line-height: 12px;text-align: left;font-size: 14px;color: #2f2d30">↑$((lang.growRate)):$((lang.SUZHOU))</div>
                                            <div style="font-weight: 700;text-align: left;height: 40px;line-height: 35px;font-size: 35px;color: #535866">$((list.amtList.SZ.percent))%</div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.lastYear)):$((list.amtList.SZ.lastYearAmt))</div>
                                            </div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.nowYear)):$((list.amtList.SZ.nowYearAmt))</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="little-line"></div>-->
                                    <div class="minute-body-right"  style="min-width: 193px;padding: 0 10px 15px 10px">
                                        <div class="yudo-yibiao" style="position: relative;">
                                            <div id="chartSZ" style="position: absolute;bottom:-25px;height: 50px;width: 100%;justify-content: space-around;" class="flex-center yudo-animate-rotate">
                                                <div class="yudo-yibiao-needle2" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div v-if="list.amtList.GD.show" :key="3"  class="minute-list"  style="position: relative;border-bottom: 5px solid #f9f9f9;" >
                                <div class="minute-body flex" style="height: 180px;padding: 3px 10px 3px 10%" >
                                    <div class="minute-body-left" style="padding: 0">
                                        <div style="width: 100%">
                                            <div style="height: 20px;line-height: 12px;text-align: left;font-size: 14px;color: #2f2d30">↑$((lang.growRate)):$((lang.GUANGDONG))</div>
                                            <div style="font-weight: 700;text-align: left;height: 40px;line-height: 35px;font-size: 35px;color: #535866">$((list.amtList.GD.percent))%</div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.lastYear)):$((list.amtList.GD.lastYearAmt))</div>
                                            </div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.nowYear)):$((list.amtList.GD.nowYearAmt))</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="little-line"></div>-->
                                    <div class="minute-body-right"  style="min-width: 193px;padding: 0 10px 15px 10px">
                                        <div class="yudo-yibiao" style="position: relative;">
                                            <div id="chartGD" style="position: absolute;bottom:-25px;height: 50px;width: 100%;justify-content: space-around;" class="flex-center yudo-animate-rotate">
                                                <div class="yudo-yibiao-needle2" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="list.amtList.QD.show" :key="4"  class="minute-list"  style="position: relative;border-bottom: 5px solid #f9f9f9;" >
                                <div class="minute-body flex" style="height: 180px;padding: 3px 10px 3px 10%" >
                                    <div class="minute-body-left" style="padding: 0">
                                        <div style="width: 100%">
                                            <div style="height: 20px;line-height: 12px;text-align: left;font-size: 14px;color: #2f2d30">↑$((lang.growRate)):$((lang.QINGDAO))</div>
                                            <div style="font-weight: 700;text-align: left;height: 40px;line-height: 35px;font-size: 35px;color: #535866">$((list.amtList.QD.percent))%</div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.lastYear)):$((list.amtList.QD.lastYearAmt))</div>
                                            </div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.nowYear)):$((list.amtList.QD.nowYearAmt))</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="little-line"></div>-->
                                    <div class="minute-body-right"  style="min-width: 193px;padding: 0 10px 15px 10px">
                                        <div class="yudo-yibiao" style=";position: relative;">
                                            <div id="chartQD" style="position: absolute;bottom:-25px;height: 50px;width: 100%;justify-content: space-around;" class="flex-center yudo-animate-rotate">
                                                <div class="yudo-yibiao-needle2" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="list.amtList.HS.show" :key="5"  class="minute-list"  style="position: relative;border-bottom: 5px solid #f9f9f9;" >
                                <div class="minute-body flex" style="height: 180px;padding: 3px 10px 3px 10%" >
                                    <div class="minute-body-left" style="padding: 0">
                                        <div style="width: 100%">
                                            <div style="height: 20px;line-height: 12px;text-align: left;font-size: 14px;color: #2f2d30">↑$((lang.growRate)):$((lang.HANS))</div>
                                            <div style="font-weight: 700;text-align: left;height: 40px;line-height: 35px;font-size: 35px;color: #535866">$((list.amtList.HS.percent))%</div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.lastYear)):$((list.amtList.HS.lastYearAmt))</div>
                                            </div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.nowYear)):$((list.amtList.HS.nowYearAmt))</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="little-line"></div>-->
                                    <div class="minute-body-right"  style="min-width: 193px;padding: 0 10px 15px 10px">
                                        <div class="yudo-yibiao" style=";position: relative;">
                                            <div id="chartHS" style="position: absolute;bottom:-25px;height: 50px;width: 100%;justify-content: space-around;" class="flex-center yudo-animate-rotate">
                                                <div class="yudo-yibiao-needle2" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="list.amtList.XR.show" :key="6"  class="minute-list"  style="position: relative;border-bottom: 5px solid #f9f9f9;" >
                                <div class="minute-body flex" style="height: 180px;padding: 3px 10px 3px 10%" >
                                    <div class="minute-body-left" style="padding: 0">
                                        <div style="width: 100%">
                                            <div style="height: 20px;line-height: 12px;text-align: left;font-size: 14px;color: #2f2d30">↑$((lang.growRate)):$((lang.XIANRUI))</div>
                                            <div style="font-weight: 700;text-align: left;height: 40px;line-height: 35px;font-size: 35px;color: #535866">$((list.amtList.XR.percent))%</div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.lastYear)):$((list.amtList.XR.lastYearAmt))</div>
                                            </div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.nowYear)):$((list.amtList.XR.nowYearAmt))</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="little-line"></div>-->
                                    <div class="minute-body-right"  style="min-width: 193px;padding: 0 10px 15px 10px">
                                        <div class="yudo-yibiao" style=";position: relative;">
                                            <div id="chartXR" style="position: absolute;bottom:-25px;height: 50px;width: 100%;justify-content: space-around;" class="flex-center yudo-animate-rotate">
                                                <div class="yudo-yibiao-needle2" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="list.amtList.YBD.show" :key="6"  class="minute-list"  style="position: relative;border-bottom: 5px solid #f9f9f9;" >
                                <div class="minute-body flex" style="height: 180px;padding: 3px 10px 3px 10%" >
                                    <div class="minute-body-left" style="padding: 0">
                                        <div style="width: 100%">
                                            <div style="height: 20px;line-height: 12px;text-align: left;font-size: 14px;color: #2f2d30">↑$((lang.growRate)):$((lang.YIBIDAO))</div>
                                            <div style="font-weight: 700;text-align: left;height: 40px;line-height: 35px;font-size: 35px;color: #535866">$((list.amtList.YBD.percent))%</div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.lastYear)):$((list.amtList.YBD.lastYearAmt))</div>
                                            </div>
                                            <div class="flex" style="justify-content:flex-start;overflow:hidden;">
                                                <div class="icon-tubiao-mini icon-gray" style="margin-right: 5px"></div>
                                                <div class="long" style="width: 70%;height: 20px;line-height: 20px;text-align: left;font-size: 11px;color: #2f2d30">$((view.nowYear)):$((list.amtList.YBD.nowYearAmt))</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--<div class="little-line"></div>-->
                                    <div class="minute-body-right"  style="min-width: 193px;padding: 0 10px 15px 10px">
                                        <div class="yudo-yibiao" style=";position: relative;">
                                            <div id="chartYBD" style="position: absolute;bottom:-25px;height: 50px;width: 100%;justify-content: space-around;" class="flex-center yudo-animate-rotate">
                                                <div class="yudo-yibiao-needle2" ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="/js/WEI_0200/WEI_0200_Lists.js?v=<?php $this->print_("WEI_0200Version",$TPL_SCP,1);?>"></script>
<?php $this->print_("footer",$TPL_SCP,1);?>