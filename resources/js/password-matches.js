const MIN_PASSWORD_LENGTH = 8,
      MAX_PASSWORD_LENGTH = 32;

$(function () {
  $('#submit').on('click', function (evt) {
    evt.preventDefault();

    let password = $('#password').val(),
        confirmPassword = $('#confirmPassword').val();

    if (isValidPassword(password) && (password === confirmPassword)) {
      console.log('ok');
      $('#signUpForm').submit();
    } else {
      console.log('bad');
    }
  }); // end of on click submit
});

function isValidPassword(password) {
  return  password.length >= MIN_PASSWORD_LENGTH &&
          password.length <= MAX_PASSWORD_LENGTH;
}
