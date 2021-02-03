<?php /* Template_ 2.2.6 2018/07/31 14:37:24 /home/gdmerp.yudo.com.cn/public_html/JLAMP_application/modules/WEI_1400/views/WEI_1400_Lists.html 000003493 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<!-- nav -->

<div id="slide_panel" style="padding-top:50px;">

    <!-- contents -->
    <div class="sub_contents">

        <!-- 검색 -->
        <div class="search_area">
            <table class="search_table">
                <colgroup>
                    <col width="70px;">
                </colgroup>
                <tr>
                    <th j-word-label="W2018020109090482039">기준일</th>
                    <td colspan="3">
                        <input type="text" id="base_date" class="form-control search_input text-center" >
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018020109133008751">구분</th>
                    <td>
                        <select id="gubun" name="gubun" style="width: 100%">
                            <option value="Y" j-word-label="W2018020109415474726">당년</option>
                            <option value="M" j-word-label="W2018020109413375009">당월</option>
                            <option value="D" j-word-label="W2018020109401388002">당일</option>
                        </select>
                    </td>
                </tr>
				<!--
                <tr>
                    <th>언어</th>
                    <td>
                        <select id="lang_code" name="lang_code" style="width: 100%">
                            <option value="KOR">Korean</option>
                            <option value="ENG">English</option>
                            <option value="JPN">Japanese</option>
                            <option value="CHN">Chinesse</option>
                        </select>
                    </td>
                </tr>
				-->
            </table>
            <table width="100%">
                <colgroup>
					<col width="50%"/>
					<col width="50%"/>
                </colgroup>
                <tr>
                    <td>
							<input class="bn_normal_100" id="btn_search" type="button" value="검색">
					</td>
                    <td>
							<input class="bn_normal_100" id="btn_menu_lists" type="button" value="리스트">
                    </td>
                </tr>
			</table>
			<!--
            <div class="search_bn_area">
                <input class="bn_normal_100" id="btn_search" type="button" value="검색">
            </div>
			-->
        </div>


        <div class="sub_title mt_10" j-word-label="W2018020109431959772">영업집계표_SZ 차트</div>
        <div id="chart">
            <img style="margin-top:40px;margin-bottom:40px;" src="/image/no_chart.png">
        </div>

        <!-- 타이틀 및 검색  mt_10-->
        <div class="sub_title" j-word-label="W2018020109425972356">영업집계표_SZ</div>
        <div class="table-responsive" style="overflow-x: auto; height:200px;">
            <table class="basic_table">
                <tr>
                    <th colspan="2"></th>
                    <th id="last_year_title"></th>
                    <th id="this_year_title"></th>
                    <th id="development_title"  j-word-label="W2018020109425972356">성장률</th>
                </tr>
                <tbody id="list_html">
                </tbody>
            </table>
	
        </div>
    </div>
</div>

<?php $this->print_("footer",$TPL_SCP,1);?>