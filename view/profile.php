<head>
    <title>Demo</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>

<body>
    <div class="desibox">
        <div class="blurbg" style="background-image: url(<?php echo $profile["background_blur"] ?>)"></div>
        <div class="frame">
            <div class="cover" style="background-image: url(<?php echo $profile["cover"] ?>)"></div>
            <div class="con">
                <div class="content">
                    <div class="avatar" style="background-image: url(<?php echo $profile["profile_image"] ?>)"></div>
                    <div class="detail">
                        <h1><?php echo $profile["user_name"]; ?></h1>
                        <h3><?php echo $profile["author_name"]; ?>e</h3>
                        <p><?php echo $profile["description"]; ?></p>
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