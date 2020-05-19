<head>
    <meta name="viewport" content="width=device-width" />
    <title>Demo</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="assets/profile.min.js"></script>
</head>

<body>
    <div class="desibox">
        <div id="blurbg" class="blurbg" style="background-image: url(<?php echo $profile["background_blur"] ?>)"></div>
        <div class="frame">
            <div id="background_blur" class="cover" style="background-image: url(<?php echo $profile["cover"] ?>)"></div>
            <img id="background_blur_img" class="blurbg media" style="display: none;" src=<?php echo $profile["cover"] ?> crossOrigin="anonymous">
            <div class="con">
                <div class="content">
                    <div class="avatar" style="background-image: url(<?php echo $profile["profile_image"] ?>)"></div>
                    <div class="detail">
                        <h1><?php echo $profile["user_name"]; ?></h1>
                        <h3><?php echo $profile["author_name"]; ?></h3>
                        <?php if (strlen($profile["description"]) > 2) { ?>
                            <p><?php echo $profile["description"]; ?></p>
                        <?php } ?>
                    </div>
                    <div class="gallery">
                        <?php foreach ($profile["mostRecents"] as $image) { ?>
                            <div style="background-image: url(<?php echo $image ?>)"></div>
                        <?php } ?>
                    </div>
                    <div class="nav">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>