$(document).ready(function() {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    $('#formLogin').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '/api/login',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                localStorage.setItem('token', response.token);
                console.log('Token:', response.token);
                window.location.href = '/thriftLang';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });

    $('#formRegister').submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '/api/register',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            processData: false,
            contentType: false,
            success: function(response) {
                alert('User registered successfully!');
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });

    $('#logoutBtn').click(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/api/logout',
            type: 'POST',
            data: {
                _token: csrfToken
            },
            success: function(response) {
                alert('Logged out successfully!');
                localStorage.removeItem('token');
                window.location.href = '/';
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });


    $('a[href="#modalLogin"]').on('click', function(e) {
        e.preventDefault();
        $('#modalLogin').modal('show');
    });

    $('a[href="#modalRegister"]').on('click', function(e) {
        e.preventDefault();
        $('#modalRegister').modal('show');
    });
});
