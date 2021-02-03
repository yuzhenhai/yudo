<?php /* Template_ 2.2.6 2019/09/20 18:53:18 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/views/SalesBusinessView/WEI_2500_Lists.html 000050093 */ ?>
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
                <div class="header-center-btn">$((lang.quote))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="menus">
                <button @click="showQueryQuote()" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-search btn-icon"></div><span>$((lang.quoteSearch))</span></span>
                </button>
                <button @click="showAddQuote()" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-write btn-icon"></div><span >$((lang.quoteAdd))</span></span>
                </button>
            </div>
        </div>
        <div class="yudo-footer">
            YUDO ERP
        </div>
    </div>
    <div v-if="view.showQueryQuote" class="yudo-window-trans animated fadeInRight trans-1">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="hideQueryQuote" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.quoteSearch))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;">
            <div class="screen" style="padding: 6px 5px">
                <div class="screen-power flex-left" @click="view.showQuoteScreen = !view.showQuoteScreen">
                    <div class="text">$((lang.screen))</div>
                    <div class="icon-xiala screen-power-select"></div>
                </div>
                <div class="input-border" style="margin-right: 5px">
                    <input type="text" v-model="input.quoteNo" :placeholder="lang.quoteNo" class="yudo-input noborder">
                </div>
                <button class="yudo-btn-white screen-pro" @click="searchQuote()" style="width: 80px; font-size: 15px;">$((lang.search))</button>
                <div class="heng-line "></div>
            </div>
            <div v-if="view.showQuoteScreen" class="screen-body">
                <div class="screen-body-pro">
                    <div class="flex-left input">
                        <div style="width: 30%" class="screen-pro">$((lang.date))</div>
                        <div class="flex-left" style="width: 100%">
                            <div class="input-border" style="margin-right: 5px">
                                <input @click="getInputDate('quoteStartDate')" name="fastclick" onfocus="this.blur();"  v-model="input.quoteStartDate" type="text"   class="yudo-input noborder screen-pro">
                            </div>
                            <div class="input-border" style="margin-right: 5px">
                                <input @click="getInputDate('quoteEndDate')" name="fastclick" onfocus="this.blur();"  v-model="input.quoteEndDate" type="text"  class="yudo-input noborder screen-pro">
                            </div>
                        </div>
                    </div>
                    <div class="flex-left input">
                        <div  class="screen-pro" style="width: 30%;">$((lang.custNm))</div>
                        <div class="input-border" style="margin-right: 5px">
                            <input type="text" v-model="input.custNm" class="yudo-input noborder screen-pro">
                        </div>
                    </div>
                    <div class="screen-body-submit flex">
                        <button class="yudo-btn-default clear" @click="clearQuoteScreen()" >$((lang.roback))</button>
                        <button class="yudo-btn-default submit" @click="searchQuote()">$((lang.confirm))</button>
                    </div>
                </div>
                <div class="screen-body-bottom" @click="view.showQuoteScreen = !view.showQuoteScreen">
                </div>
            </div>
            <div class="info-minute scroll" style="top:100px;">
                <div class="minute-project">
                    <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in list.quotelist" @click="chooseQuote(index)">
                        <div class="minute-body" style="height: 115px">
                            <div class="tr">
                                <div CHN="报价单编号" class="title len-10">$((lang.quoteNo)):$((item.QuotNo))<span v-html="$options.filters.statusViewChange(item.Status)"></span></div>
                            </div>
                            <div class="tr">
                                <div class="len-10 long">$((lang.custNm)):$((item.CustNm))</div>
                            </div>
                            <div class="tr">
                                <div class="len-10 long">$((lang.goodNmM)):$((item.GoodNm))</div>
                            </div>
                            <div class="tr flex-left">
                                <div class="len-5 long">$((lang.quoteAmt)):$((item.QuotAmt | toFix2))</div>
                                <div class="font-right len-5 long">$((lang.pronM)):$((item.DeptNm)) $((item.EmpNm))</div>
                            </div>
                            <div class="tr flex-left">
                                <div class="len-5 long">$((lang.quoteDate)):$((item.QuotDate | date))</div>
                                <div class="font-right len-5 long">$((lang.validDateM)):$((item.ValidDate | date))</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-if="view.noData" class="nodata" >$((lang.noData))</div>
                <div v-if="view.pullMore" class="pull-more" @click="pullQuoteMore" >$((lang.pullMore))</div>
            </div>
        </div>
    </div>
    <div v-if="view.showAddQuote" class="yudo-window-trans animated fadeInRight trans-1">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="view.showAddQuote = !view.showAddQuote" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn">$((view.quoteAddTitle))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;">
            <div class="yudo-scroll">
                <div class="area">
                    <div class="title flex-left">
                        <div class="len-3">$((lang.defaultInfo))</div>
                        <div class="len-7 flex-right">
