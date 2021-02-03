<?php /* Template_ 2.2.6 2018/02/05 15:42:36 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/WEI_1100/views/WEI_1100_Lists.html 000003605 */ ?>
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
				<!--
                <tr>
                    <th j-word-label="W2015012012571423713">언어</th>
                    <td>
                        <select id="lang_code" name="lang_code" style="width: 100%">
                            <option value="KOR">Korean</option>
                            <option value="ENG">English</option>
                            <option value="JPN">Japanese</option>
                        </select>
                    </td>
                </tr>-->
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

        <!-- 타이틀 및 검색  mt_10-->
        <div class="sub_title" j-word-label="W2018020109233653325">영업집계표(월)</div>
        <div class="table-responsive" style="overflow-x: auto; height:200px;">
            <table class="basic_table">
                <colgroup>
                    <col width="10%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <thead>
                <tr>
                    <th style="text-align:center" colspan="2"  j-word-label="W2018020109133008751">구분</th>
					<th style="text-align:center" j-word-label="W2018020109241439019">당월(수주)</th>
                    <th style="text-align:center" j-word-label="W2018020109245146068">당월(출고)</th>
                    <th style="text-align:center" j-word-label="W2018020109252733085">당월(계산서)</th>
                    <th style="text-align:center" j-word-label="W2018020109261422793">당월(입금)</th>
                    <th style="text-align:center" j-word-label="W2018020109263557397">당월(생산출고)</th>
                </tr>
                <tbody id="list_html">
                </tbody>
            </table>
        </div>

        <div class="sub_title mt_10" j-word-label="W2018020109272146071">영업집계표(월) 차트</div>
        <div id="chart">
            <img style="margin-top:40px;" src="/image/no_chart.png">
        </div>
    </div>
</div>

<?php $this->print_("footer",$TPL_SCP,1);?>