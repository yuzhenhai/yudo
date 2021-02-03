jq(document).ready(function() {
    // Bootstrap DatePicker
    jq("#base_date").datetimepicker({
		language: m_commCultureType,
		format: "yyyy-mm-dd",
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

    jq("#txtSC").keyup(function(e) {
        var value = {
            obj: this, // 해당 객체
            space: false, // 스페이스바 허용여부
            br: false, // 줄바꿈 허용여부 
            allowSC: true // 프레임워크에서 지정한 특수문자만 허용 (textarea 사용시 필수)
        }

        // 특수문자 제거
        JLAMP.common.repSpecialChar(value);
    });

    jq("#btnSearch").click(function() {
        getDBList();
    });
});

function getDBList() {
    var bdate = jq("#base_date").val();
    var lngCode = jq("#lang_code").val();

    JLAMP.common.loading('body', 'pulse');

    jq.ajax({
		url: '/MAN1/MAN1/dbList_prc',
		data: {
			workType: 'D',
			baseDate: bdate,
			langCode: lngCode,
		},
		type: 'get',
		dataType: 'json',
		success: function(res, status, xhr) {
			if (res) {
				if (res.returnCode == 0) {
                    if (res.data.valid.p_error_code.substring(0, 1) != 'E' && res.data.valid.p_error_code.substring(0, 1) != 'P') {
                        if (res.data.res !== undefined && res.data.res.length) {
                            html = '';
                            jq.each(res.data.res, function(i) {
                                fnChart = "onclick=\"setChartData('" + this.DeptDiv1 + "', " + 
                                    this.ToDayOrderForAmt + ", " + 
                                    this.ToDayInvoiceForAmt + ", " + 
                                    this.ToDayBillForAmt + ", " + 
                                    this.ToDayReceiptForAmt + ", " + 
                                    this.ToDayProductForAmt + ")\" ";

                                html += '<tr>';
                                html += '<td ' + fnChart + '>' + this.DeptDiv1 + '</td>';
                                html += '<td>' + JLAMP.common.currencyFormat(this.ToDayOrderForAmt, 2) + '</td>';
                                html += '<td>' + JLAMP.common.currencyFormat(this.ToDayInvoiceForAmt, 2) + '</td>';
                                html += '<td>' + JLAMP.common.currencyFormat(this.ToDayBillForAmt, 2) + '</td>';
                                html += '<td>' + JLAMP.common.currencyFormat(this.ToDayReceiptForAmt, 2) + '</td>';
                                html += '<td>' + JLAMP.common.currencyFormat(this.ToDayProductForAmt, 2) + '</td>';
                                html += '</tr>';
                            });
                        } else {
                            html = '<tr><td colspan="7">조회된 데이터가 없습니다.</td></tr>';
                        }

						jq("#list_html").html(html);
                    } else 
                        alert(res.data.valid.p_error_str);
                } else {
                    alert(res.returnMsg);
                }
            }
        },
        error: function(xhr, status, error) {
        	alert(error);
        },
        complete: function(xhr, status) {
			JLAMP.common.loadingClose('body');
        }
    })
}

function setChartData(colName, todayOrderForAmt, toDayInvoiceForAmt, toDayBillForAmt, toDayReceiptForAmt, toDayProductForAmt) {
    if (!todayOrderForAmt && !toDayInvoiceForAmt && !toDayBillForAmt && !toDayReceiptForAmt && !toDayProductForAmt) return;

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
                category: "금일(수주)",
                value: todayOrderForAmt
            }, {
                category: "금일(출고)",
                value: toDayInvoiceForAmt
            }, {
                category: "금일(계산서)",
                value: toDayBillForAmt
            }, {
                category: "금일(입금)",
                value: toDayReceiptForAmt
            }, {
                category: "금일(생산출고)",
                value: toDayProductForAmt
            }]
        }],
        tooltip: {
            visible: true,
            template: "#= category #"
        }
    });
}
