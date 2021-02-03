<?php /* Template_ 2.2.6 2019/08/08 18:05:20 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/MenuView/ConnectRecord.html 000004087 */ ?>
<?php $this->print_("yudoHeaderStart",$TPL_SCP,1);?>

<?php $this->print_("yudoCss",$TPL_SCP,1);?>

<?php $this->print_("yudoJs",$TPL_SCP,1);?>

<?php $this->print_("yudoHeaderEnd",$TPL_SCP,1);?>

<div class="yudo-content" id="leon">
    <div class="download-script" v-if="view.downLoadScript"></div>
    <div class="yudo-window">
        <div class="header-ios">
            <div class="header-body">
                <div class="header-left-btn" onclick="multi.backMenu()">
                    <div class="left-icon icon-backmenu"></div>
                    <div class="left-text">$((lang.menuBack))</div>
                </div>
                <div class="header-center-btn" >$((lang.title))</div>
                <div class="header-right-btn">
                    <div class="right-icon icon-extend"></div>
                </div>
            </div>
        </div>
        <div class="center-ios" id="centerControl" style="background: white;">
            <div class="info-search" style="height:130px">
                <div class="info-search-input" style="width: 71%">
                    <div class="write-input"  @click="getInputDate('date')" style="margin-top: 10px">
                        <div style="float:left;margin-top: 4px;display: inline-block;width: 25px;height: 25px" class="icon-date" ></div>
                        <div style="float:left;margin-top: 8px;margin-left: 15px;">$((input.date))</div>
                    </div>
                    <div class="write-input">
                        <div class="left-icon icon-expclass" style="height: 22px;width: 22px;top: 7px"></div>
                        <select v-model="input.db">
                            <option :value="item.value" v-for="(item,index) in list.db">$((item.text))</option>
                        </select>
                    </div>
                </div>
                <div class="search-btn" style="height: 90%;width: 29%;margin-top: 5px">
                    <button class="mui-btn noborder" style="font-size: 16px;line-height: 100%" @click="getData()" >
                        $((lang.search))
                    </button>
                </div>
            </div>
            <div class="info-minute">
                <div class="minute-header">
                    <div class="left-text" style="color: #212121;margin-top: 2px" >$((lang.dataMinute))</div>
                </div>
                <div class="minute-project" style="position: absolute;top:220px;bottom: 0">
                    <div class="minute-table" style="height: 100%">
                        <div v-if="view.noData" class="nodata" >$((lang.nodata))</div>
                        <div class="minute-list" style="border-bottom: 5px solid #f9f9f9;" v-for="(item,index) in list.recordlist" >
                            <div class="minute-body" style="font-weight: 700;height: 80px;padding: 5px 10px" >
                                <div class="minute-body-title" >$((item.EmpNm)) $((item.DeptNm))</div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long" style="width: 40%;">FormId:$((item.form_name))</div>
                                    <div class="minute-body-td long" style="width: 40%;">FormNm:$((item.form_id))</div>
                                </div>
                                <div class="minute-body-th">
                                    <div class="minute-body-td long" style="width: 40%">Date:<span style="font-weight: 700">$((item.login_time | dateHis)) $((item.log_pc))</span> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/Menu/ConnectRecord.js?v=1002"></script>
<?php $this->print_("footer",$TPL_SCP,1);?>