var m_marginSize = 2;
var m_forAmt_pre = [];
var m_forAmt = [];
var m_last_year = '';
var m_this_year = '';
var m_externalGubunNm = [];
var m_langCode = '';

jq(document).ready(function() {
    // Bootstrap DatePicker
    jq("#base_date").datetimepicker({
		language: m_commCultureType,
		format: "yyyy-mm-dd",
		inputFormat:  "yyyy-mm-dd",
		autoclose: true,
		startView: JLAMP.datetimepicker.viewType.DAY,
		minView: JLAMP.datetimepicker.viewType.DAY,
		maxView: JLAMP.datetimepicker.viewType.YEAR,
		keyboardNavigation: true,
		viewSelect: 'month',
		pickerPosition: "bottom-right"
    });	
    
    // 금일날짜 세팅
    var date = new Date();
    jq("#base_date").datetimepicker("setDate", date);

    //jq("#lang_code").kendoDropDownList();
    
	jq("#gubun").kendoDropDownList();

    setListWidth();

    // 조회 버튼 클릭 이벤트
    jq("#btn_search").click(function() {
        doSearch();
    });
    // 리스트 버튼 클릭 이벤트
    jq("#btn_menu_lists").click(function() {
		location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
    });

	jq("#btn_search").val(JLAMP.lang.getWord('W2018020109095825029'));
	jq("#btn_menu_lists").val(JLAMP.lang.getWord('W2018020109110962726'));
	jq("#base_date").keyup(function() {
		JLAMP.common.repNumberKey(this,'');
		if (jq("#base_date").val().length >4 && jq("#base_date").val().length <= 6) {
			jq("#base_date").val(jq("#base_date").val().substring(0,4)+'-'+jq("#base_date").val().substring(4,6));
		} else if (jq("#base_date").val().length >6) { 
			jq("#base_date").val(jq("#base_date").val().substring(0,4)+'-'+jq("#base_date").val().substring(4,6)+'-'+jq("#base_date").val().substring(6,8));
		}
	});
});

jq(window).resize(function() {
    setListWidth();

    var screenWidth = jq(this).width();
    var chart = jq("#chart").data("kendoChart");
    if (chart) {
        jq("#chart").css({width: screenWidth});
        chart.redraw();
    }
});

function setListWidth() {
    var screenWidth = jq(this).width();
    jq(".basic_table").parent().width(screenWidth - m_marginSize);
}

function setListHeight() {
    var listHeight = jq(".basic_table").height();
    //jq(".basic_table").parent().height(listHeight + m_marginSize);
    jq(".basic_table").parent().animate({
        height: listHeight + m_marginSize
    }, 500)
}

/**
 * 메소드명: doSearch
 * 작성자: 김목영
 * 설 명: 영업집계표(일) 조회 Process
 *
 * 최초작성일: 2017.11.10
 * 최종수정일: 2017.11.10
  * ---
  * Date              Auth        Desc
  */
