<?php /* Template_ 2.2.6 2017/12/01 10:55:14 /home/merp.yudosuzhou.com/public_html/JLAMP_application/modules/MAN4/views/MAN4.html 000001653 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<div id="slide_panel" style="padding-top: 50px">
    Hello world!!!
    <p>
        YUDO SUZHOU
    </p>
    <div style="padding-bottom: 20px">
        <button id="btnMan4">OK</button>
        <button id="btnMan4Table">Today</button>
        <button id="btnCamera">Camera</button>
        <button id="btnGPS">GPS</button>
    </div>
    <div style="padding-bottom: 20px">
        <button id="btnQR">QR</button>
        <button id="btnDevices">Device</button>
        <button id="btnContact">Contact</button>
        <button id="btnNetWork">NetWork</button>
    </div>
    <div style="padding-bottom: 20px">
        <button id="btnImage">Gallery</button>
        <button id="btnVersion">Version</button>
        <button id="btnLoading">Loading</button>
        <button id="btnHide">Hide</button>
    </div>
    <div>Lat:<input type="text" id="txLat"/></div>
    <div>Lng:<input type="text" id="txLng"/></div>
    QRResult:<input type="text" id="result"/>
    <div id="devices"></div>
    <div id="contact"></div>
    <div id="net"></div>
    <div id="image"></div>
    <div id="version"></div>
    <form id="pic_form" name="pic_form" action="post" onsubmit="return doUpload()">
        <div><input type="file" id="upload_file" name="upload_file"></div>
        <div><input type="submit" id="btn_upload" value="Upload" class="bn_normal_100"></div>
    </form>
    <img alt="" id="oImg">
    <img alt="" id="iImg">
</div>
<?php $this->print_("footer",$TPL_SCP,1);?>