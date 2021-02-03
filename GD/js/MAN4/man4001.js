var m_marginSize = 2;
jq(document).ready(function () {
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

    var date = new Date();
    jq('#base_date').datetimepicker("setDate", date);
    jq('#btn_search').click(function () {
        doSearch();
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

function doSearch() {
    var baseDate = jq('#base_date').val();
    var langCode = jq('#lang_code').val();
    //loading
    JLAMP.common.loading('body', 'pulse');
    jq.ajax({
        url: '/MAN4/MAN4/dbList_prc',
        data: {
            workType: 'D',
            baseDate: baseDate,
            langCode: langCode,
        },
        type: 'get',
        dataType: 'json',
        success: function (res, status, xhr) {
            if (res) {
                if (res.returnCode == 0) {
                    if (res.data.valid.p_error_code.substring(0, 1) != 'E' && res.data.valid.p_error_code.substring(0, 1) != 'P') {
                        if (res.data.res !== undefined && res.data.res.length) {
                            html = '';
                            jq.each(res.data.res, function (i) {
                                cls = '';
                                if (this.DeptDiv1_Cd && this.DeptDiv1 && this.DeptDiv1_Cd !== null) {
                                    html += '<tr onclick="setChartData(this, \'' + this.DeptDiv1 + '\', ' +
                                        this.ToDayOrderForAmt + ', ' +
                                        this.ToDayInvoiceForAmt + ', ' +
                                        this.ToDayBillForAmt + ', ' +
                                        this.ToDayReceiptForAmt + ', ' +
                                        this.ToDayProductForAmt + ')">';
                                    html += '<td colspan="2">' + this.DeptDiv1 + '</td>';
                                } else {
                                    if (this.DeptDiv1) {
                                        if (this.ExternalGubnNm === 'TOTAL') {
                                            cls = 'class="orange"';
                                        } else {
                                            cls = 'class="green"';
                                        }
                                        html += '<tr onclick="setChartData(this, \'' + this.ExternalGubnNm + '(' + this.DeptDiv1 + ')\', ' +
                                            this.todayOrderForAmt + ', ' +
                                            this.ToDayInvoiceForAmt + ', ' +
                                            this.ToDayBillForAmt + ', ' +
                                            this.ToDayReceiptForAmt + ', ' +
                                            this.ToDayProductForAmt + ')">';
                                        html += '<td ' + cls + '>' + this.ExternalGubnNm + '</td>';
                                        html += '<td ' + cls + '>' + this.DeptDiv1 + '</td>';
                                    } else {
                                        cls = 'class="green"';

                                        html += '<tr onclick="setChartData(this, \'' + this.ExternalGubnNm + '(' + this.DeptDiv1 + ')\', ' +
                                            this.todayOrderForAmt + ', ' +
                                            this.ToDayInvoiceForAmt + ', ' +
                                            this.ToDayBillForAmt + ', ' +
                                            this.ToDayReceiptForAmt + ', ' +
                                            this.ToDayProductForAmt + ')">';
                                        html += '<td ' + cls + ' colspan="2">' + this.ExternalGubnNm + '</td>';
                                    }
                                }
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.ToDayOrderForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.ToDayInvoiceForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.ToDayBillForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.ToDayReceiptForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.ToDayProductForAmt, 2) + '</td>';
                                html += '</tr>';
                            });
                        } else {
                            html = '<tr><td style="border-bottom: 0" colspan="7"><div class="setNoRecords text-center"><span>조회된 데이터가 없습니다.</span></div></td></tr>';
                        }

                        jq("#list_html").html(html);
                    } else
                        alert(res.data.valid.p_error_str);
                } else {
                    alert(res.returnMsg);
                }
            }
        },
        error: function (xhr, status, error) {
            alert(error);
        },
        complete: function (xhr, status) {
            JLAMP.common.loadingClose('body');

            JLAMP.common.mergeRows('.basic_table', 0, 1);

            jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
            jq("#list_html tr:first-child").click();
        }
    });
}


function setChartData(obj, colName, todayOrderForAmt, toDayInvoiceForAmt, toDayBillForAmt, toDayReceiptForAmt, toDayProductForAmt) {
    if (!todayOrderForAmt && !toDayInvoiceForAmt && !toDayBillForAmt && !toDayReceiptForAmt && !toDayProductForAmt) return;

    jq(obj).children().addClass('sel_txt');
    jq(obj).siblings().children().removeClass('sel_txt');
    jq('#chart').kendoChart({
        title: {
            text: colName
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            labels: {
                template: "#= category # -#=kendo.format('{0:P}',percentage)#",
                position: "insideEnd",
                visible: true,
                background: "transparent"
            }
        },
        series: [{
            type: "pie",
            data: [{
                category: "第一列",
                value: todayOrderForAmt
            }, {
                category: "第二列",
                value: toDayInvoiceForAmt
            }, {
                category: "第三列",
                value: toDayBillForAmt
            }, {
                category: "第四列",
                value: toDayReceiptForAmt
            }, {
                category: "第五列",
                value: toDayProductForAmt
            }]
        }],
        tooltip: {
            visible: true,
            template: "#= category #"
        }
    });
}



function setListWidth() {
    var screenWidth = jq(this).width();
    jq(".basic_table").parent().width(screenWidth - m_marginSize);
}

function setListHeight() {
    var listHeight = jq(".basic_table").height();
    jq(".basic_table").parent().animate({
        height: listHeight + m_marginSize
    }, 500)
}