<!--                            <button class="yudo-btn-primary long" style="height: 25px;width: 100px;margin-right: 10px" @click="subAdjudication()">$((lang.subAdjudication))</button>-->
<!--                            <button class="yudo-btn-primary long" style="height: 25px;width: 100px;" @click="unSubAdjudication()">$((lang.unSubAdjudication))</button>-->
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.quoteNo))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="write.QuotNo" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.quoteDate))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text"  @click="getWriteDate('QuotDate')"  readonly="true" v-model="write.QuotDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.delvDate))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text"  @click="getWriteDate('DelvDate')" readonly="true" v-model="write.DelvDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.pronM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" @click="showEmpy()" v-model="write.DeptNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                        <div class="input-tr-body" style="margin-left: 10px">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" @click="showEmpy()" v-model="write.EmpNm"  class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.quoteType))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.QuotType" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.quoteTypelist ">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.validDateM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" @click="getWriteDate('ValidDate')" readonly="true" v-model="write.ValidDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.status))</span></div>
                        <div class="input-tr-body">
                            <div class="yudo-span">
                                <span style="font-size: 14px;padding: 5px 10px" class="yudo-label label-primary">$((write.Status | statusChange))</span>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.delvDateChoose))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.DelvLimit" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.delvDatelist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.delvMethodM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.DelvMethod" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.delvMethodlist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span>$((lang.countryM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.Nation" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.countrylist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="title">$((lang.custInfo))</div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.custNm))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" @click="showCust(0)" v-model="write.CustNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.customerNmM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" @click="showCust(1)" v-model="write.CustomerNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.agentNmM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" @click="showCust(2)" v-model="write.AgentNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.shipToNmM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" @click="showCust(3)" v-model="write.ShipToNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.MakerNmM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" readonly="true" @click="showCust(4)" v-model="write.MakerNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.custPron))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text"  :readonly="view.confirm"  v-model="write.CustPrsn" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.custFaxM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.CustFax" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.custTel))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.CustTel" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.custPron)).HP</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.CustPrsnHP" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.custEmail))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.CustEmail" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span>$((lang.custRemarkM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.CustRemark" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="title">$((lang.produceInfo))</div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.goodClassM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.GoodClass" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.goodClasslist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.resinM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.Resin" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.productModel))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm"  v-model="write.GoodNm" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.RefNo))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.RefNo" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>Market Name</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.MarketCd" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro" @change="getProductList(write.MarketCd)">
                                    <option :value="item.value" v-for="(item,index) in list.marketNmlist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>Product Name</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.PProductCd" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro" @change="getPartList(write.PProductCd)">
                                    <option :value="item.value" v-for="(item,index) in list.productlist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>Part Name</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.PPartCd" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.partlist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>part description</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm"  v-model="write.PartDesc" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.goodSpecM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.GoodSpec" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.srvAreaM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.SrvArea" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.srvArealist">$((item.text))</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span>$((lang.drawNoM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.QuotDrawNo" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="title">$((lang.quoteAmt))</div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.currCd))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.CurrCd" :disabled="view.confirm" @change="getCurrRate()" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.currency">$((item.value))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.currRateM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="select-btn" style="top: 1px;">%</div>
                                <input type="text" readonly="true" v-model="write.CurrRate" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.ProposeAmtM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="select-btn"  style="top: 1px">$((lang.yuan))</div>
                                <input type="text" :readonly="view.confirm" v-model="write.ProposeAmt" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.quoteAmt))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="select-btn" style="top: 1px">$((lang.yuan))</div>
                                <input type="text" readonly="true" v-model="write.QuotAmt" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.quotVatM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="select-btn" style="top: 1px">$((lang.yuan))</div>
                                <input type="text" readonly="true" v-model="write.QuotVat" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.paymentM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.Payment" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span>$((lang.disCountRateM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="select-btn"  style="top: 1px;">%</div>
                                <input type="text" :readonly="view.confirm" v-model="write.DisCountRate" v-on:input="disCountRateChange()" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="title">$((lang.other))</div>
                    <div class="input-tr" style="margin-bottom: 10px">
                        <div class="input-tr-title-textarea long"><span>$((lang.Remarks))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" :readonly="view.confirm" v-model="write.Remark" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>Revision No</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.QuotAmd" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.printClassM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="write.PrintGubun" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.printClasslist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.saleVatRateM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="select-btn" style="top: 1px;">%</div>
                                <input type="text" :readonly="view.confirm" v-model="write.SaleVatRate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.miOrderRemarkM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="write.MiOrderRemark" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.asId))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="write.ASRecvNo" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span>$((lang.confirm))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="confirm" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span>$((lang.printAmtM))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="printAmt" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span>$((lang.vatYnM))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="payTax" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span>$((lang.OverseaYnM))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="tranUntrust" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title long"><span>$((lang.ASYnM))</span></div>
                        <div class="input-tr-body">
                            <div class="mui-switch" id="AS" >
                                <div class="mui-switch-handle"></div>
                            </div>
                        </div>
                    </div>
                    <div class="title flex-left">
                        <div class="len-3">$((lang.minuteInfo))</div>
                        <div class="len-7 flex-right">
                            <button class="yudo-btn-primary long" style="height: 25px;width: 140px;margin-right: 10px" @click="addServiceCharge()">$((lang.addWorldAmt))</button>
                            <button class="yudo-btn-primary long" style="height: 25px;width: 80px;margin-right: 10px" @click="showAsRecv()">$((lang.info))AS</button>
                            <div class="mui-icon mui-icon-plus" @click="addItemInfo()"></div>
                        </div>
                    </div>
                    <div class="cell-tr">
                        <ul class="mui-table-view" style="text-align: left;">
                            <li class="mui-table-view-cell" v-for="(item,index) in list.itemlist" >
                                <div class="mui-slider-right mui-disabled">
                                    <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:click="delItem(index,$event)" >$((lang.Delete))</a>
                                </div>
                                <div class="mui-slider-handle flex-left" style="transform: translate(0px, 0px);"  @click="showItemInfo(index)">
                                    <div class="yudo-label label-primary">$((item.Sort))</div>
                                    &nbsp;&nbsp;
                                    <div style="padding-right: 15px;width: 90%" class="long">$((item.ItemNm))</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div v-on:click="setQuoteInfo()" class="yudo-btn" >$((lang.save))</div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="view.showQueryItem" class="yudo-window-trans animated fadeInRight trans-1">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="view.showQueryItem = !view.showQueryItem" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.minuteInfo))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;">
            <div class="yudo-scroll">
                <div class="area">
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>NO</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="item.Sort" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.catalogueCode))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" @click="showItem()" readonly="true" v-model="item.ItemNo" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.catalogueName))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="pop-modal-power"><span class="mui-icon mui-icon-more"></span></div>
                                <input type="text" @click="showItem()" readonly="true" v-model="item.ItemNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.specifications))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="item.Spec" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.unit_mobile))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="item.UnitCd" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value"  v-for="(item,index) in list.unitlist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long color-red"><span>$((lang.number))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="number" :readonly="view.confirm" v-model="item.Qty" v-on:input="itemQtyChange()" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.stdPriceM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="item.StdPrice" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.disCountRateM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="select-btn" style="top: 1px;">%</div>
                                <input type="text"  :readonly="view.confirm" v-model="item.DCRate" v-on:input="itemDCRateChange()" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.dCPriceM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="number" :readonly="view.confirm" v-model="item.DCPrice" v-on:input="itemDCPriceChange()" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.dcAmtM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="item.DCAmt" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.dcVatM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm" v-model="item.DCVat" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.Remarks))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" :readonly="view.confirm"  v-model="item.Remark" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.countryM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <div class="icon-xiala select-btn"></div>
                                <select v-model="item.Nation" :disabled="view.confirm" type="text" class="yudo-input noborder screen-pro">
                                    <option :value="item.value" v-for="(item,index) in list.itemCountrylist">$((item.text))</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.vatYnM))</span></div>
                        <div class="input-tr-body">
                            <div class="yudo-span">
                                <span style="font-size: 14px;padding: 2px 5px" class="yudo-label label-primary">$((item.VatYn | vatChange))</span>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.presentStock))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="item.PreStockQty" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.carryQuantity))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="item.NextQty" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.Pausenumber))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="item.StopQty" class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div v-on:click="setItemInfo()" class="yudo-btn" >$((lang.add))</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->print_("popEmpyModal",$TPL_SCP,1);?>

<?php $this->print_("popCustModal",$TPL_SCP,1);?>

<?php $this->print_("popItemModal",$TPL_SCP,1);?>

<?php $this->print_("popAsRecvModal",$TPL_SCP,1);?>

<script src="/js/WEI_2500/WEI_2500_Lists.js?v=<?php $this->print_("WEI_2500Version",$TPL_SCP,1);?>"></script>
<?php $this->print_("footer",$TPL_SCP,1);?>