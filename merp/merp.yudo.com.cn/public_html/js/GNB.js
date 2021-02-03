jq(document).ready(function() {
	var browserPathName = window.location.pathname;
	
	// 로그인화면인 경우 SlideMenu 미적용
	if(browserPathName != '/') {
		jq('.navbar-fixed-top.top_header').css('display', 'block');
		//jq("#slide_menu").css('margin-top', "50px");
		
		/*
    	var slideout = new Slideout({
    	    'panel': document.getElementById('slide_panel'),
    	    'menu': document.getElementById('slide_menu'),
    	    'padding': 256,
    	    'tolerance': 70,
    	    'touch': false 
    	  });
    	
    	jq('.toggle-button').click(function() {
    		slideout.toggle();
    	});
    	
    	slideout.on('beforeopen', function() {
    		jq('.toggle-button').addClass('drawer-open');
    	});
    	
    	slideout.on('beforeclose', function() {
    		jq('.toggle-button').removeClass('drawer-open');
    	});
		*/
	} else {
		jq('.navbar-fixed-top.top_header').css('display', 'none');
		//jq("#slide_menu").css('margin-top', 0);
	}
});

/**
 * 메소드명: setMenu
 * 작성자: 김희태
 * 설 명: 메뉴 HTML을 가져와 표시한다.
 *
 * 최초작성일: 2016.10.11
 * 최종수정일: 2016.10.11
 */
function setMenu() {
	/*
	var browserPathName = window.location.pathname;
	
	// Loading Indicator
    JLAMP.common.loading('body', 'pulse');
    
    jq.ajax({
        url: "/common/menu_prc",
        type: "post",
        dataType: "json",
        async: false,
        success: function (res, status, xhr) {
            if (res) {
                if (res.returnCode == 0) {
                    jq("#slide_menu").html(res.data);
                } else {
                    if(res.returnMsg) {
                        var msg = res.returnMsg;
                        msg = msg.replace(/\\n/g,'\n');
                        alert(msg);
                    }
                }
            }
        },
        error: function (xhr, status, error) {
            alert(error);
        },
        complete: function (xhr, status) {
            JLAMP.common.loadingClose('body');
        }
    });
	*/
	//location.href='/Menu/Menu/menuLists?formKey'+jq("#form_key").val();
}