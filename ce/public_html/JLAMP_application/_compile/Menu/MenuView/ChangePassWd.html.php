<?php /* Template_ 2.2.6 2019/08/02 15:30:40 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/MenuView/ChangePassWd.html 000002938 */ ?>
<?php $this->print_("yudoHeaderStart",$TPL_SCP,1);?>

<?php $this->print_("yudoCss",$TPL_SCP,1);?>

<?php $this->print_("yudoJs",$TPL_SCP,1);?>

<?php $this->print_("yudoHeaderEnd",$TPL_SCP,1);?>

    <div class="yudo-content" id="leon">
        <div class="download-script" v-if="view.downLoadScript"></div>
        <div class="yudo-content">
            <div class="header-ios">
                <div class="header-body">
                    <div class="header-left-btn" onclick="multi.backMenu()">
                        <div class="left-icon icon-back-2"></div>
                        <div class="left-text"></div>
                    </div>
                    <div class="header-center-btn" ><img id="imgTopLogo" src="/image/login_logo.png" border="0" alt="top logo" style="width: 120px;margin-top: -2px" class="topLogo"></div>
                </div>
            </div>
            <div class="center-ios">
                <div style="height: 200px;width: 100%;padding: 70px 30px 0 30px">
                    <div class="input-tr-yuan">
                        <div class="input-tr-body" style="width: 100%">
                            <div class="input-border-yuan">
                                <input type="password" v-model="input.oldPassWd"  v-bind:placeholder="lang.oldPassWd"  class="yudu-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-yuan">
                        <div class="input-tr-body" style="width: 100%">
                            <div class="input-border-yuan">
                                <input type="password" v-model="input.newPassWd"  v-bind:placeholder="lang.newPassWd"  class="yudu-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr-yuan">
                        <div class="input-tr-body" style="width: 100%">
                            <div class="input-border-yuan">
                                <input type="password" v-model="input.newPassWd2" v-bind:placeholder="lang.newPassWd2"  class="yudu-input noborder" />
                            </div>
                        </div>
                    </div>
                    <div class="input-tr">
                        <div class="input-tr-body" style="width: 100%">
                            <button class="yudo-btn" @click="savePassWd()" j-word-label="W2007072616270984075">保存</button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
<script src="/js/Menu/ChangePassWd.js?v=1002"></script>
<?php $this->print_("footer",$TPL_SCP,1);?>