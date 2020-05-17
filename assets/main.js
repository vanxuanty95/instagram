$(document).ready(function () {
    var maximumImages = 7;
    var WIDTH = 1080;
    var HEIGHT = 1080;
    var STACK = [];

    $("#formGenerateImage").submit(function (event) {
        event.preventDefault();
        let username = $('#username_input').val().trim();
        let decription = $('#description_input').val().trim();
        if (username == "") {
            alert("empty");
            return;
        }
        $("#formGenerateImageSubmitButton").attr("disabled", true);
        run(username, decription);
    });

});