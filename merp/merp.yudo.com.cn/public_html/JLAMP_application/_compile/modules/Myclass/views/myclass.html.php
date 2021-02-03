<?php /* Template_ 2.2.6 2018/04/12 12:53:41 /home/merp.yudo.com.cn/public_html/JLAMP_application/modules/Myclass/views/myclass.html 000003924 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

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
                        <input type="text" class="input form-control text-center" id="monthly">
                    </td>
                </tr>
                <tr>
                    <th j-word-label="W2018020109133008751">구분</th>
                    <td>
                        <select id="gubun" name="gubun" style="width: 100%">
                            <option value="ALL">소유</option>
                            <option value="CP" >公司</option>
                            <option value="CM" >客户</option>
                            <option value="SS" >系统部件</option>
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

        <!-- 타이틀 및 검색  mt_10-->
        <div class="sub_title" j-word-label="W2018040318541876071">매월 통계표_SZ</div>
        <div class="table-responsive" style="overflow-x: auto;overflow-y: auto;width: 100%;height:300px">
            <table class="basic_table">
                <tr>
                    <th>区分</th>
                    <th>不良现象/原因种类</th>
                    <th id="last_year_title">漏胶</th>
                    <th id="this_year_title">丢失赠送</th>
                    <th id="development_title">客户现场</th>
                    <th>部件不良</th>
                    <th>阀针异常</th>
                    <th>产品成型不良</th>
                    <th>加工/组装异常</th>
                    <th>Total</th>
                </tr>
                <tbody id="list_html">

                </tbody>
            </table>

        </div>
        <div class="sub_title mt_10" j-word-label="W2018040909151983373">매월 통계표_SZ 차트</div>
        <div id="chart">
            <img style="margin-top:40px;margin-bottom:40px;" src="/image/no_chart.png">
        </div>
    </div>
</div>
<?php $this->print_("footer",$TPL_SCP,1);?>