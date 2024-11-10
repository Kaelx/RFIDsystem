//state of the sidebar
if (sessionStorage.getItem('sidebarState') === 'collapsed') {
    $('body').addClass('sidebar-collapse');
}

$('[data-widget="pushmenu"]').on('click', function () {
    var isCollapsed = $('body').hasClass('sidebar-collapse');

    if (isCollapsed) {
        sessionStorage.setItem('sidebarState', 'expanded');
    } else {
        sessionStorage.setItem('sidebarState', 'collapsed');
    }
});






// Disable autocomplete for all forms
// Disable autocomplete for all input elements
window.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('form').forEach((form) => {
        form.setAttribute('autocomplete', 'off');

    });

    document.querySelectorAll('input').forEach((input) => {
        input.setAttribute('autocomplete', 'off');

    });
});

// Validate for all form
function validateForm(form) {
    const invalidPattern = /(--|'|`|<|>|=)/;
    let isValid = true;

    $(form).find('input').each(function () {
        // Skip validation for hidden fields like croppedImageData
        if ($(this).attr('type') === 'hidden' || $(this).attr('id') === 'croppedImageData') {
            return;
        }

        if (invalidPattern.test($(this).val())) {
            alert_toast('Invalid. Do not input special character', 'danger');
            isValid = false;
            return false;
        }
    });

    return isValid;
}




window._conf = function ($msg = '', $func = '', $params = []) {
    $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
    $('#confirm_modal .modal-body').html($msg)
    $('#confirm_modal').modal('show')
}



window.alert_toast = function ($msg = 'TEST', $bg = 'success') {
    $('#alert_toast').removeClass('bg-success')
    $('#alert_toast').removeClass('bg-danger')
    $('#alert_toast').removeClass('bg-info')
    $('#alert_toast').removeClass('bg-warning')

    if ($bg == 'success')
        $('#alert_toast').addClass('bg-success')
    if ($bg == 'danger')
        $('#alert_toast').addClass('bg-danger')
    if ($bg == 'info')
        $('#alert_toast').addClass('bg-info')
    if ($bg == 'warning')
        $('#alert_toast').addClass('bg-warning')

    $('#alert_toast .toast-body').html($msg + '  <i class="fa-solid fa-circle-exclamation"></i> ');

    $('#alert_toast').toast({
        delay: 3000
    }).toast('show');
}



$('input#bdate[type="date"]').each(function () {
    const currentYear = new Date().getFullYear();
    const maxDate = new Date(currentYear - 10, 11, 31).toISOString().split('T')[0];

    $(this).attr('min', '1960-01-01');
    $(this).attr('max', maxDate);
});



$('.select2').select2();
$('.select2').on('select2:open', function () {
    let searchField = document.querySelector('.select2-container--open .select2-search__field');

    searchField.placeholder = 'Search';
    searchField.focus();
});


// Add a custom rule for Philippine phone number validation
$.validator.addMethod("phonePH", function (value, element) {
    return this.optional(element) || /^(\+63|0)9\d{9}$/.test(value);
}, "Please enter a valid phone number.");


// Global jQuery validation for all forms
$('form').each(function () {
    $(this).validate({
        rules: {
            name: {
                required: true
            },
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            bdate: {
                required: true,
                date: true
            },
            address: {
                required: true
            },
            cellnum: {
                required: true,
                phonePH: true,
            },
            email: {
                required: true,
                email: true
            },
            account_type: {
                required: true
            },
            school_id: {
                required: true
            },
            rfid: {
                required: true
            },
            gender: {
                required: true
            },
            type_id: {
                required: true
            },
            prog_id: {
                required: true
            },
            username: {
                required: true
            },
            confirmpass: {
                equalTo: '#password'
            },
        },
        messages: {
            confirmpass: {
                equalTo: "Password does not match"
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