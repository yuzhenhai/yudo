<?php /* Template_ 2.2.6 2019/09/20 18:54:09 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/views/SalesBusinessView/WEI_2400_Lists.html 000020307 */ ?>
<?php $this->print_("yudoHeaderStart",$TPL_SCP,1);?>

<?php $this->print_("yudoCss",$TPL_SCP,1);?>

<style type="text/css">
    .yudo-window{
        animation-duration: 0.4s
    }
    .yudo-window-trans{
        animation-duration: 0.2s
    }
</style>
<?php $this->print_("yudoJs",$TPL_SCP,1);?>

<?php $this->print_("yudoHeaderEnd",$TPL_SCP,1);?>

<div class="yudo-content" id="leon">
    <div class="download-script" v-if="view.downLoadScript"></div>
    <div class="yudo-menu" v-show="view.menu">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" onclick="multi.backMenu()">
                    <div class="left-icon icon-backmenu"></div>
                    <div class="left-text">$((lang.menuBack))</div>
                </div>
                <div class="header-center-btn">$((lang.productDateM))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="menus">
                <button @click="showProductQuery()" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-search btn-icon"></div><span >$((lang.productQuery))</span></span>
                </button>
            </div>
        </div>
        <div class="yudo-footer">
            YUDO ERP
        </div>
    </div>
    <div v-if="view.showProductQuery" style="z-index: 200" class="yudo-window-trans animated fadeInRight trans-1">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="hideProductQuery" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.productQuery))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;">
            <div class="screen" style="padding: 6px 5px">
                <div class="screen-power flex-left" @click="view.showProductQueryScreen = !view.showProductQueryScreen">
                    <div class="text">$((lang.screen))</div>
                    <div class="icon-xiala screen-power-select"></div>
                </div>
                <div class="input-border" style="margin-right: 5px">
                    <input type="text" @click="searchDate()" readonly="true" v-model="input.productQueryDate" class="yudo-input noborder">
                </div>
                <button class="yudo-btn-white screen-pro" @click="searchProduct()" style="width: 80px; font-size: 15px;">$((lang.search))</button>
                <div class="heng-line screen-pro"></div>
            </div>
            <div v-if="view.showProductQueryScreen" class="screen-body">
                <div class="screen-body-pro">
                    <div class="flex-left input">
                        <div class="screen-pro" style="width: 30%;">$((lang.accordingClass))</div>
                        <div class="input-border" style="margin-right: 5px">
                            <div class="icon-xiala select-btn"></div>
                            <select v-model="input.accordingClass" type="text" class="yudo-input noborder screen-pro">
                                <option :value="item.value" v-for="(item,index) in list.accordingClass">$((item.text))</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex-left input">
                        <div class="screen-pro" style="width: 30%;">$((lang.accordingNo))</div>
                        <div class="input-border" style="margin-right: 5px">
                            <input type="text" v-model="input.accordingNo" class="yudo-input noborder screen-pro" >
                        </div>
                    </div>
                    <div class="flex-left input">
                        <div  class="screen-pro" style="width: 30%;">$((lang.custNm))</div>
                        <div class="input-border" style="margin-right: 5px">
                            <input type="text" v-model="input.custNm" class="yudo-input noborder screen-pro">
                        </div>
                    </div>
                    <div class="flex-left input">
                        <div  class="screen-pro" style="width: 30%;">$((lang.RefNo))</div>
                        <div class="input-border" style="margin-right: 5px">
                            <input type="text" v-model="input.RefNo" class="yudo-input noborder screen-pro">
                        </div>
                    </div>
                    <div class="screen-body-submit flex">
                        <button class="yudo-btn-default clear" @click="clearProductQueryScreen()" >$((lang.roback))</button>
                        <button class="yudo-btn-default submit" @click="searchProduct()">$((lang.confirm))</button>
                    </div>
                </div>
                <div class="screen-body-bottom" @click="view.showProductQueryScreen = !view.showProductQueryScreen">
                </div>
            </div>
            <div id="mui_pushas" class="info-minute scroll" style="top:100px;">
                <div class="minute-project">
                    <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in list.productDate" v-on:click="setProduct(index);">
                        <div class="minute-body" style="height: 95px">
                            <div class="tr flex">
                                <div class="title">$((lang.accordingNo)):$((item.SourceNo)) <span v-html="$options.filters.specTypeChange(item.SourceType)"></span></div>
                                <!--<div style="float: left"><span v-html="$options.filters.confirmChange(item.CfmYn)"></span></div>-->
                                <!--<div><span v-html="$options.filters.specTypeChange(item.SourceType)"></span></div>-->
                            </div>
                            <div class="tr flex">
                                <div class="len-5 long">$((lang.WDelvDateM)):$((item.WDelvDate | date)) <span class="yudo-label label-transparent">$((item.ModifyCnt))</span> </div>
                                <div class="right-text">$((lang.OutDateM)):$((item.OutDate | dateHi | farmIsNull))</div>
                            </div>
                            <div class="tr flex">
                                <div class="len-7 long" style="margin-right: 10px">$((lang.custNm)):$((item.CustNm))</div>
                                <div class="right-text long">$((lang.RefNo)):$((item.RefNo | farmIsNull))</div>
                            </div>
                            <div class="tr">
                                <div class="len-5 long left-text ">$((lang.sendDate)):$((item.DelvDate | date))</div>
                                <div class="right-text">$((lang.pronM)):$((item.DeptNm)) $((item.EmpNm))</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-flow-more" v-show="view.loading">
                    <i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px">
                    </i>
                    <div class="doc-icon-name">loading</div>
                </div>
                <div class="nodata" v-show="view.noData">no data</div>
            </div>
            <!--<div id="mui_pushas" class="info-minute scroll" style="top: 100px;">-->
                <!--<div class="minute-project"></div>-->
                <!--<div class="layui-flow-more" style="display: none;">-->
                    <!--<i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 25px;"></i>-->
                    <!--<div class="doc-icon-name">loading</div>-->
                <!--</div> <div j-word-label="W2018062810475725084" class="layui-flow-more" style="display: none;">没有更多了</div>-->
            <!--</div>-->
        </div>
    </div>
    <div v-if="view.showProductInfo" style="z-index: 201" class="yudo-window-trans animated fadeInRight trans-2">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="hideProductInfo" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.productNo))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;">
            <div class="area">
                <div class="title">$((lang.defaultInfo))</div>
                <div class="input-tr">
                    <div class="input-tr-title long"><span>$((lang.accordingNo))</span></div>
                    <div class="input-tr-body" style="margin-right: 10px">
                        <div class="input-border">
                            <input readonly="true" type="text" class="yudo-input noborder" v-model="write.SourceNo">
                        </div>
                    </div>
                    <div class="input-tr-body" style="width: 70px;padding-top: 1px;flex-shrink: 0">
                            <span v-html="$options.filters.specTypeChangeW(write.SourceType)"></span>
                    </div>
                </div>


                <div class="input-tr">
                    <div class="input-tr-title long"><span>$((lang.custNm))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.CustNm" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long"><span>$((lang.accordingClass))</span></div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<span v-html="$options.filters.specTypeChangeW(write.SourceType)"></span>-->
                    <!--</div>-->
                <!--</div>-->
                <div v-if="view.orderProduct" class="input-tr">
                    <div class="input-tr-title long"><span>$((lang.orderDate))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.OrderAsDate" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div v-if="view.asProduct" class="input-tr">
                    <div class="input-tr-title long"><span>$((lang.asDelvDate))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.OrderAsDate" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><span>$((lang.sendDate))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.DelvDate" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><span>$((lang.pronM))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.DeptNm" class="yudo-input noborder">
                        </div>
                    </div>
                    <div class="input-tr-body" style="margin-left: 10px">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.EmpNm" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <!--<div class="input-tr">-->
                    <!--<div class="input-tr-title long"><span>$((lang.deptNm))</span></div>-->
                    <!--<div class="input-tr-body">-->
                        <!--<div class="input-border">-->
                            <!--<input type="text" readonly="true" v-model="write.DeptNm" class="yudo-input noborder">-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->
                <div class="input-tr" style="margin-bottom: 10px">
                    <div class="input-tr-title long"><span>$((lang.RefNo))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.RefNo" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="title">$((lang.productInfo))</div>
                <div class="input-tr">
                    <div class="input-tr-title long"><span>$((lang.WPlanDateM))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <!--<div class="icon-xiala select-btn"></div>-->
                            <input type="text" readonly="true" readonly="true" v-model="write.WkAptDate"  class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><span>$((lang.WCDelvDateM2))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <!--<div class="icon-xiala select-btn"></div>-->
                            <input type="text" readonly="true" readonly="true" v-model="write.WPlanCfmDate"  class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="input-tr" >
                    <div class="input-tr-title long"><span>$((lang.WDelvDateM))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.WDelvDate" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="input-tr">
                    <div class="input-tr-title long"><span>$((lang.changeCnt))</span></div>
                    <div class="input-tr-body">
                        <div class="yudo-span">
                            <span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary">$((write.ModifyCnt))</span>
                            <span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary-light">$((write.WDelvChUptDate))</span>
                        </div>
                        <!--<span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary">$((write.ModifyCnt))</span>-->
                        <!--<span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary-light">$((write.WDelvChUptDate))</span>-->
                    </div>
                </div>
                <div class="input-tr" style="margin-bottom: 10px">
                    <div class="input-tr-title-textarea long"><span>$((lang.WDelvChRemarkM))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border-textarea">
                            <textarea type="text" readonly="true" v-model="write.WDelvChRemark" class="yudo-textarea noborder"></textarea>
                        </div>
                    </div>
                </div>
                <div class="title">$((lang.deviseInfo))</div>
                <div class="input-tr">
                    <div class="input-tr-title long" style="flex-shrink: 0;"><span>$((lang.drawNo))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.DrawNo" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="input-tr" style="margin-bottom: 10px">
                    <div class="input-tr-title long"><span>$((lang.drawDelvDate))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.DrawDate" class="yudo-input noborder">
                        </div>
                    </div>
                </div>
                <div class="input-tr" style="margin-bottom: 10px">
                    <div class="input-tr-title long"><span>$((lang.OutDateM))</span></div>
                    <div class="input-tr-body">
                        <div class="input-border">
                            <input type="text" readonly="true" v-model="write.OutDate" class="yudo-input noborder">
                        </div>
                    </div>
                </div>

                <div class="title">$((lang.farmInfo))</div>
                <ul class="mui-table-view">
                    <li class="mui-table-view-cell" v-for="(item,index) in list.productFarm" style="padding: 5px 20px 5px 25px">
                        <div class="flex-left" style="padding-left: 5px;font-size: 15px;height: 25px;width:100%">
                            <!--<div class="yudo-label label-primary" style="font-size: 15px;padding: 0 7px">$((index | zero))</div>-->
                            <div class="sign" style="margin-right: 10px"></div>
                            <!--<div>$((item.DeptNm))</div>-->
                            <div>$((item.WCNm))</div>
                        </div>
                        <div class="flex-left" style="padding-left: 10px;font-size: 12px;height: 25px;width:100%">
                            <div class="len-5 long" style="margin-left: 10px">$((lang.WCDelvDateM)):$((item.WCDelvDate | date | farmIsNull))</div>
                            <div class="len-5 long" style="margin-left: 10px">$((lang. WCStartDateM)):$((item.WCStartDate | dateHi | farmIsNull))</div>
                        </div>
                        <div class="flex-left" style="padding-left: 10px;font-size: 12px;height: 25px;width:100%">
                            <div class="len-5 long" style="margin-left: 10px">$((lang.WCEndDateM)):$((item.WCEndDate | dateHi | farmIsNull))</div>
                            <div class="len-5 long" style="margin-left: 10px">$((lang.QCDateM)):$((item.QCDate | dateHi | farmIsNull))</div>
                        </div>
                    </li>
                </ul>



            </div>
        </div>
    </div>
</div>

<script src="/js/WEI_2400/WEI_2400_Lists.js?v=<?php $this->print_("WEI_2400Version",$TPL_SCP,1);?>"></script>
<?php $this->print_("footer",$TPL_SCP,1);?>