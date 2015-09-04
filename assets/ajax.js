/**
 * Created by Blade on 25.08.2015.
 */

function setPrior(identity) {
    console.log("Start Pressed " + identity);

    $.post("ajax.php", {action: "setPriority", id: identity})
        .done(function(data){
            document.location.href = data;
        });
}


function removeMessage(identity) {
    console.log("removeMessage Pressed");
    $.post("ajax.php", {action: "delete", id: identity})
        .done(function(data){
            document.location.href = data;
        });
}

function resetPrior(identity) {
    console.log("resetPrior Pressed");
    $.post("ajax.php", {action: "resetPriority", id: identity})
        .done(function(data){
            document.location.href = data;
        });
}


function updateChat() {
    console.log("Update chat");
    var chatWall = $(".channelName").text();

    $.ajax({
        type: "POST",
        url: "ajax.php",
        data: {action: "update", channel: chatWall},
        dataType: "html",
        success: function(data) {
            $(".messageContainer").empty();
            $(".messageContainer").html(data);
        }
    });

    setTimeout(updateChat, 5000);
}

$(document).ready(function() {
    setTimeout(updateChat, 5000);
});
