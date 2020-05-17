<head>
    <title>Demo</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <script src="assets/main.js"></script>
</head>

<body>
    <div>
        <form id="formGenerateImage" action="" title="" method="post">
            <div>
                <label class="title">username</label>
                <input type="text" id="username_input" name="username">
                <label class="title">description</label>
                <input type="text" id="description_input" name="description">
            </div>
            <div>
                <input type="submit" id="formGenerateImageSubmitButton" name="formGenerateImageSubmitButton" value="Submit">
            </div>
        </form>
        <div id="generateProgress">
            <div id="progressBar"></div>
        </div>
    </div>
</body>