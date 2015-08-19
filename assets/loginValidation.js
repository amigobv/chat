/**
 * Created by Blade on 19.08.2015.
 */

$(document).ready(function () {
    $("#username").blur( function () {
        var user = $("#username").val();

        console.log(user);

        $.ajax({
            url: "ajax/GetChannels.php",
            dataType: "json",
            type: "POST",
            data: {'user' : user},
            success: function(data) {
                console.log("Success " + data);
            },
            error: function() {
                console.log("Error");
                //TODO: user does not exists
            }
        });
    })
});
