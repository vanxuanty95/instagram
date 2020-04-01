window.onload = function () {
    html2canvas(document.querySelector("#capture")).then(canvas => {
        document.body.appendChild(canvas)
    });

    var feed = new Instafeed({
        links: 'https://www.instagram.com/p/B96Z85cJu-j/',
        clientId: 'nhifake'
    });
    feed.run();

}