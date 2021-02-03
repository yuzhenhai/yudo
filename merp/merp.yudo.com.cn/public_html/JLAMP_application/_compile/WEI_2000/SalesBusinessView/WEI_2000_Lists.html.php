<?php /* Template_ 2.2.6 2019/08/16 18:40:30 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/SalesBusinessView/WEI_2000_Lists.html 000020046 */ ?>
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

<script src="/js/exif.js"></script>
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
                <div class="header-center-btn">$((lang.assmTrial))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios">
            <div class="menus">
                <button @click="showAssmReptAdd()" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-write btn-icon"></div><span >$((lang.addAssmRept))</span></span>
                </button>
                <button @click="showSearchAssmRept()" type="button" class="layui-btn layui-btn-primary menu-btn" style="padding-top: 2px">
                    <span style="position: relative"><div class="icon-search btn-icon"></div><span >$((lang.queryAssmRept))</span></span>
                </button>
            </div>
        </div>
        <div class="yudo-footer">
            YUDO ERP
        </div>
    </div>
    <div v-if="view.showAssmReptAdd" class="yudo-window-trans animated fadeInRight trans-1">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="view.showAssmReptAdd = !view.showAssmReptAdd" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.addAssmRept))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;padding-bottom: 50px">
            <div class="yudo-scroll">
                <div class="area">
                    <div class="title">$((lang.defaultInfo))</div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.orderNo))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input readonly="true" @click="showSearchOrder()" type="text" class="read-only yudo-input noborder" v-model="write.OrderNo">
                            </div>
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
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.orderDate))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="write.OrderDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.delvDate))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="write.DelvDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>System Type</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="write.SystemType" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.gateCnt))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="write.GateCnt" class="yudo-input noborder">
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
                    <div class="title">$((lang.assmRept))</div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.pronM))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" @click="showSearchEmpy()" v-model="write.DeptNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                        <div class="input-tr-body" style="margin-left: 10px">
                            <div class="input-border">
                                <input type="text" readonly="true" @click="showSearchEmpy()" v-model="write.EmpNm"  class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.assmReptNo))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" v-model="write.AssmReptNo" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.assmReptDate))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" @click="getDate('AssmReptDate')" readonly="true" v-model="write.AssmReptDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.assmDate))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" @click="getDate('AssmDate')" readonly="true" v-model="write.AssmDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title-textarea long"><span>$((lang.assmContents))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" v-bind:readonly="view.confirm"  v-model="write.AssmContents" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title-textarea long"><span>$((lang.remark))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" v-bind:readonly="view.confirm"  v-model="write.Remark" class="yudo-textarea noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.trialEmpNm))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" readonly="true" @click="showSearchTrialEmpy()" v-model="write.TrialDeptNm" class="read-only yudo-input noborder">
                            </div>
                        </div>
                        <div class="input-tr-body" style="margin-left: 10px">
                            <div class="input-border">
                                <input type="text" readonly="true" @click="showSearchTrialEmpy()" v-model="write.TrialEmpNm"  class="read-only yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-title long"><span>$((lang.trialDate))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border">
                                <input type="text" @click="getDate('TrialDate')" readonly="true" v-model="write.TrialDate" class="yudo-input noborder">
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-end">
                        <div class="input-tr-title-textarea long"><span>$((lang.trialContents))</span></div>
                        <div class="input-tr-body">
                            <div class="input-border-textarea">
                                <textarea type="text" v-bind:readonly="view.confirm"  v-model="write.TrialContents" class="yudo-input noborder"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="title">$((lang.salesInfo))</div>
                    <div class="cell-tr">
                        <ul class="mui-table-view" style="text-align: left;">
                            <li class="mui-table-view-cell" @click="showAssmSales()">
                                <a j-word-label="W2018041913292308342" class="mui-navigate-right">$((lang.salesPron))</a>
                            </li>
                        </ul>
                    </div>
                    <div class="title">$((lang.assmTrialPhoto))</div>
                    <div class="cell-tr">
                        <ul class="mui-table-view" style="text-align: left;">
                            <li class="mui-table-view-cell" @click="showAssmPhoto()">
                                <a  class="mui-navigate-right">$((lang.assmReptPhoto))</a>
                            </li>
                            <li class="mui-table-view-cell" @click="showTrialPhoto()">
                                <a  class="mui-navigate-right">$((lang.trialPhoto))</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div v-on:click="saveAssmReptInfo()" class="yudo-btn" >$((lang.save))</div>
                </div>
            </div>
        </div>


    </div>
    <div v-if="view.showAssmReptQuery"  class="yudo-window-trans animated fadeInRight trans-2">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="view.showAssmReptQuery = !view.showAssmReptQuery" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.queryAssmRept))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;">
        </div>
    </div>
    <div v-if="view.showAssmSales" class="yudo-window-trans animated fadeInRight trans-3">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="view.showAssmSales = !view.showAssmSales" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.salesPron))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;">
            <ul class="mui-table-view" style="text-align: left;">
                <li class="mui-table-view-cell mui-transitioning" v-for="(sale,index) in list.assmSales">
                    <div class="mui-slider-right mui-disabled">
                        <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:click="delSales(index,$event)" >$((lang.delete))</a>
                    </div>
                    <div class="mui-slider-handle" style="transform: translate(0px, 0px);">
                        <span class="yudo-label label-primary">$((index+1))</span>
                        <span>$((sale.EmpNm))</span>
                        <span>$((sale.DeptNm))</span>
                    </div>
                </li>
            </ul>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div v-on:click="addSales()" style="width: 100%;height: 38px;border-radius: 19px" class="yudo-btn" id="sales-add"   type="button">$((lang.add))</div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="view.showAssmPhoto"  class="yudo-window-trans animated fadeInRight trans-3">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="view.showAssmPhoto = !view.showAssmPhoto" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.assmReptPhoto))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;">
            <ul class="mui-table-view" style="text-align: left">
                <li class="mui-table-view-cell mui-transitioning" style="padding: 0" v-for="(photo,index) in list.assmPhoto">
                    <div class="mui-slider-right mui-disabled">
                        <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:click="delAssmPhoto(index,$event)" >$((lang.delete))</a>
                    </div>
                    <div class="mui-slider-handle" style="transform: translate(0px, 0px);">
                        <div style="margin: 0!important;" class="mui-content-padded">
                            <img style="height: 80px;width: 80px;max-width: 80px" class="mui-media-object mui-pull-left" :src="photo.imagedir" data-preview-src="" data-preview-group="1" >
                        </div>
                        <span style="line-height: 80px">$((photo.FileNm))</span>
                    </div>
                </li>
            </ul>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div style="width: 100%;height: 38px;border-radius: 19px" class="yudo-btn" >$((lang.upload))
                        <input class="input-file" type="file" id="uploadAssmPhoto" name="file" multiple="multiple" @change="uploadAssmPhoto" >
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div v-if="view.showTrialPhoto" class="yudo-window-trans animated fadeInRight trans-3">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" @click="view.showTrialPhoto = !view.showTrialPhoto" >
                    <div class="left-icon icon-back-2"></div>
                </div>
                <div class="header-center-btn" >$((lang.trialPhoto))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" style="background-color: white;">
            <ul class="mui-table-view" style="text-align: left">
                <li class="mui-table-view-cell mui-transitioning" style="padding: 0" v-for="(photo,index) in list.trialPhoto">
                    <div class="mui-slider-right mui-disabled">
                        <a class="mui-btn mui-btn-red" style="transform: translate(0px, 0px);" v-on:click="delTrialPhoto(index,$event)" >$((lang.delete))</a>
                    </div>
                    <div class="mui-slider-handle" style="transform: translate(0px, 0px);">
                        <div style="margin: 0!important;" class="mui-content-padded">
                            <img style="height: 80px;width: 80px;max-width: 80px" class="mui-media-object mui-pull-left" :src="photo.imagedir" data-preview-src="" data-preview-group="1" >
                        </div>
                        <span style="line-height: 80px">$((photo.FileNm))</span>
                    </div>
                </li>
            </ul>
            <div class="save-pro">
                <div class="save-pro-body flex-center">
                    <div style="width: 100%;height: 38px;border-radius: 19px" class="yudo-btn" id="photo-up" >$((lang.upload))
                        <input class="input-file"  type="file" id="uploadTrialPhoto" name="file" multiple="multiple" @change="uploadTrialPhoto" >
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/WEI_2000/WEI_2000_Lists.js?v=<?php $this->print_("WEI_2000Version",$TPL_SCP,1);?>"></script>
<?php $this->print_("popAssmReptModal",$TPL_SCP,1);?>

<?php $this->print_("popOrderModal",$TPL_SCP,1);?>

<?php $this->print_("popEmpyModal",$TPL_SCP,1);?>

<?php $this->print_("footer",$TPL_SCP,1);?>