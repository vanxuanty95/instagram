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
        let hostting = 'http://instagram.nakamadressup.com/'
        //let hostting = 'http://localhost:41062/www/'
        let iframe = document.createElement('iframe');
        iframe.src = hostting + 'index.php?controller=profile&action=profile&username=' + username + "&description=" + description;
        iframe.onload = function (e) {
            html2canvas(iframe.contentDocument.documentElement, {
                scale: 1,
                allowTaint: true,
                useCORS: true,
            }).then(function (canvas) {
                canvas.id = "imageGenerated";
                document.body.removeChild(iframe);
                document.body.appendChild(canvas);
                $("#formGenerateImageSubmitButton").attr("disabled", false);
            });
        }
        // just to hide the iframe
        iframe.style.cssText = 'position: absolute; opacity:0; z-index: -9999';
        document.body.appendChild(iframe);
    }
});