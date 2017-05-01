/*
 * TODO: the url server should be in a config file 
 */
var url_server = "../server/server.php";
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
    
    /* load link of deployed project */
    /*TODO: enable at the same time the buttons*/
    $.ajax({
        url: url_server,
        type: "POST",
        data: { "action": "link" },
        success: function (data) {
            $("#language-link").attr("href", data);
            console.log("link updated to " + data);
        }
    });

    /* login behaviour */
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
            data: { "action": "pull", "token": token },
            success: function (data) {
                $('div#result-pull').html(data);
                console.log(data);
            }
        });
    });

    $('button#deploy').on('click', function(e) {
      e.preventDefault();
      
      //change modal text info
      $('#confirm .modal-body').text("Old data will be deleted before deploying the last version.")
      
      //open modal
      $('#confirm').modal({
          backdrop: 'static', //no click outside the modal
          keyboard: false //no goes back when ESC is pressed
        })
        //if yes, perform operation
        .one('click', '#yes', function(e) {
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