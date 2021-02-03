<?php /* Template_ 2.2.6 2019/04/04 18:14:32 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/views/MenuView/Menu.html 000010981 */ ?>
<?php $this->print_("yudoHeaderStart",$TPL_SCP,1);?>

<?php $this->print_("yudoCss",$TPL_SCP,1);?>

<?php $this->print_("yudoJs",$TPL_SCP,1);?>

<?php $this->print_("yudoHeaderEnd",$TPL_SCP,1);?>

    <style type="text/css">
        #image{
            animation-duration: 0.2s
        }
        .yudo-window{
            animation-duration: 0.4s
        }
        .yudo-window-trans{
            animation-duration: 0.2s
        }
    </style>
</head>
<body>
<!-- 侧滑导航根容器 -->
<div class="mui-off-canvas-wrap  mui-slide-in" id="leon">
    <!-- 菜单容器 -->
    <aside class="mui-off-canvas-left" >
        <div class="mui-scroll-wrapper" style="background-color: #f9f9f9">
            <div class="mui-scroll">
                <div class="userMenu-top">
                    <div class="userMenu-userInfo">
                        <div class="headPortrait">
                            <img src="/image/fonticon/headDefault.jpg">
                        </div>
                        <div class="info-console-refresh" @click="getLoginInfo(1)">
                            <div class="icon-refresh" ></div>
                        </div>
                        <div class="userName">
                            <div class="name long">$((input.userNm))</div>
                            <div class="group long">$((input.groupNm))</div>
                            <div class="jobNumber long">$((input.userId))</div>
                        </div>
                        <div class="accountNumber long">$((lang.userNm))：$((input.userLoginId))</div>
                    </div>
                </div>
                <div class="userMenu-body">
                    <div class="userMenu-list-item active" @click="closeUserMenu()" >
                        <div class="icon-home" style="margin-right:30px"></div><div class="userMenu-list-text" style="line-height: 24px">$((lang.menu))</div>
                    </div>
                    <div class="userMenu-list-item" @click="gotoChangePassWd()">
                        <div class="icon-switchPass" style="margin-right:30px"></div><div class="userMenu-list-text" style="line-height: 24px">$((lang.changePassWd))</div>
                    </div>
                    <div class="userMenu-list-item" @click="logout()">
                        <div class="icon-quit" style="margin-right:30px"></div><div class="userMenu-list-text" style="line-height: 21px">$((lang.logout))</div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <!-- 主页面容器 -->
    <div class="mui-inner-wrap">
        <div class="yudo-content" style="background: #313131">
            <div class="download-script" v-if="view.downLoadScript"></div>
            <div class="yudo-window">
                <div class="header-ios" style="height: 120px;position: relative;z-index: 1">
                    <div class="header-body">
                        <div class="header-left-btn"  style="left: 0;padding-top: 7px" @click="showUserMenu()">
                            <div class="left-icon icon-userMenu" style="margin-top: 3px"></div>
                            <div class="left-head-portrait">
                                <img src="/image/fonticon/headDefault.jpg">
                            </div>
                        </div>
                        <div class="header-center-btn" ><img id="imgTopLogo" src="/image/login_logo.png" border="0" alt="top logo" style="width: 120px;margin-top: -2px" class="topLogo"></div>
                        <!--<div class="header-right-btn">-->
                        <!--<div class="right-icon icon-extend"></div>-->
                        <!--</div>-->
                    </div>
                    <div style="width: 100%;padding: 10px 10px 15px 10px;position: absolute;top: 50px;z-index: 5">
                        <!--box-shadow:0px 1px 5px #686868;-->
                        <div class="mui-slider" id="image" style="border-radius: 6px;height: 150px;box-shadow:0px 1px 5px #8c8c8c">
                            <div class="mui-slider-group mui-slider-loop">
                                <!--支持循环，需要重复图片节点-->
                                <div class="mui-slider-item mui-slider-item-duplicate"><img src="/image/yudo-03.png" /></div>
                                <div class="mui-slider-item"><img src="/image/yudo-01.png" /></div>
                                <div class="mui-slider-item"><img src="/image/yudo-02.png" /></div>
                                <div class="mui-slider-item"><img src="/image/yudo-03.png" /></div>
                                <div class="mui-slider-item mui-slider-item-duplicate"><img src="/image/yudo-01.png" /></div>
                            </div>
                            <div class="mui-slider-indicator">
                                <div class="mui-indicator mui-active"></div>
                                <div class="mui-indicator"></div>
                                <div class="mui-indicator"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="center-ios" id="centerControl" style="padding-top: 110px;border-radius: 15px;overflow-y: auto;position: absolute;top: 120px;bottom: 0;background: white;padding-bottom: 50px">

                    <ul class="mui-table-view" >
                        <li v-bind:class="css.menuPage[0]" >
                            <a class="mui-navigate-right" style="padding:0;" href="#">
                                <div class="header-title" v-on:tap="clickMenuPage(0)">
                                    <div class="sign"></div>
                                    <div class="info">$((lang.project1))</div>
                                </div>
                            </a>
                            <div class="mui-collapse-content" style="padding: 8px 5px;">
                                <div class="menu-list-item">
                                    <div v-for="(item,index) in list.manageInfo" class="menu-list-body" :key="index">
                                        <div class="pre" v-for="(pre,lex) in list.manageInfo[index]" @click="gotoModule(pre.url)">
                                            <div v-bind:class="pre.icon" style="border-radius: 27.5px;margin: 0 auto"></div>
                                            <div class="title">$((pre.title))</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li v-bind:class="css.menuPage[1]">
                            <a class="mui-navigate-right "  style="padding:0;" href="#">
                                <div class="header-title" v-on:tap="clickMenuPage(1)">
                                    <div class="sign"></div>
                                    <div class="info">$((lang.project2))</div>
                                </div>
                            </a>
                            <div class="mui-collapse-content" style="padding: 8px 5px;">
                                <div class="menu-list-item">
                                    <div v-for="(item,index) in list.salesManage" class="menu-list-body" :key="index">
                                        <div class="pre" v-for="(pre,lex) in list.salesManage[index]" @click="gotoModule(pre.url)">
                                            <div v-bind:class="pre.icon" style="border-radius: 27.5px;margin: 0 auto"></div>
                                            <div class="title">$((pre.title))</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li v-bind:class="css.menuPage[2]">
                            <a class="mui-navigate-right " style="padding:0;" href="#">
                                <div class="header-title"  v-on:tap="clickMenuPage(2)">
                                    <div class="sign"></div>
                                    <div class="info">$((lang.project3))</div>
                                </div>
                            </a>
                            <div class="mui-collapse-content" style="padding: 8px 5px;">
                                <div class="menu-list-item">
                                    <div v-for="(item,index) in list.asManage" class="menu-list-body" :key="index">
                                        <div class="pre" v-for="(pre,lex) in list.asManage[index]" @click="gotoModule(pre.url)">
                                            <div v-bind:class="pre.icon" style="border-radius: 27.5px;margin: 0 auto"></div>
                                            <div class="title">$((pre.title))</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="yudo-footer">
                    - Mobile ERP GD -
                </div>
            </div>
        </div>
        <div class="mui-off-canvas-backdrop"></div>
    </div>
