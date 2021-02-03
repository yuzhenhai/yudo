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
    jq('#txtSC').keyup(function () {
        var val = {
            obj: this,
            space: false,
            br: false,
            allowSC: true
        };
        JLAMP.common.repSpecialChar(val);
    });
    jq('#btn_search').click(function () {
        getDBList()
    });
});
function getDBList() {
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
                                /*
                                 fnChart = "onClick=\"setChartData('" + this.DeptDiv1 + "',
                                 " + this.todayOrderForAmt + ",
                                 "+ this.toDayInvoiceForAmt + ",
                                 "+ this.toDayBillForAmt + ",
                                 "+ this.toDayReceiptForAmt + ",
                                 "+ this.toDayProductForAmt + ")\"";
                                 */
                                fnChart = "onclick=\"setChartData('" + this.DeptDiv1 + "', " +
                                    this.ToDayOrderForAmt + ", " +
                                    this.ToDayInvoiceForAmt + ", " +
                                    this.ToDayBillForAmt + ", " +
                                    this.ToDayReceiptForAmt + ", " +
                                    this.ToDayProductForAmt + ")\" ";
                                html += '<tr>';
                                html += '<td ' + fnChart + '>' + this.DeptDiv1 + '</td>';
                                html += '<td> ' + JLAMP.common.currencyFormat(this.ToDayOrderForAmt, 2) + '</td>';
                                html += '<td> ' + JLAMP.common.currencyFormat(this.ToDayInvoiceForAmt, 2) + '</td>';
                                html += '<td> ' + JLAMP.common.currencyFormat(this.ToDayBillForAmt, 2) + '</td>';
                                html += '<td> ' + JLAMP.common.currencyFormat(this.ToDayReceiptForAmt, 2) + '</td>';
                                html += '<td> ' + JLAMP.common.currencyFormat(this.ToDayProductForAmt, 2) + '</td>';
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
        }
    })
}

function setChartData(colName, todayOrderForAmt, toDayInvoiceForAmt, toDayBillForAmt, toDayReceiptForAmt, toDayProductForAmt) {
    if (!todayOrderForAmt && !toDayInvoiceForAmt && !toDayBillForAmt && !toDayReceiptForAmt && !toDayProductForAmt) return;
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


