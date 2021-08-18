$(document).ready(() => {
    let errors = [
        'name',
        'surname',
        'email',
        'password',
        'confirm-password'
    ];

    addEventsToInptus();

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
        errors.forEach((error, index) => {
            if (! $('#' + error).val()) {
                $('#' + error).addClass('is-invalid');
            }
        });

        if (errors.length > 0) {
            return false;
        }
    });

    function addEventsToInptus()
    {
        errors.forEach((error) => {
            if (! $('#' + error).val()) {
                $('#' + error).focusout(() => {
                    validate(error);
                });
            } else {
                $('#' + error, () => {
                    validate(error);
                });
            }
        });
    }

    function validate(element) {
        if (! $('#' + element).val()) {
            addError(element);
            $('#' + element).addClass('is-invalid');
        } else {
            removeError(element);
            $('#' + element).removeClass('is-invalid');
        }
    }

    function addError(error) {
        ! errors.find(item => item === error) ? errors.push(error) : null;
    }

    function removeError(error) {
        const index = errors.findIndex(item => item === error);
        if (index != -1) {
            errors.splice(index, 1);
        }
    }

    function isEmail(email) {
        let regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
});