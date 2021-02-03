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
    jq("#base_date").datetimepicker("setDate", date);

    jq("#btn_search").click(function () {
        doSearch();
    });
});

function doSearch() {
    var baseDate = jq("#base_date").val(); // 기준일
    var langCode = jq("#lang_code").val(); // 언어

    if (!baseDate) {
        alert('기준일은 필수입력입니다.');
        return false;
    }

    if (!langCode) {
        alert('언어는 필수입력입니다.');
        return false;
    }

    // Loading Indicator
    JLAMP.common.loading('body', 'pulse');

    jq.ajax({
        url: '/WEI_1300/WEI_1300/lists_prc',
        data: {
            workType: 'P',
            baseDate: baseDate,
            langCode: langCode,
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
                                cls = '';
                                if (this.DeptDiv1_Cd && this.DeptDiv1 && this.DeptDiv1_Cd !== null) {
                                    html += '<tr onclick="setChartData(this, \'' + this.DeptDiv1 + '\', ' +
                                        this.MiInvoiceForAmt + ', ' +
                                        this.MiBillForAmt + ', ' +
                                        this.MiReceiptForAmt + ', '+
                                        this.MiProductForAmt + ', ' +
                                        this.MiWkAptForAmt + ', ' +
                                        this.DrawMiOutForAmt + ')">';
                                    html += '<td colspan="2">' + this.DeptDiv1 + '</td>';
                                } else {
                                    if (this.DeptDiv1) {
                                        if (this.ExternalGubnNm === 'TOTAL') {
                                            cls = 'class="orange"';
                                        } else {
                                            cls = 'class="green"';
                                        }
                                        html += '<tr onclick="setChartData(this, \'' + this.ExternalGubnNm + '(' + this.DeptDiv1 + ')\', ' +
                                            this.MiInvoiceForAmt + ', ' +
                                            this.MiBillForAmt + ', ' +
                                            this.MiReceiptForAmt + ', '+
                                            this.MiProductForAmt + ', ' +
                                            this.MiWkAptForAmt + ', ' +
                                            this.DrawMiOutForAmt + ')">';
                                        html += '<td ' + cls + '>' + this.ExternalGubnNm + '</td>';
                                        html += '<td ' + cls + '>' + this.DeptDiv1 + '</td>';
                                    } else {
                                        cls = 'class="green"';

                                        html += '<tr onclick="setChartData(this, \'' + this.ExternalGubnNm + '\', ' +
                                            this.MiInvoiceForAmt + ', ' +
                                            this.MiBillForAmt + ', ' +
                                            this.MiReceiptForAmt + ', '+
                                            this.MiProductForAmt + ', ' +
                                            this.MiWkAptForAmt + ', ' +
                                            this.DrawMiOutForAmt + ')">';
                                        html += '<td ' + cls + ' colspan="2">' + this.ExternalGubnNm + '</td>';
                                    }
                                }
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.MiInvoiceForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.MiBillForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.MiReceiptForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.MiProductForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.MiWkAptForAmt, 2) + '</td>';
                                html += '<td ' + cls + ' style="text-align: right;">' + JLAMP.common.currencyFormat(this.DrawMiOutForAmt, 2) + '</td>';
                                html += '</tr>';
                            });
                        } else {
                            html = '<tr><td style="border-bottom: 0" colspan="7"><div class="setNoRecords text-center"><span>조회된 데이터가 없습니다.</span></div></td></tr>';
                        }

                        jq("#list_html").html(html);
                        // setListHeight();
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

            jq('#chart').html('<img style="margin:40px; 0" src="/image/no_chart.png">');
            jq("#list_html tr:first-child").click();
        }
    });
};

function setChartData(obj, colName, miInvoiceForAmt, miBillForAmt, miReceiptForAmt, miProductForAmt, miWkAptForAmt, drawMiOutForAmt) {
    if (!miInvoiceForAmt && !miBillForAmt && !miReceiptForAmt && !miProductForAmt && !miWkAptForAmt && !drawMiOutForAmt) return;

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
                position: "center",
                visible: true,
                background: "transparent"
            }
        },
        series: [{
            type: "pie",
            data: [{
                category: "미출고금액계",
                value: miInvoiceForAmt
            }, {
                category: "계산서미발행금액",
                value: miBillForAmt
            }, {
                category: "미수금금액",
                value: miReceiptForAmt
            }, {
                category: "생산미출고금액",
                value: miProductForAmt
            }, {
                category: "생산미접수금액",
                value: miWkAptForAmt
            }, {
                category: "생산미출도금액",
                value: drawMiOutForAmt
            }]
        }],
        tooltip: {
            visible: true,
            template: "#= category # - #= kendo.format('{0:P}', percentage) #"
        }
    });
} // end of function setChartData


jq('#camera').click(function () {
    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        location.href = 'jmobile://getCamera';
    } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
        if (window.JMobile) window.JMobile.getCamera();
    }
});

function setCameraPath(imagePath) {

}

jq('#gps').click(function () {
    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        location.href = 'jmobile://getLocation';
    } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
        if (window.JMobile) window.JMobile.getLocation();
    }
});

function setLocation(latitude, longitude) {
    alert(latitude);
}

jq('#QRCode').click(function () {
    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        location.href = 'jmobile://getQRcode';
    } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
        if (window.JMobile) window.JMobile.getQRcode();
    }
});

function setQRcodeResult(content) {
    alert(content);
}

jq('#info').click(function () {
    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        location.href = 'jmobile://getDeviceInfo';
    } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
        if (window.JMobile) window.JMobile.getDeviceInfo();
    }
});

function setDeviceInfo(deviceInfo) {
    alert(deviceInfo);
}

jq('#contact').click(function () {
    location.href = 'jmobile://getContact';
});

function setContact(number) {
    jq('#content').val(number);
}