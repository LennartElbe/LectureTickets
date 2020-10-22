$(document).ready(function () {
    var qrcode = new QRCode("qrcode");
    $.getJSON('result.json')
    function makeCode() {
        var elText = document.getElementById("text");

        if (!elText.value) {
            alert("Input a text");
            elText.focus();
            return;
        }

        qrcode.makeCode(elText.value);
    }

    makeCode();

    $("#text").
        on("blur", function () {
            makeCode();
        }).
        on("keydown", function (e) {
            if (e.keyCode == 13) {
                makeCode();
            }
        });
    
    randomString();
    randomString();
    randomString();
});

var dict = new Object();
dict["one"] = 1;
dict[1] = "one"
dict["Age"] = 42;
dict.FirstName = "Chris";
for (var key in dict) {
    var value = dict[key];
    console.log(key);
}

// module: generateTicket
// called when student signs up for a class, will call randomString
// and generateQR to display a QR code on user end.

// module: randomString
// will generate a random string of 9 numbers, will check database to see if
// number already exists and make a new one if it does.
function randomString() {
    var num = Math.floor(Math.random() * 1000000000);
    
    console.log(num);
}
