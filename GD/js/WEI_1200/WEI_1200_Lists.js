var m_marginSize = 2;

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
 * 설 명: 영업집계표(년) 조회 Process
 *
 * 최초작성일: 2017.11.13
 * 최종수정일: 2017.11.13
  * ---
  * Date              Auth        Desc
  */
function doSearch() {
    var baseDate = jq("#base_date").val(); // 기준일

	if (!baseDate) {
		alert('기준일은 필수입력입니다.');
		return false;
    }
    
	
	// Loading Indicator
	JLAMP.common.loading('body', 'pulse');

	jq.ajax({
		url: '/WEI_1200/WEI_1200/lists_prc',
		data: {
			workType: 'Y',
			baseDate: baseDate
		},
		type: 'get',
		dataType: 'json',
		success: function(res, status, xhr) {
			if (res) {
				if (res.returnCode == 0) {
					if (res.data.valid.p_error_code.substring(0, 1) != 'E' && res.data.valid.p_error_code.substring(0, 1) != 'P') {
                        if (res.data.res != null) {
                            html = '';
                            jq.each(res.data.res, function(i) {
                            	cls = '';
                                if (this.DeptDiv1_Cd) {
                                    html += '<tr onclick="setChartData(this, \'' + this.DeptDiv1 + '\', ' +
                                        this.TotYYOrderForAmt + ', ' +
                                        this.TotYYInvoiceForAmt + ', ' +
                                        this.TotYYBillForAmt + ', '+
                                        this.TotYYReceiptForAmt + ', ' +
                                        this.TotYYProductForAmt + ')">';
                                    html += '<td colspan="2">' + this.DeptDiv1 + '</td>';
                                } else {
                                    if (this.ExternalGubnNm === 'TOTAL') {
                                        cls = 'class="orange"';
                                    } else {
                                        cls = 'class="green"';
                                    }
                                    html += '<tr onclick="setChartData(this, \'' + this.ExternalGubnNm + '(' + this.DeptDiv1 + ')\', ' +
                                        this.TotYYOrderForAmt + ', ' +
                                        this.TotYYInvoiceForAmt + ', ' +
                                        this.TotYYBillForAmt + ', '+
                                        this.TotYYReceiptForAmt + ', ' +
                                        this.TotYYProductForAmt + ')">';
                                    html += '<td ' + cls + '>' + this.ExternalGubnNm + '</td>';
                                    html += '<td ' + cls + '>' + this.DeptDiv1 + '</td>';
                                }
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.TotYYOrderForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.TotYYInvoiceForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.TotYYBillForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.TotYYReceiptForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.TotYYProductForAmt, 2) + '</td>';
                                html += '</tr>';
                            });
                        } else {
							var noQuery = JLAMP.lang.getWord('W2018020109203768345');
                            html = '<tr><td style="border-bottom: 0" colspan="7"><div class="setNoRecords text-center"><span>'+noQuery+'</span></div></td></tr>';
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
            JLAMP.common.mergeRows('.basic_table', 0, 1);

			JLAMP.common.loadingClose('body');

            jq('#chart').html('<img style="margin-top:40px;" src="/image/no_chart.png">');
            jq("#list_html tr:first-child").click();
        }
    });
} // end of function doSearch

/**
 * 메소드명: setChartData
 * 작성자: 김목영
 * 설 명: Chart Data Setting
 *
 * 최초작성일: 2017.11.13
 * 최종수정일: 2017.11.13
 * ---
 * Date              Auth        Desc
 */
function setChartData(obj, colName, todayOrderForAmt, toDayInvoiceForAmt, toDayBillForAmt, toDayReceiptForAmt, toDayProductForAmt) {
    if (!todayOrderForAmt && !toDayInvoiceForAmt && !toDayBillForAmt && !toDayReceiptForAmt && !toDayProductForAmt) return;

	var chartTitle1 = JLAMP.lang.getWord('W2018020109283120077');
	var chartTitle2 = JLAMP.lang.getWord('W2018020109285362328');
	var chartTitle3 = JLAMP.lang.getWord('W2018020109291710702');
	var chartTitle4 = JLAMP.lang.getWord('W2018020109293734322');
	var chartTitle5 = JLAMP.lang.getWord('W2018020109300261382');

    jq(obj).children().addClass('sel_txt');
    jq(obj).siblings().children().removeClass('sel_txt');

    jq("#chart").kendoChart({
        title: {
            text: colName
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            labels: {
                template: "#= category # - #= kendo.format('{0:P}', percentage)#",
                position: "insideEnd",
                visible: true,
                background: "transparent"
            }
        },
        series: [{
            type: "pie",
            data: [{
                category: chartTitle1,
                value: todayOrderForAmt
            }, {
                category: chartTitle2,
                value: toDayInvoiceForAmt
            }, {
                category: chartTitle3,
                value: toDayBillForAmt
            }, {
                category: chartTitle4,
                value: toDayReceiptForAmt
            }, {
                category: chartTitle5,
                value: toDayProductForAmt
            }]
        }],
        tooltip: {
            visible: true,
            template: "#= category # - #= kendo.format('{0:P}', percentage) #"
        }
    });
} // end of function setChartData
