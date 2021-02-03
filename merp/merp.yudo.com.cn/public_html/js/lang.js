
var langCode = {
    langUrl:'/JLAMPCommon/langBatchRows_prc',
    dataList:[],
    method:'http',

    getWord:function(List,backFunc){
        // this.dataList = List;
        var _wordId = [];
        for(var list in List){
            _wordId.push(List[list])
        }
        var _wordIdListJson = JSON.stringify(_wordId);
        jq.ajax({
            url: langCode.langUrl,
            data: {keys:_wordIdListJson},
            type: 'post',
            dataType: 'json',
            success: function (res) {
                langCode.returnList(res.data,List,backFunc)
            }
        });
    },
    returnList:function (res,dataList,backFunc) {
        for(var item in dataList){
            try{
                dataList[item] = res[dataList[item]].LabelCaption
            }catch (e) {
                console.log('error : '+item)
            }
            console.log(item);
        }
        backFunc(dataList);
    }
}
