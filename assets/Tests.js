/**
 * Created by Blade on 27.08.2015.
 */

function UserLoginTest() {
    console.log("Testing user login ... ");

    console.log("Call login page");
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {page:"index.php", action: "login", username: "scm4", password: "scm4", channel: "General"},
        dataType: "html",
        success: function (data) { console.log("success"); $("html").html(data)},
        error: function (data) {console.log("Error " + data)}
    });
}

function RegistrationTest() {
    console.log("Testing user login ... ");

    console.log("Call login page");
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {page:"index.php", action: "registrate", firstName:"test", lastName:"user", username: "test", password: "test", channel: "General"},
        dataType: "html",
        success: function (data) { console.log("success"); $("html").html(data)},
        error: function (data) {console.log("Error " + data)}
    });
}

function PostingTest() {
    console.log("Testing user login ... ");

    console.log("Call login page");
    $.ajax({
        url: "index.php",
        type: "POST",
        data: {page:"index.php", view: "welcome", action: "postMessage", title:"Unit Test", content:"Unit Test Message"},
        dataType: "html",
        success: function (data) { console.log("success"); $("html").html(data)},
        error: function (data) {console.log("Error " + data)}
    });
}