var leon = new Vue({
    el:'#leon',
    delimiters: ['$((', '))'],
    data:{
        view:{
            downLoadScript:true,
        },
        lang:{
            oldPassWd:'请输入当前密码',
            newPassWd:'请输入新密码',
            newPassWd2:'再次输入新密码',
        },
        input:{
            oldPassWd:'',
            newPassWd:'',
            newPassWd2:'',
        },
        list:{

        }
    },
    filters: {

    },
    mounted(){
        try{
            langCode.getWord({
                oldPassWd:'W2019022115215360091',
                newPassWd:'W2019022115220678394',
                newPassWd2:'W2019022115222461077',
                }, this.lang,this._updateLang
            );
        }catch (e) {
            mui.alert('多语言解析出错!',this.title);
        }
        this.view.downLoadScript = false;
    },
    methods:{
        _updateLang:function(res){

        },
        closeChangePassWd:function () {
            location.href='/Menu/Menu/menuLists?formKey='+jq("#form_key").val()+'&menuSelection='+jq("#menu_selection").val();
        },

        savePassWd:function () {
            if(this.input.oldPassWd == '' || this.input.newPassWd == '' || this.input.newPassWd2 == ''){
                mui.alert('输入项不可为空','YUDO');
                return false;
            }else if(this.input.newPassWd != this.input.newPassWd2){
                mui.alert('新密码两次输入不同','YUDO');
                return false;
            }
            var params = {};
            params.oldPassWd = this.input.oldPassWd;
            params.newPassWd = this.input.newPassWd;
            params.newPassWd2 = this.input.newPassWd2;
            http.post('/Menu/ChangePassWd/savePassWd',params,function (res) {
                if(res.returnCode == 0){
                    mui.alert('密码修改成功，重新登录账号生效','YUDO');
                }else if(res.returnCode == 'oldPassWdFalse'){
                    mui.alert('当前使用的密码输入错误','YUDO');
                }else{
                    mui.alert('修改密码过程中出现错误，请稍后再试','YUDO');
                }
            })  
        }
    }
});