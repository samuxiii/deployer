/*
 * TODO: the url server should be in a config file 
 */
var url_server = "../server/tools.php";
var url_oauth = "../server/access.php";
var token = "";

$(document).ready(function() {

    //initialize tooltip and interface
    $('[data-toggle="tooltip"]').tooltip();
    disableButtons();
    $.ajax({
            url: url_oauth,
            type: "GET",
            success: function (token) {
                storeToken(token);
                enableButtons();
                $('#login').toggleClass('glyphicon glyphicon-refresh').text('Refresh');
            }
    });

    /* oauth token handlers*/
    function storeToken(token_) {
        token = token_;
        console.log(token);
    }

    $('#login').click(function() {
        window.location.href = url_oauth;
    });

    /* button behaviours */
    function enableButtons() {
        $('button').prop('disabled', false);
    }

    function disableButtons() {
        $('button').prop('disabled', true);
        $('#login').prop('disabled', false);
    }

    /* button functions */
    $('button#clone').click(function() {
        $.ajax({
            url: url_server,
            type: "POST",
            data: { "action": "clone", "token": token },
            success: function (data) {
                $('div#result-clone').html(data);
                console.log(data);
            }
        });
    });

    $('button#pull').click(function() {
        $.ajax({
            url: url_server,
            type: "POST",
            data: { "action": "pull" },
            success: function (data) {
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