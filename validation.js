$(function () {
  var $registerform = $("#formular");
  if ($registerform.length) {
    $registerform.validate({
      rules: {
        name: {
          required: true
        },
        nachname: {
          required: true
        },
        email: {
          required: true
        },
        password: {
          required: true
        }

      },
      messages: {
        required: "Required input",
       
      }
    })
  }
})
