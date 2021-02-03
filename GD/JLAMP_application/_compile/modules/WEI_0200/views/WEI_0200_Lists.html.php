<?php /* Template_ 2.2.6 2019/03/08 15:16:45 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/modules/WEI_0200/views/WEI_0200_Lists.html 000014482 */ ?>
<!DOCTYPE HTML>
<html>
<head>
    <title>
        yudo erp
    </title>
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!--css-->
    <link rel="stylesheet" href="/css/yudo-ui.css?v=1083">
    <link rel="stylesheet" href="/css/mui.min.css?v=1008">
    <link rel="stylesheet" href="/css/mui.picker.min.css">
    <link rel="stylesheet" href="/css/animate.min.css">
    <!--jquery vue-->
    <script type="text/javascript" src="/third_party/jquery-2.1.4/jquery.js"></script>
    <script>var jq = $.noConflict();</script>
    <script src="/js/vue.js"></script>
    <!--mui echarts multi fastclick-->
    <script src="/js/mui.min.js?v=1001"></script>
    <script src="/js/multiHttp.js?v=1003"></script>
    <script src="/js/echarts.min.js"></script>
    <script src="/js/lang.min.js?v=1001"></script>
    <script src="/js/mui.previewimage.js?v=201804261256"></script>
    <script src="/js/mui.zoom.js?v=201804231454"></script>
    <script src="/js/mui.picker.min.js?v=1001"></script>
    <script type="text/javascript" src="/js/fastclick.js"></script>
    <!--jlamp-->
    <script type="text/javascript" src="/js/JLAMP.polyfill.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.common.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.menu.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.autobinding.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.modal.min.js"></script>
    <script type="text/javascript" src="/js/JLAMP.lang.min.js"></script>
    <script type="text/javascript" src="/js/session.js"></script>
    <script type="text/javascript" src="/js/version.js?v=20180920001"></script>

    <script type="text/javascript" src="/js/common.js"></script>
    <script type="text/javascript" src="/js/GNB.js"></script>
    <style type="text/css">
        .yudo-window{
            animation-duration: 0.4s
        }
        .yudo-window-trans{
            animation-duration: 0.2s
        }

    </style>
</head>
<body>
<div class="yudo-content" id="leon">
    <div class="download-script" v-if="view.downLoadScript"></div>
        <div class="yudo-window" v-if="view.viewTargetMinute">
            <div class="header-ios">
                <div class="header-body">
                    <div class="header-left-btn" id="backMenu">
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
                <!--<div class="info-class">-->
                    <!--<div class="info-body">-->
                        <!--<div v-bind:class="yearItem" j-word-label="W2018102617000591392" @click="changeInfoItem(0)">$((lang.year))</div>-->
                        <!--<div v-bind:class="monthItem" j-word-label="G2018102617002367015" @click="changeInfoItem(1)">$((lang.month))</div>-->
                        <!--<div v-bind:class="dayItem" j-word-label="G2018102617005914777" @click="changeInfoItem(2)">$((lang.day))</div>-->
                    <!--</div>-->
                <!--</div>-->
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
                        <button class="mui-btn noborder" style="font-size: 16px;line-height: 100%" @click="getResults()" j-word-label="W2018082711232500387">
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
                            <div v-if="view.resultsNoData" :key="1" class="nodata" j-word-label="W2018062810475725084" >$((lang.nodata))</div>
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
                                            <div id="chartSZ" style="position: absolute;bottom:-25px;height: 50px;width: 100%;justify-content: space-around;" class="flex yudo-animate-rotate">
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
                                            <div id="chartGD" style="position: absolute;bottom:-25px;height: 50px;width: 100%;justify-content: space-around;" class="flex yudo-animate-rotate">
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
                                            <div id="chartQD" style="position: absolute;bottom:-25px;height: 50px;width: 100%;justify-content: space-around;" class="flex yudo-animate-rotate">
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

</div>
<script src="/js/WEI_0200/WEI_0200_Lists.js?v=1081"></script>
</body>
</html>