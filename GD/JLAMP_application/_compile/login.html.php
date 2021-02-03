<?php /* Template_ 2.2.6 2019/02/22 10:42:01 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/views/login.html 000003900 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<div class="body_back">
	<!-- 버전 -->
	<div id="version" class=version></div>
	<!--  버전 //-->
	
	<!-- logo -->
	<div class="login_logo"><img id="img_logo" src="/image/login_logo.png" alt="YUDO"></div>
		
    <!-- login_input -->
    <form id="frmLogin" method="post" action="/" onsubmit="return doLogin()">
		<div class="login_input_area">
			<ul>
				<!--<li>-->
					<!--<select id="login_service_id" name="login_lang_id" style="width: 99.4%;text-indent: 8px;background-color: #FFFFFF;border: 1px solid #b7b7b7;margin:0px 0px 0px 0px">-->
						<!--<option onclick="setServiceMsg('YUDO_SZ')" value="YUDO_SZ">YUDO SZ</option>-->
						<!--<option onclick="setServiceMsg('YUDO_GD')" value="YUDO_GD">YUDO GD</option>-->
					<!--</select>-->
				<!--</li>-->
				<li><input id="login_id" type="text" class="login_input" value="<?php echo $TPL_VAR["loginID"]?>" placeholder="ID" required autocomplete="off"/></li>
				<li><input id="login_pwd" type="password" class="login_input" placeholder="PASSWORD" required autocomplete="off"/></li>
				<li>
					<select id="login_db_id" name="login_lang_id" style="width: 100%; height: 34px; text-indent: 5px;background-color: #FFFFFF;border: 1px solid #b7b7b7;margin:0px 0px 0px 0px">
						<option value="normal">Normal DB</option>
						<option value="test">Test DB</option>
					</select>
				</li>
				<li>
					<select id="login_lang_id" name="login_lang_id" style="	width: 100%; height: 34px; text-indent: 5px;background-color: #FFFFFF;border: 1px solid #b7b7b7;margin:0px 0px 0px 0px">
						<option value="CHN">CHINA</option>
						<option value="KOR">KOREA</option>
						<option value="ENG">ENGLISH</option>
					</select>
				</li>
			</ul>
		</div>
		<div class="login_bn_area"><input type="button" class="bn_login" id="btn_device_id" value="Device Registration Request" /></div>
	
		<!-- 로그인 버튼 -->
		<div class="login_bn_area"><input type="submit" id="btn_login" class="bn_login" value="LOGIN"></div>
	</form>

	<!-- 아이디 저장 / 자동 로그인 -->
	<div class="login_rbn_area">
		<ul>
			<li>
				<label class="checkbox-inline" style="height: 20px;line-height: 20px">
					<input type="checkbox" id="save_id" name="save_id" <?php echo $TPL_VAR["isSaveID"]?>> Save ID ()
				</label>
			</li>
			<!--<li>-->
				<!--<label class="checkbox-inline">-->
					<!--<input type="checkbox" id="auto_login" name="auto_login"> 자동 로그인-->
				<!--</label>-->
			<!--</li>-->
		</ul>
	</div>
</div>

<!-- 기기번호 등록요청 모달 -->
<div class="modal" id="mdl_device_info" tabindex="-1" role="dialog" aria-labelledby="device_model" aria-hidden="true">
	<div class="modal_area">
			<!-- 모달 컨텐츠 -->
			<div class="modal_contents">
				<!-- 제품 영역 -->
				<div class="modal_area">
				<!-- 설명 영역 -->
				<div class="modal_txt_area">
					<div class="modal_title" id="device_reg_req">Device Registration Request</div>
					<input id="mdl_device_token" type="hidden">
					<input id="mdl_device_type" type="hidden">
					<div class="modal_sub_title"><input type="text" id="mdl_user_id" class="no_input" placeholder="LOGIN ID"></div>
					<div class="modal_sub_title"><input type="text" id="mdl_device_id" class="no_input_disable" placeholder="DEVICE ID" readonly></div>
					<div class="no_bn_area"><input class="no_bn" id="btn_device_save" type="button" value="Request"></div>
					<div class="no_bn_area">
						<input class="no_bn" type="button" style="background-color: #727171;" data-dismiss="modal" value="Close">
					</div>
				</div>
			</div>
		</div>
	</div> <!-- 모달 전체 윈도우 -->
</div>
<script>
</script>
<!-- 기기번호 등록요청 모달 //-->
<?php $this->print_("footer",$TPL_SCP,1);?>