function doSearch() {
	m_forAmt_pre = [];
	m_forAmt = [];
	m_externalGubunNm = [];
	var beforeExternalGubn = '';
	var afterExternalGubn = '';
	var beforeSort = '';
	var afterSort = '';
    var html = '';
    var baseDate = jq("#base_date").val(); // 기준일
    var gubun = jq("#gubun").val(); // 구분
	var contract = JLAMP.lang.getWord('W2018020113545170008');
	var deliver = JLAMP.lang.getWord('W2018020113594302716');
	var invoice = JLAMP.lang.getWord('W2018020114034047074');
	var deposit = JLAMP.lang.getWord('W2018020114062894053');
	var prodRel = JLAMP.lang.getWord('W2018020114105503016');

	if (!baseDate) {
		alert('기준일은 필수입력입니다.');
		return false;
    }
    

	// Loading Indicator
	JLAMP.common.loading('body', 'pulse');

	jq.ajax({
		url: '/WEI_1400/WEI_1400/lists_prc',
		data: {
			gubun: gubun,
			baseDate: baseDate
		},
		type: 'get',
		dataType: 'json',
		success: function(res, status, xhr) {
			if (res) {
				if (res.returnCode == 0) {
					if (res.data.valid.p_error_code.substring(0, 1) != 'E' && res.data.valid.p_error_code.substring(0, 1) != 'P') {
                        if (res.data.res != null) {

                            jq.each(res.data.res, function(i) {
								var lastYearArray = [];
								var thisYearArray = [];
								if (this.Sort == '000') {
									lastYearArray = this.ForAmt_Pre.split('.');
									m_last_year = lastYearArray[0];
									thisYearArray = this.ForAmt.split('.');
									m_this_year = thisYearArray[0];
								}
								var sort = Number(this.Sort);
								var rowspan ='';
								var cls = '';
								var var_forAmt_pre = Number(this.ForAmt_Pre);
								var var_forAmt = Number(this.ForAmt);
								var cal_forAmt = 0; 
								if (var_forAmt != 0) {
									cal_forAmt = (1-(var_forAmt_pre/var_forAmt))*100;
									cal_forAmt.toFixed(2);
								}
								beforeSort = this.Sort.substring(0,1);
								if (this.ExternalGubnNm === 'TOTAL') {
									cls = 'class="orange"';
								} else {
									cls = 'class="green"';
								}
								if (this.ExternalGubnNm === 'TOTAL') {
									rowspan ='1';
								} else  if (gubun == 'Y') {
									rowspan ='3';
								} else if(gubun == 'M') {
									rowspan ='2';
								} else if(gubun == 'D') {
									rowspan ='1';
								}
								if (this.Sort != '000') {
									html += '<tr>';
									if (beforeSort == '1' && beforeSort != afterSort) {
										html += '<td  style="background-color:#339966;color:#FFFFFF;width:70px" rowspan="'+rowspan+'">'+contract+'</td>';
									} else if (beforeSort == '2' && beforeSort != afterSort) {
										html += '<td style="background-color:#339966;color:#FFFFFF;width:70px" rowspan="'+rowspan+'">'+deliver+'</td>';
									} else if (beforeSort == '3' && beforeSort != afterSort ) {
										html += '<td style="background-color:#339966;color:#FFFFFF;width:70px" rowspan="'+rowspan+'">'+invoice+'</td>';
									} else if (beforeSort == '4' && beforeSort != afterSort) {
										html += '<td style="background-color:#339966;color:#FFFFFF;width:70px" rowspan="'+rowspan+'">'+deposit+'</td>';
									} else if (beforeSort == '5' && beforeSort != afterSort) {
										html += '<td style="background-color:#339966;color:#FFFFFF;width:70px" rowspan="'+rowspan+'">'+prodRel+'</td>';
									}


									html += '<td ' + cls + ' style="width:70px">' + this.ExternalGubnNm + '</td>';
									html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.ForAmt_Pre, 2) + '</td>';
									html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.ForAmt, 2) + '</td>';
									html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(cal_forAmt, 2) + '%</td>';
									html += '</tr>';
									m_forAmt_pre.push(var_forAmt_pre);
									m_forAmt.push(var_forAmt);
									if (sort>=100 && sort<200) {
										this.ExternalGubnNm = contract+'-'+this.ExternalGubnNm;
									} else if (sort>=200 && sort<300) {
										this.ExternalGubnNm = deliver+'-'+this.ExternalGubnNm;
									} else if (sort>=300 && sort<400) {
										this.ExternalGubnNm = invoice+'-'+this.ExternalGubnNm;
									} else if (sort>=400 && sort<500) {
										this.ExternalGubnNm = deposit+'-'+this.ExternalGubnNm;
									} else if (sort>=500 && sort<600) {
										this.ExternalGubnNm = prodRel+'-'+this.ExternalGubnNm;
									}
									afterSort = this.Sort.substring(0,1);
									m_externalGubunNm.push(this.ExternalGubnNm);
									m_langCode = res.data.langCode;
								}
                            });
							setChartData();
                        } else {
							var noQuery = JLAMP.lang.getWord('W2018020109203768345');
                            html = '<tr><td style="border-bottom: 0" colspan="5"><div class="setNoRecords text-center"><span>'+noQuery+'</span></div></td></tr>';
							jq('#chart').html('<img style="margin:40px;margin-top:40px;" src="/image/no_chart.png">');
                        }

						jq("#list_html").html(html);
                        setListHeight();
					} else
						alert(res.data.valid.p_error_str);
                } else {
                    alert(res.returnMsg);
                }
            }
        },
        error: function(xhr, status, error) {
            // iOS에서 네트워크 에러인 경우 에러 페이지 표시
        	if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
        		location.href = "jmobile://callErrorPage";
        	} else 
        		alert(error);
        },
        complete: function(xhr, status) {
			JLAMP.common.loadingClose('body');

            JLAMP.common.mergeRows('.basic_table', 0, 1);

            jq("#list_html tr:first-child").click();
        }
    });
} // end of function doSearch

/**
 * 메소드명: setChartData
 * 작성자: 김목영
 * 설 명: Chart Data Setting
 *
 * 최초작성일: 2017.11.10
 * 최종수정일: 2017.11.10
 * ---
 * Date              Auth        Desc
 */
function setChartData() {
   // if (!todayOrderForAmt && !toDayInvoiceForAmt && !toDayBillForAmt && !toDayReceiptForAmt && !toDayProductForAmt) return;

    //jq(obj).children().addClass('sel_txt');
    //jq(obj).siblings().children().removeClass('sel_txt');

	var man = JLAMP.lang.getWord('W2018020113345514785');
	var devTitle = JLAMP.lang.getWord('W2018020113401724334');
	var chartTitle1 = JLAMP.lang.getWord('W2018020109425972356');

	jq("#last_year_title").html(m_last_year+" ("+man+")");
	jq("#this_year_title").html(m_this_year+" ("+man+")");
	jq("#development_title").html(devTitle);
	
    jq("#chart").kendoChart({
        title: {
            text: chartTitle1
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
			type: "column"
        },
		series: [{
			name: m_last_year+" ("+man+")",
			data: m_forAmt_pre,
			color: '#4F81BD'
		}, {
			name: m_this_year+" ("+man+")",
			data: m_forAmt,
			color: '#C0504D'
		}],
		categoryAxis: {
			categories: m_externalGubunNm,
			labels: {
				rotation: -45
			},
			majorGridLines: {
				visible: false
			}
		},
        tooltip: {
            visible: true,
            template: "#= series.name  # - #= value #"
        }
    });
} // end of function setChartData
