<?php /* Template_ 2.2.6 2019/09/23 16:03:29 /home/merp.yudo.com.cn/public_html/JLAMP_application/views/MenuView/Menu.html 000011013 */ ?>
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
        .yudo-window-main{
            animation-duration: 1s
        }
        .yudo-window-trans{
            animation-duration: 0.3s
        }
    </style>
</head>
<body>
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
                    <div class="userMenu-list-item" v-if="view.admin" @click="connectRecord()">
                        <div class="icon-connectRecord" style="margin-right:30px"></div><div class="userMenu-list-text" style="line-height: 24px">$((lang.connectRecord))</div>
                    </div>
                    <div class="userMenu-list-item" @click="cleanCache()">
                        <div class="icon-cleanCache" style="margin-right:30px"></div><div class="userMenu-list-text" style="line-height: 24px">$((lang.clearCache))</div>
                    </div>
                    <div class="userMenu-list-item" @click="logout()">
                        <div class="icon-quit" style="margin-right:30px"></div><div class="userMenu-list-text" style="line-height: 21px">$((lang.logout))</div>
                    </div>
                </div>
            </div>
            <div class="yudo-footer">- Mobile ERP $((view.serverId)) -</div>
        </div>
    </aside>
    <!-- 主页面容器 -->
    <div class="mui-inner-wrap">
        <div id="main" class="yudo-content">
            <div class="download-script" v-if="view.downLoadScript"></div>
            <div class="yudo-window">
                <div class="header-ios" style="height: 55px;position:absolute;">
                    <div class="header-body">
                        <div class="header-left-btn"  style="left: 0;padding-top: 7px" @click="showUserMenu()">
                            <div class="left-icon icon-userMenu" style="margin-top: 3px"></div>
                            <div class="left-head-portrait">
                                <img src="/image/fonticon/headDefault.jpg">
                            </div>
                        </div>
                        <div class="header-center-btn" ><img id="imgTopLogo" src="/image/login_logo.png" border="0" alt="top logo" style="width: 120px;margin-top: -2px" class="topLogo"></div>
                        <div class="header-right-btn">
                            <div class="right-icon icon-extend"></div>
                        </div>
                    </div>
                </div>
                <div class="center-ios" id="centerControl" style="border-radius: 15px;padding-top: 55px;background: #292929;padding-bottom: 50px">
                    <div style="height: 101%;background: #ffffff">
                        <div style="width: 100%;height: 150px;">
                            <div style="width: 100%;height: 60px;background: #292929;padding: 10px 15px 0 15px;">
                                <img style="width: 100%;height: 140px;border-radius: 10px;box-shadow: 0px 0px 10px #4d4d4d;" :src="view.yudoImage" />
                            </div>
                            <div style="width: 100%;height: 90px;background: #ffffff"></div>
                        </div>
                        <div class="menu-history">
                            <div class="header-title" v-on:tap="clickMenuPage(0)">
                                <div class="sign"></div>
                                <div class="info">$((lang.recentlyUse))</div>
                            </div>
                            <div class="menu-list-item" style="min-height: 100px">
                                <div class="menu-list-body">
                                    <div class="pre" v-for="(pre,lex) in list.connectHistory" @click="gotoModule(pre.url,pre)">
                                        <div v-bind:class="pre.icon" style="border-radius: 27.5px;margin: 0 auto"></div>
                                        <div class="title">$((pre.title))</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="cut-off"></div>
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
                                            <div class="pre" v-for="(pre,lex) in list.manageInfo[index]" @click="gotoModule(pre.url,pre)">
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
                                            <div class="pre" v-for="(pre,lex) in list.salesManage[index]" @click="gotoModule(pre.url,pre)">
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
                                            <div class="pre" v-for="(pre,lex) in list.asManage[index]" @click="gotoModule(pre.url,pre)">
                                                <div v-bind:class="pre.icon" style="border-radius: 27.5px;margin: 0 auto"></div>
                                                <div class="title">$((pre.title))</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="save-pro" style="background-color:#F5F5F5;height: 55px">
                    <div class="save-pro-body flex-center" style="color: #4b4b4b">
                        Mobile ERP $((view.serverId))
                    </div>
                </div>
            </div>
        </div>
        <div class="mui-off-canvas-backdrop"></div>
    </div>

    <div v-if="view.trans" style="box-shadow: -2px 0px 10px #e2e2e2;" class="yudo-window-trans animated fadeInRight trans-1">
        <div class="center-ios">

        </div>
    </div>
</div>

<script src="/js/Menu/Menu.js?v=<?php $this->print_("MenuVersion",$TPL_SCP,1);?>"></script>

<?php $this->print_("footer",$TPL_SCP,1);?>