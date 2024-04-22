$(document).ready(function() {
    $('#signupForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'php/register.php',
            data: $(this).serialize(),
            success: function(response) {
                $('#signupMessage').html(response);
            }
        });
    });
});
