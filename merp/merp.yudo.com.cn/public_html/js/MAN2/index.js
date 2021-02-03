jq(document).ready(function() {
    jq('#btnHello').click(function() {
        var formKey = jq('#form_key').val();
        window.location.href = '/MAN2/MAN2/getDBList?formkey=' + formKey;
    });
    jq('#camera').click(function() {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            location.href = 'jmobile://getCamera';
        }
    });
    jq('#gps').click(function() {
        location.href = 'jmobile://getLocation';
    });
    jq('#qrcode').click(function() {
        location.href = 'jmobile://getQRcode';
    });
    jq('#info').click(function() {
        location.href = 'jmobile://getDeviceInfo';
    });
    jq('#contact').click(function() {
        location.href = 'jmobile://getContact';
    });
    jq('#network_status').click(function() {
        location.href = 'jmobile://getNetworkStatus';
    });
    jq('#gallery').click(function() {
        location.href = 'jmobile://getGallery';
    });
    jq('#loading').click(function() {
        //alert(JLAMP.common.getDevicePlatform());
        location.href = 'jmobile://showLoadingIndicator';
    });
});

function setLocation(lat, lng) {
    alert(lat + ',' + lng);
}

function setQRcodeResult(content) {
    alert(content);
}

function setDeviceInfo(info) {
    alert(info);
}

function setContact(contact) {
    alert(contact);
}

function setNetworkStatus(status) {
    if (status === JLAMP.deviceNetworkStatus.STATUS_WIFI) {
        alert('WIFI');
        return false;
    }
    if (status === JLAMP.deviceNetworkStatus.STATUS_MOBILE) {
        alert('MOBILE');
        return false;
    }
    if (status === JLAMP.deviceNetworkStatus.STATUS_DISCONNECT) {
        alert('DISCONNECT');
        return false;
    }
}

function setGalleryPath(path) {
    jq('#text').val(path);
}

function doUpload() {
    var form = jq('#upload_form');
    var formData = new FormData(form[0]);

    location.href = 'jmobile://showLoadingIndigator';

    jq.ajax({
        url: '/MAN2/MAN2/doUpload_prc',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(res, status, xhr) {
            if (res) {
                if (res.returnCode == 0) {
                    // alert('success');
                    var s = res.data.upload_data.file_path.split('data');
                    jq('#origin_image').attr('src', '/data' + s[1] + res.data.upload_data.file_name);
                    jq('#thumb_image').attr('src', '/data' + s[1] + 'thumb/' + res.data.upload_data.file_name);
                } else {
                    alert(res.returnMsg);
                }
            }
        },
        error: function(xhr, status, error) {
            alert(error);
        },
        complete: function(xhr, status) {
            location.href = 'jmobile://hideLoadingIndigator';
        }
    });

    return false;
}