<?php /* Template_ 2.2.6 2017/12/01 10:51:27 /home/merp.yudosuzhou.com/public_html/JLAMP_application/modules/MAN3/views/MAN3.html 000001324 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<div id="slide_panel" style="padding-top:50px;">
    Hello world!!!
    <p>
        Hello world!
    </p>
    <input type="button" id="button" value="未进行业绩">

    <input type="button" id="camera" value="摄像机">

    <input type="button" id="gps" value="GPS">

    <input type="button" id="QRCode" value="QRCode">

    <input type="button" id="info" value="INFO">

    <input type="button" id="contact" value="通讯录">

    <input type="button" id="network" value="网络状态">

    <input type="text" id="content">

    <input type="button" id="xiangji" value="相册">

    <input type="button" id="app" value="Build">

    <input type="button" id="load" value="Load" class="bn_normal_100">

    <input type="button" id="hide" value="Hide" class="bn_normal_100">

    <form id="form" name="form" action="post" onsubmit="return doUpload()">
        <div><input type="file" id="upload_file" name="upload_file"></div>
        <div><input type="submit" id="upload" class="bn_normal_100"></div>
    </form>

    <img src="" id="imgSrc1">
    <img src="" id="imgSrc2">
</div>
<?php $this->print_("footer",$TPL_SCP,1);?>