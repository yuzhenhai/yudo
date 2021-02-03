jq(document).ready(function() {
    jq("#btnHello").click(function() {
        var formKey = jq("#form_key").val();
        location.href='/MAN1/MAN1/DBList?formKey='+formKey;
    });

    jq("#btnWEI_1300").click(function() {
        var formKey = jq("#form_key").val();
        location.href='/MAN1/MAN1/WEI_1300?formKey='+formKey;
    });

    jq("#btnExecCamera").click(function() {
        if (JLAMP.common.getDevicePlatform() == JLAMP.devicePlatform.iOS)
            location.href='jmobile://getCamera';
    });

    jq("#btnGPS").click(function() {
        if (JLAMP.common.getDevicePlatform() == JLAMP.devicePlatform.iOS)
            location.href='jmobile://getLocation';
    });

    jq("#btnQR").click(function() {
        if (JLAMP.common.getDevicePlatform() == JLAMP.devicePlatform.iOS)
            location.href='jmobile://getQRcode';
    });

    jq("#btnContact").click(function() {
        if (JLAMP.common.getDevicePlatform() == JLAMP.devicePlatform.iOS)
            location.href='jmobile://getContact';
    });

    jq("#btnGallery").click(function() {
        if (JLAMP.common.getDevicePlatform() == JLAMP.devicePlatform.iOS)
            location.href='jmobile://getGallery';
    });

    jq("#btnLoadIn").click(function() {
        if (JLAMP.common.getDevicePlatform() == JLAMP.devicePlatform.iOS)
            location.href = 'jmobile://showLoadingIndigator';
    });

    jq("#btnHideIn").click(function() {
        if (JLAMP.common.getDevicePlatform() == JLAMP.devicePlatform.iOS)
            location.href = 'jmobile://hideLoadingIndigator';
    });

    
})

function setLocation(lat,lng) {
    jq("#txtLat").val(lat);
    jq("#txtLng").val(lng);
}

function setQRcodeResult(res) {
    jq("#txtQR").val(res);
}

function setContact(res) {
    jq("#txtContact").val(res);
}

function setGalleryPath(res) {
    jq("#txtGallery").val(res);
}

function doUpload() {
    var form = jq("#frm_jmobile");
    var formData = new FormData(form[0]);

    if (JLAMP.common.getDevicePlatform() == JLAMP.devicePlatform.iOS)
        location.href = 'jmobile://showLoadingIndigator';

    jq.ajax({
        url: '/MAN1/MAN1/upload_prc',
        type: 'post',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(res, status, xhr) {
            if (res) {
                if (res.returnCode == 0) {
                    if (res.data.upload_data) {;
                        var file_path = res.data.upload_data.file_path;
                        var path = file_path.substring(file_path.indexOf('data'));
                        jq("#thumb_img").attr('src', 'http://merp.yudo.com.cn:8183/'+path+'thumb/'+res.data.upload_data.orig_name);
                        jq("#org_img").attr('src', 'http://merp.yudo.com.cn:8183/'+path+res.data.upload_data.orig_name);
                        jq("#img_area").show();
                    }
                }  else {
                    alert(res.returnMsg);
                }
            }
        },
        error: function (xhr, status, error) {
            alert(error);
        },
        complete: function (xhr, status) {
            if (JLAMP.common.getDevicePlatform() == JLAMP.devicePlatform.iOS)
                location.href = 'jmobile://hideLoadingIndigator';
        }
    });

    return false;
}