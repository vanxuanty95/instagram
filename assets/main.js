$(document).ready(function () {
    $("#formGenerateImage").submit(function (event) {
        event.preventDefault();
        let username = $('#username_input').val().trim();
        let decription = $('#description_input').val().trim();
        if (username == "") {
            alert("empty");
            return;
        }
        $("#formGenerateImageSubmitButton").attr("disabled", true);
        getInfomation(username, decription);
    });

    function getInfomation(username, description) {
        $.ajax({
            type: 'GET',
            url: 'http://instagram.nakamadressup.com/index.php?controller=generate&action=generate&username=' + username + "&description=" + description,
            dataType: 'json',
            success: function (data) {
                $('#final_img').attr("src", data);
            },
            error: function () {
                alert("Page not found");
            }
        });
    }

});