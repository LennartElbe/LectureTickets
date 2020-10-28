function reloadClassTable() {
  jQuery('#classes').children().remove();
  jQuery('#delete-class-button').prop('disabled', true);
  jQuery('#sign-up-button').prop('disabled', true);
  jQuery('#withdraw-button').prop('disabled', true);
  jQuery.getJSON('/php/classes.php', function (data) {
    data.forEach(function (item, index) {
      jQuery('#classes').append(
        '<tr classid="' + item.id + '"><td>' + item.classNumber +
        '</td><td>' + item.className +
        '</td><td>' + item.classDate +
        '</td><td>' + item.classStartTime +
        '</td><td>' + item.classEndTime +
        '</td><td>' + item.classSeatCount +
        '</td><td>' + item.status +
        '</td></tr>')
    })
  })
}

function changePassword() {
  var password = jQuery('#new-password').val()
  hash = hex_md5(password);
  if (password == "") {
    alert("Error: password cannot be empty");
    return;
  }
  jQuery.post('/code/php/changePassword.php', { "pw": hash }, function (data) {
    console.log("worked or not " + JSON.stringify(data));
    update();
  }, "json");
}


jQuery(document).ready(function () {
  reloadClassTable();

  jQuery("#change-password-save-button").on('click', function () {
    changePassword();
  })

  jQuery('#withdraw-button').on('click', function () {
    var id = jQuery('#classes tr.active').attr('classid');
    jQuery.getJSON('php/signups.php', {
      'action': "withdraw",
      'id': id,
    }, function (data) {
      console.log(JSON.stringify(data));
      if (data["message"] == "done") {
        setTimeout(function () { alert("Come back soon!"); }, 100);
      } else {
        alert(data["message"]);
      }
      reloadClassTable();
    })
  })

  jQuery('#sign-up-button').on('click', function () {
    var id = jQuery('#classes tr.active').attr('classid');
    jQuery.getJSON('php/signups.php', {
      'action': "signup",
      'id': id,
    }, function (data) {
      console.log(JSON.stringify(data));
      if (data["message"] == "done") {
        setTimeout(function () { alert("Thank you for signing up for this class."); }, 100);
      } else {
        alert(data["message"]);
      }
      reloadClassTable();
    })
  })
  jQuery('#delete-class-button').on('click', function () {
    var id = jQuery('#classes tr.active').attr('classid');
    jQuery.getJSON('php/classes.php', {
      'action': "delete",
      'id': id
    }, function (data) {
      reloadClassTable();
    })
  })
  jQuery('#classes').on('click', 'tr', function () {
    if (jQuery(this).hasClass('active')) {
      jQuery(this).removeClass('active');
      jQuery('#delete-class-button').prop('disabled', true);
      jQuery('#sign-up-button').prop('disabled', true);
      jQuery('#withdraw-button').prop('disabled', true);
      return;
    }
    jQuery('#classes tr').removeClass('active');
    jQuery(this).addClass('active');
    jQuery('#delete-class-button').prop('disabled', false);
    jQuery('#sign-up-button').prop('disabled', false);
    jQuery('#withdraw-button').prop('disabled', false);

  })
  jQuery('#add-new-class-save-button').on('click', function () {
    var className = jQuery('#add-new-class-name').val()
    var classNumber = jQuery('#add-new-class-number').val()
    var classDate = jQuery('#add-new-class-date').val()
    var classStartTime = jQuery('#add-new-class-start-time').val()
    var classEndTime = jQuery('#add-new-class-end-time').val()
    var classSeatCount = jQuery('#add-new-class-seat-count').val()
    jQuery.getJSON('/php/classes.php', {
      action: 'create',
      className: className,
      classNumber: classNumber,
      classDate: classDate,
      classStartTime: classStartTime,
      classEndTime: classEndTime,
      classSeatCount: classSeatCount
    }, function (data) {
      console.log(JSON.stringify(data))
      reloadClassTable();
    }).fail(function () {
      console.log("This did not work for some reason");
    });
  })
})
