$(document).ready(function () {
    var maximumImages = 7;
    var WIDTH = 1080;
    var HEIGHT = 1080;
    var STACK = [];

    function runProgress() {
        resetVariable();
        let username = $('#username_input').val().trim();
        let decription = $('#description_input').val().trim();
        if (username == "") {
            alert("empty");
            return;
        }
        getInfomation(username, decription);
    };

    $("#downloadBtn").click(function (event) {
        let can = document.getElementById("imageGenerated");
        image = can.toDataURL("image/png").replace("image/png", "image/octet-stream");
        let link = document.getElementById('temp');
        link.download = "picture.png";
        can.toBlob(function (blob) {
            link.href = URL.createObjectURL(blob);
            link.click();
        })
    });

    function resetVariable() {
        maximumImages = 7;
        $("#downloadBtn").attr("disabled", true);
        $('#mostRecent_img').empty();
        $('#mostRecent').empty();
        $('#media_post').remove();
        $('#media_post_img').remove();
        $('#cover_img').attr("src", "");
        $('#cover').css("background-image", "");
        $('#background_blur_img').attr("src", "");
        $('#background_blur').css("background-image", "");
        $('#imageGenerated').remove();
        $('#canvas_temp').remove();
        $("#imageResized").css("display", "none");
        $("#capture").css("display", "none");
    }

    function getInfomation(username, description) {
        $.ajax({
            type: 'GET',
            url: 'https://www.instagram.com/' + username + "/?__a=1",
            dataType: 'json',
            success: function (data) {
                $("#capture").css("display", "block");
                $('#user_name').text("@" + username);
                $('#description').text("\"" + description + "\"");
                $('#author_name').text(data.graphql.user.full_name);
                $('#profile_image_img').attr("src", data.graphql.user.profile_pic_url_hd);
                $('#profile_image').attr("style", "background-image: url(" + data.graphql.user.profile_pic_url_hd + ")");
                $('#post_count').text(data.graphql.user.edge_owner_to_timeline_media.count);
                $('#follower_count').text(data.graphql.user.edge_followed_by.count);
                $('#following_count').text(data.graphql.user.edge_follow.count);
                setMostRecentPhotos(data.graphql.user.edge_owner_to_timeline_media.edges);
                convertToImage();
            },
            error: function () {
                alert("Page not found");
            }
        });
    }

    function setMostRecentPhotos(edgesArray) {
        let edgesIdx;
        let maximumLoopArray;
        if (edgesArray.length === 0) {
            maximumImages = 0;
            return
        }
        if (edgesArray.length < maximumImages) {
            maximumImages = edgesArray.length;
        }
        maximumLoopArray = maximumImages - 1;
        for (edgesIdx = 0; edgesIdx < maximumLoopArray; ++edgesIdx) {
            let newImgElemnetImg = "<img id=\"" + edgesIdx + "_post_image_img\" class=\"media\" src=\"" + edgesArray[edgesIdx].node.display_url + "\">"
            $('#mostRecent_img').append(newImgElemnetImg);
            let newImgElemnet = "<div id=\"" + edgesIdx + "_post_image\" class=\"media\" style=\"background-image: url(" + edgesArray[edgesIdx].node.display_url + "\"></div>"
            $('#mostRecent').append(newImgElemnet);
        }
        let backgroundBlurImg = edgesArray[maximumLoopArray].node.display_url;
        $('#background_blur_img').attr("src", backgroundBlurImg);
        $('#background_blur').attr("style", "background-image: url(" + backgroundBlurImg + ")");

        let coverImg = edgesArray[maximumLoopArray].node.display_url;
        $('#cover_img').attr("src", coverImg);
        $('#cover').attr("style", "background-image: url(" + coverImg + ")");
    }

    function getImage(url) {
        arrayURLStr = url.split("/");
        media_id = arrayURLStr[4];
        imageSrc = "https://instagram.com/p/" + media_id + "/media/?size=l";
        $('#media_post').attr("src", imageSrc);
    }

    function convertToImage() {
        let totalFinish = 0;

        $('img.media').on('load', function () {
            totalFinish++;
            if (totalFinish == maximumImages + 1) {
                let urlFiltered = createImageWithFilter(document.getElementById('background_blur_img'))
                $('#background_blur').attr("style", "background-image: url(" + urlFiltered + ")");

                html2canvas(document.querySelector("#capture"), {
                    scale: 1,
                    allowTaint: true,
                    useCORS: true,
                }).then(function (canvas) {
                    canvas.id = "imageGenerated";
                    document.body.appendChild(canvas)
                    $("#downloadBtn").attr("disabled", false);
                    $("#capture").css("display", "none");
                    $("#formGenerateImageSubmitButton").attr("disabled", false);
                    //convertCanvasToImage();
                });
            }
        });
    }

    function convertCanvasToImage() {
        $("#imageGenerated").css("display", "none");
        let can = document.getElementById('imageGenerated');
        let image = new Image();
        image.src = can.toDataURL("image/png", 1);
        $("#imageFromCanvas").attr("src", image.src)
        $('#imageFromCanvas').on('load', function () {
            let newUri = resize()
            $("#imageResized").attr("src", newUri)
            $("#imageResized").css("display", "block");
        })
    }

    function resize() {
        let canvas = document.createElement("canvas");
        let ctx = canvas.getContext("2d");
        let image = document.getElementById('imageFromCanvas');
        canvas.width = WIDTH;
        canvas.height = HEIGHT;
        ctx.drawImage(image, 0, 0, WIDTH, HEIGHT);
        return canvas.toDataURL("image/png", 1);
    }

    function createImageWithFilter(imgNode) {
        let canvas = document.createElement('canvas')
        canvas.setAttribute("id", "canvas_temp");
        canvas.width = imgNode.width
        canvas.height = imgNode.height

        let context = canvas.getContext('2d')
        context.filter = getComputedStyle(imgNode).filter

        imgNode.setAttribute('crossOrigin', 'anonymous')

        context.drawImage(imgNode, 0, 0, canvas.width, canvas.height)
        let url = canvas.toDataURL(`image/png`, 0.97)
        return url
    }

    window.onload = runProgress;
});