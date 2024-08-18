$('table').DataTable({
    ordering: false,
})


$('#set-category').submit(function (e) {
    e.preventDefault()

    $.ajax({
        url: 'ajax.php?action=save_category',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully added", 'success')
                setTimeout(function () {
                    location.reload()
                }, 1500)

            } else if (resp == 2) {
                alert_toast("Data successfully updated", 'info')
                setTimeout(function () {
                    location.reload()
                }, 1500)

            } else {
                alert_toast("An error occured", 'danger')
            }
        }
    })
})

$('#set2-category').submit(function (e) {
    e.preventDefault()

    $.ajax({
        url: 'ajax.php?action=save_category2',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully added", 'success')
                setTimeout(function () {
                    location.reload()
                }, 1500)

            } else if (resp == 2) {
                alert_toast("Data successfully updated", 'info')
                setTimeout(function () {
                    location.reload()
                }, 1500)

            } else {
                alert_toast("An error occured", 'danger')
            }
        }
    })
})

$('#set3-category').submit(function (e) {
    e.preventDefault()

    $.ajax({
        url: 'ajax.php?action=save_category3',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully added", 'success')
                setTimeout(function () {
                    location.reload()
                }, 1500)

            } else if (resp == 2) {
                alert_toast("Data successfully updated", 'info')
                setTimeout(function () {
                    location.reload()
                }, 1500)

            } else {
                alert_toast("An error occured", 'danger')
            }
        }
    })
})


$('.edit_cat').click(function () {
    var cat = $('#set-category')
    cat.get(0).reset()
    cat.find("[name='id']").val($(this).attr('data-id'))
    cat.find("[name='name']").val($(this).attr('data-name'))
})

$('.edit_cat2').click(function () {
    var cat = $('#set2-category')
    cat.get(0).reset()
    cat.find("[name='id']").val($(this).attr('data-id'))
    cat.find("[name='name']").val($(this).attr('data-name'))
})

$('.edit_cat3').click(function () {
    var cat = $('#set3-category')
    cat.get(0).reset()
    cat.find("[name='id']").val($(this).attr('data-id'))
    cat.find("[name='name']").val($(this).attr('data-name'))
})


$('.delete_cat').click(function () {
    _conf("Are you sure to delete this category?", "delete_cat", [$(this).attr('data-id')])
})

$('.delete_cat2').click(function () {
    _conf("Are you sure to delete this department?", "delete_cat2", [$(this).attr('data-id')])
})

$('.delete_cat3').click(function () {
    _conf("Are you sure to delete this program?", "delete_cat3", [$(this).attr('data-id')])
})


function delete_cat($id) {
    $.ajax({
        url: 'ajax.php?action=delete_category',
        method: 'POST',
        data: {
            id: $id
        },
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'warning')
                setTimeout(function () {
                    location.reload()
                }, 1500)

            }
        }
    })
}

function delete_cat2($id) {
    $.ajax({
        url: 'ajax.php?action=delete_category2',
        method: 'POST',
        data: {
            id: $id
        },
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'warning')
                setTimeout(function () {
                    location.reload()
                }, 1500)

            }
        }
    })
}

function delete_cat3($id) {
    $.ajax({
        url: 'ajax.php?action=delete_category3',
        method: 'POST',
        data: {
            id: $id
        },
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully deleted", 'warning')
                setTimeout(function () {
                    location.reload()
                }, 1500)

            }
        }
    })
}


// fold card
// $('.card').each(function () {
//     var cardId = $(this).attr('id');
//     if (cardId && localStorage.getItem(cardId) === 'true') {
//         $(this).addClass('collapsed-card');
//         $(this).find('.fas').removeClass('fa-minus').addClass('fa-plus');
//     }
// });


// $('.btn-tool').on('click', function () {
//     var card = $(this).closest('.card');
//     var cardId = card.attr('id');
//     var isCollapsed = card.hasClass('collapsed-card');

//     if (isCollapsed) {
//         localStorage.setItem(cardId, 'false');
//         $(this).find('.fas').removeClass('fa-plus').addClass('fa-minus');
//         // setTimeout(function () {
//         //     location.reload();
//         // }, 450);
//     } else {
//         localStorage.setItem(cardId, 'true');
//         $(this).find('.fas').removeClass('fa-minus').addClass('fa-plus');
//     }
// });
