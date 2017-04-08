/*
 * TODO: the url server should be in a config file 
 */
var url_server = "http://srv.betawrapper.com/lab/deployer/server/tools.php";
var url_oauth = "http://srv.betawrapper.com/bit/access.php"

$(document).ready(function() {

    $('button#pull').click(function() {
        function call_pull(token) {
            $.ajax({
                url: url_server,
                type: "POST",
                data: { "action": "pull", "token": token },
                success: function (data) {
                    $('div#result-pull').html(data);
                    console.log(data);
                }
            });
        }

        $.ajax({
            url: url_oauth,
            type: "GET",
            success: function (token) {
                call_pull(token);
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