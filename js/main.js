// Used for form validation
$('form').each(function () {
    $(this).validate({
        rules: {
            username: {
                required: true,
            },
            password: {
                required: true,
            },
            email: {
                required: true,
                email: true
            },
            otpcode: {
                required: true,
            },
            newpass: {
                required: true,
            },
            confirmpass: {
                required: true,
                equalTo: '#newpass'
            },
        },
        messages: {
            username: {
                required: 'Please enter username',
            },
            password: {
                required: 'Please enter password',
            },
            email: {
                required: 'Please enter email',
                email: 'Please enter valid email'
            },
            otpcode: {
                required: 'Please enter OTP code',
            },
            newpass: {
                required: 'Please enter new password',
            },
            confirmpass: {
                required: 'Please confirm password',
                equalTo: 'Password not matched'
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }

    });
});