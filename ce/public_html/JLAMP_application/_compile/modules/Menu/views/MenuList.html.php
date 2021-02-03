<?php /* Template_ 2.2.6 2018/01/29 13:49:28 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/Menu/views/MenuList.html 000001510 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<!-- nav -->

<div id="slide_panel" style="padding-top:50px;">

	<div id="wrapper">
		<!--
        <div id="top_logo">
            <a><img id="imgTopLogo" src="<?php echo $TPL_VAR["imagePath"]?>" border="0" alt="top logo" class="topLogo"/></a>
            <input id="dbKey" type="hidden" value="<?php echo $TPL_VAR["dbKey"]?>"/>
        </div>
        -->
		<ul id="menu">
            <li><a href="javascript:goMenu('mi')"><img id="localMenu" name="menu" class="alpha" src="/image/MI.png" border="0" alt="경영정보" /></a><span class="menu_link"><a href="#">경영정보</a></span></li>
            <li><a href="javascript:goMenu('sm')"><img id="deptMenu" name="menu" class="alpha" src="/image/SM.png" border="0" alt="영업관리" /></a><span class="menu_link"><a href="#">영업관리</a></span></li>
            <li><a href="javascript:goMenu('asm')"><img id="dfsMenu" name="menu" class="alpha" src="/image/ASM.png" border="0" alt="A/S관리" /></a><span class="menu_link"><a href="#">A/S관리</a></span></li>
        </ul>
        <div class="content">
            <ul id="mi" class="cateList hide">
            </ul>
			<ul id="sm" class="cateList hide">
			</ul>
            <ul id="asm" class="cateList hide">
            </ul>
        </div>
    </div>
</div>



<?php $this->print_("footer",$TPL_SCP,1);?>