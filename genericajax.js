function GenericAjax(url_ajax, parameter, callback){
    $.ajax({
        url: url_ajax, method: "POST", dataType: "json", data: parameter
    }).done(function(res) {
        if (typeof callback === 'function') {
            callback(res);
        }
    }).fail(function(err) {
        console.log(err);
        if (typeof callback === 'function') {
            callback(null);
        }
    });
}