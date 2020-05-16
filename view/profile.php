<head>
    <title>Demo</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script async="" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="assets/profile.js"></script>
</head>

<body>
    <input type="text" id="username_input" value="<?php echo $profile->username; ?>" style="display: none">
    <input type="text" id="description_input" value="<?php echo $profile->description; ?>" style="display: none">

    <a id="temp" style="display: none;"></a>
    <div class="desibox" id="capture">
        <div class="blurbg media" id="background_blur"></div>
        <img id="background_blur_img" class="blurbg media" style="display: none;" src="" crossOrigin="anonymous">
        <div class="frame">
            <div class="cover media" id="cover"></div>
            <img id="cover_img" class="media" style="display: none;" src="">
            <div class="con">
                <div class="content">
                    <div class="avatar media" id="profile_image"></div>
                    <img id="profile_image_img" class="media" style="display: none;" src="">
                    <div class="detail">
                        <h1 id="author_name"></h1>
                        <h3 id="user_name"></h3>
                        <p id="description"></p>
                    </div>
                    <div class="gallery" id="mostRecent">
                    </div>
                    <div id="mostRecent_img" style="display: none;"></div>
                    <div class="nav">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img id="imageFromCanvas" src="" style="width: 1080px; height: 1080px; display: none;" crossOrigin="anonymous">
    <img id="imageResized" src="" style="width: 1080px; height: 1080px; display: none;" crossOrigin="anonymous">
</body>

</html>