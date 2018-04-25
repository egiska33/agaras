window.formURL = function(formAction)
{
    var port = "";
    if(window.location.port) port = ":"+window.location.port;

    window.location = window.location.protocol+"//"+window.location.hostname+port+formAction;
}

window.getIdFromURL = function()
{
    return Number(window.location.href.split('/').slice(-1)[0]);
}

function compare(a,b) {
    if (a.last_nom < b.last_nom) return -1;
    if (a.last_nom > b.last_nom) return 1;
    return 0;
}

window.appendSyncError = function(errorMsg)
{
    var errorDiv = '<div style="padding: 5px;"><div id="inner-message" class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><span class="syncErrorMsg">'+errorMsg+'</span></div></div>';

    $("#syncError").append(errorDiv);
}