</div>

<script src="/js/Menu/Menu.js?v=<?php $this->print_("MenuVersion",$TPL_SCP,1);?>"></script>

<?php $this->print_("footer",$TPL_SCP,1);?>





<!-- nav -->

<!--<div id="slide_panel" style="padding-top:50px;">-->
    <!--<div id="wrapper">-->
        <!--<ul id="menu">-->
            <!--<li><a href="javascript:goMenu('mi')"><img id="miMenu" name="menu" class="alpha" src="/image/MI.png" border="0" alt="경영정보" /></a><span class="menu_link"><a href="#" j-word-label="W2018013116530787097">경영정보</a></span></li>-->
            <!--<li><a href="javascript:goMenu('sm')"><img id="smMenu" name="menu" class="alpha" src="/image/SM.png" border="0" alt="영업관리" /></a><span class="menu_link"><a href="#" j-word-label="W2018013116563319329">영업관리</a></span></li>-->
            <!--<li><a href="javascript:goMenu('asm')"><img id="asmMenu" name="menu" class="alpha" src="/image/ASM.png" border="0" alt="A/S관리" /></a><span class="menu_link"><a href="#" j-word-label="W2018013117025791081">A/S관리</a></span></li>-->
        <!--</ul>-->
        <!--<div class="content">-->
            <!--<ul id="mi" class="cateList hide">-->
            <!--</ul>-->
            <!--<ul id="sm" class="cateList hide">-->
            <!--</ul>-->
            <!--<ul id="asm" class="cateList hide">-->
            <!--</ul>-->
        <!--</div>-->
    <!--</div>-->
<!--</div>-->
<!--<script>-->
<!--</script>-->