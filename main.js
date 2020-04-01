window.onload = function () {
    html2canvas(document.querySelector("#capture")).then(canvas => {
        document.body.appendChild(canvas)
    });

    var feed = new Instafeed({
        links: 'https://www.instagram.com/p/B96Z85cJu-j/',
        accessToken: 'IGQVJWaUJucHUybVVxUjNmblFPN2lKa0o4TFBUb3FoUTlCVjRBdnJlVkxhUW1GZADJoa2FZAZA2wxWmgyZAWR1NFRmMGlycXdJVlJNQ0xwdnhlTWc1OUlnVm5LcTFtQU1fc1AybXdYZADhoUGo0c2ZAsOUIzMAZDZD'
    });
    feed.run();

}