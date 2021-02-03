var leon = new Vue({
    el:'#leon',
    delimiters: ['$((', '))'],
    data:{
        view:{
            downLoadScript:true,
            noData:true,
        },
        lang:{
            title:'访问记录',
            moduleNm:'模块名',
            noData:'',
        },
        input:{
            date:'',
            db:'SZ'
        },
        list:{
            db:[
                {value:'SZ',text:'苏州'},
                {value:'GD',text:'广东'},
                {value:'QD',text:'青岛'}
            ],
            recordlist:[]
        }
    },
    filters: {
        dateHis:function (value) {
            return value.substr(10,9);
        }
    },
    mounted(){
        try{
            langCode.getWord({
                nodata:'W2018062810475725084',//暂无数据
                SUZHOU:'W2019010917151813357',
                GUANGDONG:'W2019010917154884789',
                QINGDAO:'W2019010917160016794',
                search:'W2018082711232500387',//查询
                dataMinute:'G2018102617012216352',//详细数据
                class:'G2018102617013950014',//区分
                menuBack:'W2018071009230638074',   //主菜单
                }, this.lang,this._updateLang
            );
        }catch (e) {
            mui.alert('多语言解析出错!',this.title);
        }
        this.input.date = multi.getNowDate();
    },
    methods:{
        _updateLang:function(res){
            this.view.downLoadScript = false;
            this.list.db = [
                {value:'SZ',text:this.lang.SUZHOU},
                {value:'GD',text:this.lang.GUANGDONG},
                {value:'QD',text:this.lang.QINGDAO}
            ];
        },
        getData:function () {
            mui.showLoading();
            this.list.recordlist = [];
            this.view.noData = true;
            var param = {};
            param.dbChoose = this.input.db;
            param.date = this.input.date;
            http.get('/Menu/ConnectRecord/getConnectRecord',param,res => {
                if(res.returnCode == 0){
                    this.view.noData = false;
                    this.list.recordlist = res.data[0];
                }else{
                    this.view.noData = true;
                }
            });

        },
        getInputDate:function(vue){
            multi.searchDate('date',function (e) {
                this.input[vue] = e.text;
            }.bind(this))
        },
    }
});