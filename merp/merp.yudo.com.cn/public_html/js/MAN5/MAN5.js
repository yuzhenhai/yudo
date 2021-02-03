jq(document).ready(function() {
    jq("#btnHello").click(function() {
        var formKey = jq("#form_key").val();
        location.href='/MAN5/dbList?formKey='+formKey;
    })
})