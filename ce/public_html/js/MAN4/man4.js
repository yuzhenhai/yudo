jq(document).ready(function () {
    jq('#btnMan4').click(function () {
        var formKey = jq('#form_key').val();
        window.location.href = '/MAN4/dbList?formKey=' + formKey;
    });
    jq('#btnMan4Table').click(function () {
        var formKey = jq('#form_key').val();
        window.location.href = '/MAN4/man4001?formKey=' + formKey;
    });
    jq('#btnCamera').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            window.location.href = 'jmobile://getCamera';
        } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
            if (window.JMobile)window.JMobile.getCamera();
        }
    });
    jq('#btnGPS').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            window.location.href = 'jmobile://getLocation';
        } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
            if (window.JMobile)window.JMobile.getLocation();
        }
    });

    jq('#btnQR').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            window.location.href = 'jmobile://getQRcode';
        } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
            if (window.JMobile)window.JMobile.getQRcode();
        }
    });

    jq('#btnDevices').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            window.location.href = 'jmobile://getDeviceInfo';
        }
    });

    jq('#btnContact').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            window.location.href = 'jmobile://getContact';
        }
    })
    jq('#btnNetWork').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            window.location.href = 'jmobile://getNetworkStatus';
        }
    });
    jq('#btnImage').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            window.location.href = 'jmobile://getGallery';
        }
    });
    jq('#btnVersion').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            window.location.href = 'jmobile://getVersion';
        }
    });
    jq('#btnLoading').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            //window.location.href = 'jmobile://showLoadingIndicator';
            window.location.href = 'jmobile://showLoadingIndigator';
        }
    });
    jq('#btnHide').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            //window.location.href = 'jmobile://hideLoadingIndicator';
            window.location.href = 'jmobile://hideLoadingIndigator';
        }
    });
});
function setLocation(lat, lng) {
    jq('#txLat').val(lat);
    jq('#txLng').val(lng);
}

function setQRcodeResult(content) {
    jq('#result').val(content);
}

function setDeviceInfo(deviceInfo) {
    jq('#devices').text(deviceInfo);
}

function setContact(number) {
    jq('#contact').text(number);
    var phone = number;
    if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
        window.location.href = 'jmobile://doCall?number=' + phone;
    }
}

function setNetworkStatus(status) {
    switch (status) {
        case JLAMP.deviceNetworkStatus.STATUS_WIFI:
            jq('#net').text('is wifi');
            break;
        case JLAMP.deviceNetworkStatus.STATUS_MOBILE:
            jq('#net').text('is mobile');
            break;
        case JLAMP.deviceNetworkStatus.STATUS_DISCONNECT:
            jq('#net').text('connect failed');
            break;
    }
}

function setGalleryPath(path) {
    jq('#image').text(path);
}

function setVersion(version) {
    jq('#version').text(version);
}

function doUpload() {
    var form = jq('#pic_form');
    var formData = new FormData(form[0]);
    JLAMP.common.loading('body', 'pulse');
    jq.ajax({
        url: '/MAN4/MAN4/upload_prc',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (res, status, xhr) {
            if (res) {
                if (res.returnCode == 0) {
                    if (res.data.upload_data) {
                        //var url = 'http://merp.yudo.com.cn:8183/';
                        var path1 = res.data.upload_data.full_path.substring(res.data.upload_data.full_path.indexOf('data'));
                        var path2 = res.data.upload_data.file_path.substring(res.data.upload_data.file_path.indexOf('data'));
                        jq('#oImg').attr('src', '/' + path1);
                        jq('#iImg').attr('src', '/' + path2 + 'thumb/' + res.data.upload_data.orig_name);
                    }
                }
            } else {
                alert(res.returnMsg);
            }
        },
        error: function (xhr, status, error) {
            alert(error);
        },
        complete: function (xhr, status) {
            JLAMP.common.loadingClose('body');
        }
    });
    return false;
}