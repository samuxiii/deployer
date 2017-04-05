/*
 * TODO: the url server should be in a config file 
 */
url_server = "http://srv.betawrapper.com/lab/deployer/server/tools.php";

$(document).ready(function() {

    $('button#pull').click(function() {
        $.ajax({
            url: url_server,
            type: "POST",
            data: {"action":"pull"},
            success: function(data){
                $('div#result-pull').html(data);
                console.log(data);
            }
        });
    });

    $('button#deploy').click(function() {
        $.ajax({
            url: url_server,
            type: "POST",
            data: {"action":"deploy"},
            success: function(data){
                $('div#result-deploy').html(data);
                console.log(data);
            }
        });
    });

    $('button#update').click(function() {
        $.ajax({
            url: url_server,
            type: "POST",
            data: {"action":"update"},
            success: function(data){
                $('div#result-update').html(data);
                console.log(data);
            }
        });
    });

});