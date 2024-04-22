$(document).ready(function() {
    $('#updateProfileBtn').click(function() {
        // Redirect to update profile page
        window.location.href = 'update_profile.html';
    });

    $('#logoutBtn').click(function() {
        // Clear local storage or any client-side session data
        // Redirect to the login page
        window.location.href = 'login.html';
    });

    // Fetch profile details
    $.ajax({
        type: 'POST',
        url: 'php/profile.php',
        data: { action: 'getProfile' },
        success: function(response) {
            $('#profileDetails').html(response);
        }
    });
});
