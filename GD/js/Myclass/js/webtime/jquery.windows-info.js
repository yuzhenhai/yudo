$(function(){
    $('#moumove').css({left:$('#menu-button-1').offset().left-10+'px',width:$('#menu-button-1').find('span').width()+30+'px',display:'block'},200);
    var app = new Vue({
        el: '#nav',
        data: {
            show:true,
            msg1:'项目预览 ·',
            msg2:'团队介绍 ·',
            msg3:'技术记录 ·',
            msg4:'研究中心 ·',
            menutext:'▤',
        },
        methods:{
            menu_func:function(event){
                var Object = event.currentTarget;
                var leftpx = $(Object).offset().left;
                var widthpx = $(Object).find('span').width();
                $('#moumove').css({'left':leftpx-10+'px','width':widthpx+20+'px'});
            },
            menu_func1:function(event){
                $('#moumove').css({'width':'0px'});
            },
            main_open:function(event){
                var this_height = $('#main').css('height');
                $('#main').css({'height':this_height!='0px' ? 0:'100%'});
                $(event.currentTarget).css({'background':$(event.currentTarget).css('background-color')=='rgb(79, 75, 75)' ? '#cf1333':'#4F4B4B'});
                app.menutext = app.menutext!='✖' ? '✖':'▤';
            },
        }
        });
});
