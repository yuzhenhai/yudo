<?php /* Template_ 2.2.6 2017/12/01 10:50:10 /home/merp.yudosuzhou.com/public_html/JLAMP_application/modules/MAN2/views/hello.html 000001058 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>


<div id="slide_panel">
    <p>Hello Wrold!</p>

    <p>Yudo Suzhou</p>

    <input type="button" id="btnHello" value="Hello">
    <button id="camera">Camera</button>
    <button id="gps">GPS</button>
    <button id="qrcode">Qrcode</button>
    <button id="info">Device Info</button>
    <button id="contact">Contact</button>
    <button id="network_status">NetWork Status</button>
    <button id="gallery">Gallery</button>
    <button id="loading">Loading</button>
    <form action="post" onsubmit="return doUpload()" id="upload_form">
        <input type="file" id="upload_file" name="upload_file">
        <input type="submit" id="upload_btn" value="Upload">
    </form>

    <img src="" alt="OriginImage" id="origin_image">
    <img src="" alt="ThumbImage" id="thumb_image">

    <input type="text" id="text">

</div>

<?php $this->print_("footer",$TPL_SCP,1);?>