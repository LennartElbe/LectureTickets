/*function makeCode() {
    var elText = document.getElementById("text");
    if (!elText.value) {
        alert("Input a text");
        elText.focus();
        return;
    }
    qrcode.makeCode(elText.value);
}

function randomString() {
    var num = Math.floor(Math.random() * 1000000000);

    console.log(num);
}


$(document).ready(function () {
    var qrcode = new QRCode("qrcode");
    $.getJSON('result.json')


    // not sure how this works right now to be completely honest
    // will fix it later after layout of website is done with
/*    $("#text").
        on("blur", function () {
            makeCode();
        }).
        on("keydown", function (e) {
            if (e.keyCode == 13) {
                makeCode();
            }
        });
});*/

// module: generateTicket
// called when student signs up for a class, will call randomString
// and generateQR to display a QR code on user end.

// module: randomString
// will generate a random string of 9 numbers, will check database to see if
// number already exists and make a new one if it does.