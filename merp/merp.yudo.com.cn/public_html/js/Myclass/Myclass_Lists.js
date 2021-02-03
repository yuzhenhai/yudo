var m_marginSize = 2;
var m_forAmt_pre = [];
var m_forAmt = [];
var m_last_year = '';
var m_this_year = '';
var m_externalGubunNm = [];
var m_langCode = '';

jq(document).ready(function() {
    // Bootstrap DatePicker
    jq('#monthly').monthpicker({
        years: [2018,2017,2016,2015, 2014, 2013, 2012, 2011],
        topOffset: 6
    })
    // jq("#base_date").datetimepicker({
		// language: m_commCultureType,
		// format: "yyyy-mm-dd",
		// inputFormat:  "yyyy-mm-dd",
		// autoclose: true,
		// startView: JLAMP.datetimepicker.viewType.DAY,
		// minView: JLAMP.datetimepicker.viewType.DAY,
		// maxView: JLAMP.datetimepicker.viewType.YEAR,
		// keyboardNavigation: true,
		// viewSelect: 'month',
		// pickerPosition: "bottom-right"
    // });
    
    // 금일날짜 세팅
    // var date = new Date();
    // jq("#base_date").datetimepicker("setDate", date);

    //jq("#lang_code").kendoDropDownList();
    
	jq("#gubun").kendoDropDownList();

    setListWidth();

    // 조회 버튼 클릭 이벤트
    jq("#btn_search").click(function() {
        doSearch();
    });
    // 리스트 버튼 클릭 이벤트
    jq("#btn_menu_lists").click(function() {
		location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
    });

	jq("#btn_search").val(JLAMP.lang.getWord('W2018020109095825029'));
	jq("#btn_menu_lists").val(JLAMP.lang.getWord('W2018020109110962726'));
	jq("#base_date").keyup(function() {
		JLAMP.common.repNumberKey(this,'');
		if (jq("#base_date").val().length >4 && jq("#base_date").val().length <= 6) {
			jq("#base_date").val(jq("#base_date").val().substring(0,4)+'-'+jq("#base_date").val().substring(4,6));
		} else if (jq("#base_date").val().length >6) { 
			jq("#base_date").val(jq("#base_date").val().substring(0,4)+'-'+jq("#base_date").val().substring(4,6)+'-'+jq("#base_date").val().substring(6,8));
		}
	});
});

jq(window).resize(function() {
    var screenWidth = jq(this).width();
    var chart = jq("#chart").data("kendoChart");
    if (chart) {
        jq("#chart").css({width: screenWidth});
        chart.redraw();
    }
});

function setListWidth() {
    var screenWidth = jq(this).width();
    jq(".basic_table").parent().width(screenWidth - m_marginSize);
}

function setListHeight() {
    var listHeight = jq(".basic_table").height();
    //jq(".basic_table").parent().height(listHeight + m_marginSize);
    jq(".basic_table").parent().animate({
        height: listHeight + m_marginSize
    }, 500)
}

/**
 * 메소드명: doSearch
 * 작성자: 김목영
 * 설 명: 영업집계표(일) 조회 Process
 *
 * 최초작성일: 2017.11.10
 * 최종수정일: 2017.11.10
  * ---
  * Date              Auth        Desc
  */
