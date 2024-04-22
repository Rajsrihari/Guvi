$(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'php/login.php',
            data: $(this).serialize(),
            success: function(response) {
                if(response === 'success') {
                    window.location.href = 'profile.html';
                } else {
                    $('#loginMessage').html(response);
                }
            }
        });
    });
});
