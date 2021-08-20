$(document).ready(() => {
    $(() => {
        $('[data-toggle="tooltip"]').tooltip();
    });

    // Register
    let errors = [
        'name',
        'surname',
        'email',
        'password',
        'confirm-password'
    ];

    addEventsToInptus(errors);

    $('#email').focusout(() => {
        if (isEmail($('#email').val())) {
            removeError('email');
            $('#email').removeClass('is-invalid');
        } else {
            addError('email');
            $('#email').addClass('is-invalid');
        }
    });

    $('#confirm-password').focusout(() => {
        if (! $('#password').val() && ! $('#confirm-password').val()) {
            validate('password');
            validate('confirm-password');
        } else {
            const password = $('#password').val();
            const confirmPassword = $('#confirm-password').val();

            if (password !== confirmPassword){
                addError('password');
                addError('confirm-password');
                $('#password').addClass('is-invalid');
                $('#confirm-password').addClass('is-invalid');
            } else {
                removeError('password');
                removeError('confirm-password');
                $('#password').removeClass('is-invalid');
                $('#confirm-password').removeClass('is-invalid');
            }
        }
    });

    $('#photo-input').change((event) => {
        const photo = event.target.files[0];
        const photoUrl = URL.createObjectURL(photo);

        $('#photo-img').attr('src', photoUrl);
        $('#user-photo').css({display: 'flex'});
    });

    $('#remove-user-photo').click(() => {
        $('#photo-img').attr('src', null);
        $('#user-photo').css({display: 'none'});
        $('#photo-input').val(null);
    });

    $('#form').submit(() => {
        errors.forEach((error) => {
            if (! $('#' + error).val()) {
                $('#' + error).addClass('is-invalid');
            }
        });

        if (errors.length > 0) {
            return false;
        }
    });

    function addEventsToInptus(list)
    {
        list.forEach((error) => {
            if (! $('#' + error).val()) {
                $('#' + error).focusout(() => {
                    if ($('#' + error).attr('title') !== undefined) {
                        $('#' + error).attr('title', 'Fill this field').tooltip('_fixTitle');
                    }

                    validate(error, list);
                });
            } else {
                $('#' + error, () => {
                    if ($('#' + error).attr('title') !== undefined) {
                        $('#' + error).attr('title', 'Fill this field').tooltip('_fixTitle');
                    }

                    validate(error, list);
                });
            }
        });
    }

    function validate(element, list) {
        if (! $('#' + element).val()) {
            addError(element, list);
            $('#' + element).addClass('is-invalid');
        } else {
            removeError(element, list);
            $('#' + element).removeClass('is-invalid');

            if ($('#' + element).attr('title') !== undefined) {
                $('#' + element).attr('title', '').tooltip('dispose');
            }
        }
    }

    function addError(error, list) {
        if (error === 'saint-photo-input') {
            $('#photo-img').css({border: 'solid red 5px'});
        }
        ! list.find(item => item === error) ? list.push(error) : null;
    }

    function removeError(error, list) {
        if (error === 'saint-photo-input') {
            $('#photo-img').css({border: 'none'});
        }

        const index = list.findIndex(item => item === error);
        if (index != -1) {
            list.splice(index, 1);
        }
    }

    function isEmail(email) {
        let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }

    // Register Saint

    $('#saint-photo-input').change((event) => {
        const photo = event.target.files[0];
        const photoUrl = URL.createObjectURL(photo);

        $('#photo-img').attr('src', photoUrl);
        $('#remove-saint-photo').css({display: 'flex'});
    });

    $('#remove-saint-photo').click(() => {
        $('#photo-img').attr('src', '/images/sacred heart of jesus.webp');
        $('#remove-saint-photo').css({display: 'none'});
        $('#saint-photo-input').val(null);
    });

    let saintErrors = [
        'saint-photo-input',
        'saint-name',
        'saint-phrase',
        'saint-baptism-name',
        'saint-birthdate',
        'saint-feast-date',
        'saint-nation',
        'saint-city',
        'saint-bio',
        'saint-prayer'
    ];

    addEventsToInptus(saintErrors);

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

    $('#submit').click(() => {
        $('#saint-form').submit();
    });

    $('#saint-form').submit(() => {
        saintErrors.forEach((error) => {
            if (! $('#' + error).val()) {
                if (error === 'saint-photo-input') {
                    $('#photo-img').css({border: 'solid red 5px'});
                } else {
                    $('#' + error).addClass('is-invalid');

                    if ($('#' + error).attr('title') !== undefined) {
                        $('#' + error).attr('title', 'Fill this field').tooltip('_fixTitle');
                    }
                }
            }
        });

        if (saintErrors.length > 0) {
            return false;
        }
    });
});