function reviseDom(ress,reClass,check) {
    var nc = '';
    var nd = '';
    var Cause = ress['data'];
    var all_col = new Array(0,0,0,0,0,0,0);  //三个类别每列数据总和
    var all_row = 0; //三个类别所有列数据总和
    var array_v = new Array('tate1','tate2','tate3','tate4','tate5','tate6','tate7');

    for(var amp in Cause){
        var NextCause = Cause[amp];
        if(NextCause.length > 0 )
        {
            var rows_Alltotel = 0;		//所有行总和
            var col_totel = new Array(0,0,0,0,0,0,0);	//当前类别每列数据总和
			//--------------------------------
            for (var tmp in NextCause) {
                var rows_totel = 0;		//单行总和
                nc += '<tr><td style="background-color:#98989c;color:#FFFFFF;width:auto">' + NextCause[tmp]['CauseName']+ '</td>'+
                    '<td style="background-color:#339966;color:#FFFFFF;width:auto">' + NextCause[tmp]['CauseClass'] + '</td>';
                for (var tate in array_v){
                	col_totel[tate] += NextCause[tmp][array_v[tate]];  //每列数据相加
                    all_col[tate] += NextCause[tmp][array_v[tate]];  //每列求和计入总数据
					rows_totel += NextCause[tmp][array_v[tate]];	//单行总和
                	nc += '<td class="green" style="width:30px">'+NextCause[tmp][array_v[tate]]+'</td>';
				}
                nc += '<td class="yellow" style="width:30px;background: yellow">' + rows_totel + '</td>' +
                    '</tr>';
            }

            //--------------end----------------
            if (NextCause.length < 9)
            {
                jq('.table-responsive').css('height', 30 * (NextCause.length + 3));
            }
            else
            {
                jq('.table-responsive').css('height', '300px');
            }
            nc += '<tr><td style="background-color:yellow;color:#484848;width:auto">Total</td>' +
                '<td style="background-color:yellow;color:#484848;width:auto"></td>';
            for (var tate in col_totel) //每列总和
			{
				nc += '<td class="green" style="width:30px;background: yellow;color:#484848;">' + col_totel[tate] + '</td>';
                rows_Alltotel += col_totel[tate]; // 所有列总和
			}
            nc += '<td class="yellow" style="width:30px;background: yellow">' + rows_Alltotel + '</td>' +
                '</tr>';
        }
	}
	nd += '<tr><td style="background-color:#47beee;color:#484848;width:auto">Inc Rate</td>' +
        '<td style="background-color:#47beee;color:#484848;width:auto"></td>';
    if(check == 1)
    {
        nc += '<tr><td style="background-color:#ffb100;color:#484848;width:auto">Grand Total </td>' +
            '<td style="background-color:#ffb100;color:#484848;width:auto"></td>';
        for(var nums in all_col)    //所有列总和数据
        {
            all_row += all_col[nums];
        }

        for(var nums in all_col)    //每列求和数据
		{
			nc += '<td class="green" style="width:30px;background: #ffb100;color:#484848;">' + all_col[nums] + '</td>';
			//每列总和占比数据
			nd += '<td style="width:30px;background: #47beee;color:#484848;">' + ((all_col[nums]/all_row)*100).toFixed(2) + '%</td>';
		}
        nc += '<td class="yellow" style="width:30px;background: #ffb100">' + all_row+ '</td>' +
            '</tr>';
        nd += '<td class="yellow" style="width:30px;background: #47beee">100%</td>' +
            '</tr>';
        setChartData((all_col[0] / all_row).toFixed(10),
            (all_col[1] / all_row).toFixed(10),
            (all_col[2] / all_row).toFixed(10),
            (all_col[3] / all_row).toFixed(10),
            (all_col[4] / all_row).toFixed(10),
            (all_col[5] / all_row).toFixed(10),
            (all_col[6] / all_row).toFixed(10)); //显示圆形图表
    }
    else
    {
        for(var nums in col_totel)    //每列求和数据
        {
            //每列总和占比数据
            nd += '<td style="width:30px;background: #47beee;color:#484848;">' + ((col_totel[nums]/rows_Alltotel)*100).toFixed(2) + '%</td>';
        }
        nd += '<td class="yellow" style="width:30px;background: #47beee">100%</td>' +
            '</tr>';
        setChartData((col_totel[0] / rows_Alltotel).toFixed(10),
            (col_totel[1] / rows_Alltotel).toFixed(10),
            (col_totel[2] / rows_Alltotel).toFixed(10),
            (col_totel[3] / rows_Alltotel).toFixed(10),
            (col_totel[4] / rows_Alltotel).toFixed(10),
            (col_totel[5] / rows_Alltotel).toFixed(10),
            (col_totel[6] / rows_Alltotel).toFixed(10)); //显示圆形图表
    }
    nc+=nd;
	jq('#list_html').html(nc);
}
function doSearch() {
	m_forAmt_pre = [];
	m_forAmt = [];
	m_externalGubunNm = [];
	var beforeExternalGubn = '';
	var afterExternalGubn = '';
	var beforeSort = '';
	var afterSort = '';
    var html = '';
    var baseDate = jq("#monthly").val(); // 기준일
    var gubun = jq("#gubun").val(); // 구분
	var contract = JLAMP.lang.getWord('W2018020113545170008');
	var deliver = JLAMP.lang.getWord('W2018020113594302716');
	var invoice = JLAMP.lang.getWord('W2018020114034047074');
	var deposit = JLAMP.lang.getWord('W2018020114062894053');
	var prodRel = JLAMP.lang.getWord('W2018020114105503016');
    // if (!baseDate) {
		// alert('기준일은 필수입력입니다.');
		// return false;
    // }

	// Loading Indicator
	JLAMP.common.loading('body', 'pulse');

	jq.ajax({
		url: '/Myclass/Myclass/search_data',
		data: {
			gubun: gubun,
			baseDate: baseDate
		},
		type: 'get',
		dataType: 'json',
		success: function(ress) {
			console.log(ress);
            if (ress['returnCode'] == 0) {
                var reClass = ress['returnClass'];
                if(reClass == 'ALL')
				{
                    reviseDom(ress,reClass,1); //查询所有
				}
				else
				{
                    reviseDom(ress,reClass,0); //查询其中一项
				}
            }
            else
            {
                alert(ress.returnMsg);
            }
		},
        error: function(xhr, status, error) {
            // iOS에서 네트워크 에러인 경우 에러 페이지 표시
        	if (JLAMP.common.getDevicePlatform() === JLAMP.devicePlatform.iOS && xhr.status == 0) {
        		location.href = "jmobile://callErrorPage";
        	} else 
        		alert(error);
        },
        complete: function(xhr, status) {
			JLAMP.common.loadingClose('body');

            JLAMP.common.mergeRows('.basic_table', 0, 1);

            jq("#list_html tr:first-child").click();
        }
    });
} // end of function doSearch

