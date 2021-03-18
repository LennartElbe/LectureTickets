function addUserViaEmail() {
    var password = jQuery('#psw').val();
    var studentID = studentIdFromURL; //somehow grab the student's id from the URL that was clicked on...?
    var email = $content["studentID"]["Email"];
    var organization = "Uni-Freiburg";
    var fullname = "N/A";
    hash = hex_md5(password);
    if (password == "") {
        alert("Error: password cannot be empty");
        return;
    }
    $content = file_get_contents("../ticketData/newStudents.json");
    $content = json_decode($content, true);

    var name = $content["studentID"]["Email"];


    jQuery.post('/code/php/getUser.php?action=create&value=' + name + '&value2=' + email, { "pw": hash, "organization": organization, "fullname": fullname },
        function (data) {
            console.log('worked or not' + data);
            update();
            // jQuery('#add-new-user-dialog').dialog('close');
        }, "json");

    $content["studentID"]["Status"] = "Student has created their password";
    file_put_contents("../ticketData/newStudents.json", json_encode($content));
}

jQuery(document).ready(function () {
    jQuery('#create-psw-via-email').on('click', function () {
        addUserViaEmail();
    });
});
