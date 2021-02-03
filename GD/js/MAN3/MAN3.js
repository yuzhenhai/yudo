jq(document).ready(function () {
    jq('#button').click(function () {
        var formKey = jq('#form_key').val();
        // location.href = '/MAN3/dblist?formKey='+formKey;

        location.href = '/MAN3/WEI?formKey=' + formKey;
    });


    jq('#camera').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            location.href = 'jmobile://getCamera';
        } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
            if (window.JMobile) window.JMobile.getCamera();
        }
    });


    jq('#gps').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            location.href = 'jmobile://getLocation';
        } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
            if (window.JMobile) window.JMobile.getLocation();
        }
    });


    jq('#QRCode').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            location.href = 'jmobile://getQRcode';
        } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
            if (window.JMobile) window.JMobile.getQRcode();
        }
    });


    jq('#info').click(function () {
        if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS) {
            location.href = 'jmobile://getDeviceInfo';
        } else if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.Android) {
            if (window.JMobile) window.JMobile.getDeviceInfo();
        }
    });

    jq('#contact').click(function () {
        location.href = 'jmobile://getContact';
    });


    jq('#xiangji').click(function () {
        location.href = 'jmobile://getGallery';
    });

    jq('#app').click(function () {
        location.href = 'jmobile://getVersion';
    });

    jq('#network').click(function () {
        location.href = 'jmobile://getNetworkStatus';
    });

    jq('#load').click(function () {
        location.href = 'jmobile://showLoadingIndigator';
    });

    jq('#hide').click(function () {
        location.href = 'jmobile://hideLoadingIndigator';
    });
});

function setCameraPath(imagePath) {

}

function setLocation(latitude, longitude) {
    alert(latitude);
}

function setQRcodeResult(content) {
    alert(content);
}

function setDeviceInfo(deviceInfo) {
    alert(deviceInfo);
}

function setNetworkStatus(status) {
    alert(status);
}

function setContact(number) {
    // jq('#content').val(number);
    location.href = 'jmobile://doCall?number=' + number;
}

function setGalleryPath(path) {
    alert(path);
}

function setVersion(version) {
    alert(version);
}

function doUpload() {
    location.href = 'jmobile://showLoadingIndigator';
    var form = jq('#form');
    var formData = new FormData(form[0]);
    jq.ajax({
        url: '/MAN3/MAN3/upload_prc',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (res, status, xhr) {
            if (res) {
                if (res.returnCode == 0) {
                    alert('success');
                    var path = res.data.upload_data.file_path.split('public_html');
                    jq('#imgSrc1').attr('src', path[1]+res.data.upload_data.file_name);
                    jq('#imgSrc2').attr('src', path[1]+'thumb/'+res.data.upload_data.file_name);
                } else {
                    alert(res.returnMsg);
                }
            }
        },
        error: function (xhr, status, error) {
            alert(error);
        },
        complete: function (xhr, status) {
            alert(status);
            location.href = 'jmobile://hideLoadingIndigator';
        }
    });
    return false;
}
