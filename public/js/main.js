$(document).ready(() => {
    $(() => {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#photo-input').change((event) => {
        const photo = event.target.files[0];
        const photoUrl = URL.createObjectURL(photo);

        $('#photo-img').attr('src', photoUrl);
        $('#user-photo').css({display: 'flex'});
    });

    $('#submit').click(() => {
        $('#form').submit();
    });

    $('#remove-authorship').click(() => {
        $('#authorship').val(false);
        $('#remove-authorship').css({display: 'none'});
        $('#add-authorship').css({display: 'flex'});
    });

    $('#add-authorship').click(() => {
        $('#authorship').val(true);
        $('#add-authorship').css({display: 'none'});
        $('#remove-authorship').css({display: 'flex'});
    });

    $('#submit-edited-comment').submit(() => {
        const urlIds = location.pathname.substr(1).match(/\/(\d+)+[\/]?/g).map(id => id.replace(/\//g, ''));
        [saintId, commentId] = urlIds;

        const comment = $('#submit-edited-comment').find('#saint-comment');

        $.ajax({
            url: '/saints/' + saintId + '/comments/' + commentId,
            type: 'PATCH',
            data: JSON.stringify({
                comment: comment.val()
            }),
            success: () => {
                window.location.href = '/saints/' + saintId;
            }
        });

        return false;
    });

    $('#mark-as-devoted').click((event) => {
        const saintId = event.target.id;

        $.ajax({
            url: '/devote',
            type: 'POST',
            data: {
                id: saintId
            },
            success: () => {
                location.reload();
            }
        });
    });

    $('a.text-danger').click((event) => {
        if (! confirm('Are you sure?')) {
            return;
        }

        const saintId = location.pathname.substr(1).match(/\/(\d+)+[\/]?/g).map(id => id.replace(/\//g, ''))[0];
        const commentId = event.target.id;

        $.ajax({
            url: '/saints/' + saintId + '/comments/' + commentId,
            type: 'DELETE',
            success: () => {
                location.reload();
            }
        });
    });

    $('a.approve-comment').click((event) => {
        const commentId = event.target.id;

        $.ajax({
            url: '/approval/comments/approve',
            type: 'PATCH',
            data: JSON.stringify({
                id: commentId
            }),
            success: () => {
                location.reload();
            }
        });
    });

    $('a.remove-comment').click((event) => {
        if (! confirm('Are you sure?')) {
            return;
        }

        const commentId = event.target.id;

        $.ajax({
            url: '/approval/comments/remove',
            type: 'DELETE',
            data: JSON.stringify({
                id: commentId
            }),
            success: () => {
                location.reload();
            }
        });
    });

    $('a.approve-saint').click((event) => {
        const saintId = event.target.id;

        $.ajax({
            url: '/approval/saints/approve',
            type: 'PATCH',
            data: JSON.stringify({
                id: saintId
            }),
            success: () => {
                location.reload();
            }
        });
    });

    $('a.remove-saint').click((event) => {
        if (! confirm('Are you sure?')) {
            return;
        }

        const saintId = event.target.id;

        $.ajax({
            url: '/approval/saints/remove',
            type: 'DELETE',
            data: JSON.stringify({
                id: saintId
            }),
            success: () => {
                location.reload();
            }
        });
    });

    $('a.delete-user').click((event) => {
        if (! confirm('Are you sure?')) {
            return;
        }

        const userId = event.target.id;

        $.ajax({
            url: '/users/' + userId,
            type: 'DELETE',
            data: JSON.stringify({
                id: userId
            }),
            success: () => {
                window.location.replace('/');
            }
        });
    });
});