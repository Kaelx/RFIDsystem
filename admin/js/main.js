// Check the state of the sidebar from localStorage
if (localStorage.getItem('sidebarState') === 'collapsed') {
    $('body').addClass('sidebar-collapse');
}

$('[data-widget="pushmenu"]').on('click', function () {
    var isCollapsed = $('body').hasClass('sidebar-collapse');

    if (isCollapsed) {
        localStorage.setItem('sidebarState', 'expanded');
    } else {
        localStorage.setItem('sidebarState', 'collapsed');
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
    const invalidPattern = /(--|'|<|>|=)/;
    let isValid = true;

    $(form).find('input').each(function() {
        if (invalidPattern.test($(this).val())) {
            alert_toast('Invalid. Do not input special character!', 'danger');
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
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({
        delay: 3000
    }).toast('show');
}