//圆形图表方法 2018.4.4
function setChartData(tabels1,tabels2,tabels3,tabels4,tabels5,tabels6,tabels7) {
    var chartTitle1 = JLAMP.lang.getWord('W2018020109142066061');
    var chartTitle2 = JLAMP.lang.getWord('W2018020109152826082');
    var chartTitle3 = JLAMP.lang.getWord('W2018020109163152302');
    var chartTitle4 = JLAMP.lang.getWord('W2018020109171409099');
    var chartTitle5 = JLAMP.lang.getWord('W2018020109185311787');
    jq("#chart").kendoChart({
        title: {
            text: '故障统计'
        },
        legend: {
            position: "top"
        },
        seriesDefaults: {
            labels: {
                template: "#= category # - #= kendo.format('{0:P}', percentage)#",
                position: "insideEnd",
                visible: true,
                background: "transparent"
            }
        },
        series: [{
            type: "pie",
            data: [{
                category: '漏胶',
                value: tabels1,
				background:'#FFFF00'
            }, {
                category: '丢失赠送',
                value: tabels2
            }, {
                category: '客户现场',
                value: tabels3
            }, {
                category: '部件不良',
                value: tabels4
            }, {
                category: '阀针异常',
                value: tabels5
            },{
                category: '产品成型不良',
                value: tabels6
            },{
                category: '加工/组装异常',
                value: tabels7
            }]
        }],
        tooltip: {
            visible: true,
            template: "#= category # - #= kendo.format('{0:P}', percentage) #"
        }
    });
}
//end
