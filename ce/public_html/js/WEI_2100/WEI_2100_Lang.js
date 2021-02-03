
var langCodeClass = function(){

    this.langUrl = '/JLAMPCommon/langBatchRows_prc'
    this.dataList = [];

    this.getWord = function(List,backFunc){
        this.dataList = List;
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
                langCode.returnList(res.data,backFunc)
            }
        });
    }
    this.returnList = function (res,backFunc) {
        for(var list in this.dataList){
            this.dataList[list] = res[this.dataList[list]].LabelCaption
            console.log(list);
        }
        backFunc(this.dataList);
    }
}
var langCode = new langCodeClass();
