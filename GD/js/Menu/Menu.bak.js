jq(document).ready(function() {
	doMenuRows();
	if (jq("#menu_selection").val() == '' || jq("#menu_selection").val() == null) {
		goMenu('mi');
	} else {
		goMenu(jq("#menu_selection").val());
	}
    jq(function() {
        FastClick.attach(document.body);
    });
});

/**
 * 메소드명: doMenuRows
 * 작성자: 김영탁
 * 설 명:  메뉴 리스트 가져오기 Process
 *
 * 최초작성일: 2018.01.26
 * 최종수정일: 2018.01.26
 * ---
 * Date              Auth        Desc
*/

function doMenuRows(){
	var formKey = jq("#form_key").val();
	var html = '';
	jq.ajax({
		url: '/Menu/doMenuRows_prc',
		data: {
			formKey: formKey
		},
		type: 'get',
		async: false,
		dataType: 'json',
		success: function(res, status, xhr) {
			if (res.data.menuHtmlInfo.SalesManage) {
				jq("#sm").html(res.data.menuHtmlInfo.SalesManage.html);
			}
			if (res.data.menuHtmlInfo.ManageInfo) {
				jq("#mi").html(res.data.menuHtmlInfo.ManageInfo.html);
			}
			if (res.data.menuHtmlInfo.ASManage) {
				jq("#asm").html(res.data.menuHtmlInfo.ASManage.html);
			}
            if (res.data.menuHtmlInfo.Assemble) {
				jq("#mt").html(res.data.menuHtmlInfo.Assemble.html);
            }//新加
		},
		error: function (xhr, status, error) {
			alert(error);
		},
		complete: function (xhr, status) {
		}
	});
} // end of function doMenuRows

var first = false
function doBack() {
    if(first == false){
        first = true;
        mui.toast('再按一次退出应用');
        setTimeout(function(){
            first = false;
        },2000);
    } else {
        // if(new Date().getTime() - first < 2000){
            if (window.JMobile)  window.JMobile.doExit();
        // }
    }
}
// function doBack() {
//     doLogout();  //返回上一页
// }

/**
 * 메소드명: goMenu
 * 작성자: 김영탁
 * 설 명:  메뉴 리스트 가져오기 Process
 *
 * 최초작성일: 2018.01.26
 * 최종수정일: 2018.01.26
 * ---
 * Date              Auth        Desc
*/
//控制主菜单切换
function goMenu(m) {
    jq(".cateList").addClass("hide");
    jq("#"+m).removeClass("hide");

    jq("img[name='menu']").addClass('alpha');
    jq("#"+m+"Menu").removeClass("alpha");
} // end of function goMenu