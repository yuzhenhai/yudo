jq(document).ready(function() {
    jq('#base_date').datetimepicker({
        language: m_commCultureType,
        format: 'yyyy-mm-dd',
        autoclose: true,
        startView: JLAMP.datetimepicker.viewType.DAY,
        minView: JLAMP.datetimepicker.viewType.DAY,
        maxView: JLAMP.datetimepicker.viewType.YEAR,
        keyboardNavigation: true,
        viewSelect: 'month',
        pickerPosition: 'bottom-right'
    });

    var date = new Date();
    jq('#base_date').datetimepicker('setDate', date);

    jq('#textSC').keyup(function() {
        var val = {
            obj: this,
            space: false,
            br: false,
            allowSC: false
        };
        JLAMP.common.repSpecialChar(val); 
    });
});
