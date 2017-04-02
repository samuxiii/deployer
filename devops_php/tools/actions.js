
$(document).ready(function() {

    $('button#pull').click(function() {
        $.ajax({
            url: "deploy.php",
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
            url: "deploy.php",
            type: "POST",
            data: {"action":"deploy"},
            success: function(data){
                $('div#result-deploy').html(data);
                console.log(data);
            }
        });
    });

});