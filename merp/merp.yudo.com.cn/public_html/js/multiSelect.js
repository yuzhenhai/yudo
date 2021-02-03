
var multiObject = {
    case:{
        ulClass:'jlamp-select',
        ulAction:'jlamp-select-action',
        liDefaultColor:'#ffffff',
        liTapColor:'#DCDCDC',
        liNull:'NO DATA',
        loadding:'<i class="layui-anim layui-anim-rotate layui-anim-loop layui-icon layui-icon-loading-1" style="font-size: 20px"></i>',
        warpcount:2,
    },
    //构造
    init:function(selectId,vue,vueData,callback){
        this.options  = document.getElementsByClassName(this.case.ulClass);
        this.input = document.getElementById(selectId);
    },
    //html标签生成
    domUpdate:function(vue,vueDate,m_ul,m_input,_callback,isupdate){
        var dom  = '<ul>';
        //当vue数据为空，则开始轮询加载vue数据
        if(vue[vueDate].length <= 0){
            //当轮询加载次数超过预定，则停止加载
            if(isupdate > this.case.warpcount){
                dom += '<li>'+this.case.liNull+'</li>';
            }
            else
            {
                dom += '<li style="text-align: center">'+this.case.loadding+'</li>';
                setTimeout(function(){
                    multiObject.upDate(vue,vueDate,m_ul,m_input,_callback,isupdate+1);
                }, 1000);
            }
        }
        else {
            for(var i=0;i<vue[vueDate].length;i++){
                dom += '<li>'+vue[vueDate][i].text+'</li>';
            }
        }
        dom += '</ul></div>';
        return dom
    },
    //创建默认元素
    create:function (selectId) {
        this.input = document.getElementById(selectId);
        this.o_element = document.createElement('div');
        this.o_element.classList.add(this.case.ulClass);
        document.getElementById('leon').appendChild(this.o_element);
    },
    //主控制
    actionBind:function (arrs){
        var _compensate = 50;
        arrs.compensate != null ?  _compensate = arrs.compensate : _compensate;
        var _vue     = arrs.vuejs;
        var _vueData = arrs.option;
        var _callback = arrs.callback;
        multiObject.init(arrs.id,arrs.vuejs,arrs.option,arrs.callback);
        this.create(arrs.id);
        var m_ul = this.o_element;
        var m_input = this.input;
        // -- select click
        m_input.addEventListener('click',function(e) {
            //更新全局数据
            // multiObject.init(arrs.id,arrs.vuejs,arrs.option,arrs.callback);
            //引用vue.js参数更新option下拉列表
            multiObject.upDate(_vue,_vueData,m_ul,m_input,_callback,1);
            //设定select定位，大小
            multiObject.selectTap(m_ul,m_input,_compensate,_callback);
            e.stopPropagation();
        });

        document.body.addEventListener('click',function () {
            for(var i=0;i<multiObject.options.length;i++){
                multiObject.options[i].classList.remove(multiObject.case.ulAction);
            }
        })
        // -- option click
        m_ul.addEventListener('click', function(e) {
            multiObject.ulClose(m_ul);
        });
    },
    //设定select
    selectTap:function(m_ul,m_input,compensate){
        m_ul.style.width = m_input.offsetWidth + 'px';
        jq(m_ul).css('top', jq(m_input).position().top + m_input.offsetHeight + compensate + 'px');
        jq(m_ul).css('left', jq(m_input).offset().left + 'px');
        if(m_ul.className.indexOf(multiObject.case.ulAction) > -1) {
            multiObject.ulClose(m_ul);
        }
        else
        {
            multiObject.ulOpen(m_ul);
        }
        //li列表绑定点击事件
    },
    //设定option
    optionTap:function(m_ul,m_input,_callback){
        var mineli = m_ul.getElementsByTagName("li");
        for(var i=0 ;i<mineli.length;i++){
            mineli[i].index = i;
            mineli[i].addEventListener('click', function(e) {
                console.log(1)
                for(var s=0 ;s<mineli.length;s++){
                    mineli[s].style.backgroundColor = multiObject.case.liDefaultColor;
                }
                e.target.style.backgroundColor = multiObject.case.liTapColor;
                // m_input.getElementsByTagName("input")[0].value = e.target.innerText;
                _callback(e.target.innerText,e.target.index,m_ul);
            });
        }
    },
    //更新下拉列表
    upDate:function(vue,vueData,m_ul,m_input,_callback,update){
        //渲染option列表
        m_ul.innerHTML = this.domUpdate(vue,vueData,m_ul,m_input,_callback,update);
        if(vue[vueData].length > 0){
            //当vue有数据时，绑定li点击事件
            this.optionTap(m_ul,m_input,_callback);
        }
    },
    //隐藏
    ulClose:function (go) {
        go.classList.remove(this.case.ulAction);
    },
    //显示
    ulOpen:function (go) {
        for(var i=0;i<this.options.length;i++){
            this.options[i].classList.remove(this.case.ulAction);
        }
        go.classList.add(this.case.ulAction);
    },
}
var multiSelect = Object.create(multiObject);

