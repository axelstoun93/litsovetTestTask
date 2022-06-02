<?= $this->extend('layout/page') ?>

<?= $this->section('sidebar') ?>
<?= $sidebar ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= $content ?>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $footer ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script src="<?php echo base_url(); ?>/admin/assets/vendor/axios/axios.min.js"></script>
<script>


    $(document).on('change', '.file-input', function() {
        var filesCount = $(this)[0].files.length;

        var textbox = $(this).prev();

        if (filesCount === 1) {
            var fileName = $(this).val().split('\\').pop();
            textbox.text(fileName);
        } else {
            textbox.text(filesCount + ' files selected');
        }
    });

    $('#load-book').submit(function (e) {

        e.preventDefault();

        $('.loading').show();

        let formData = new FormData();
        let urlForm = $(this).attr('action');

        formData.append('book', $('#test-file')[0].files[0]);

        axios.post(urlForm, formData, {
            headers: {'Content-Type': 'multipart/form-data'}
        }).then(resp => {

            let redirectUrl = resp.data.redirect_url;
            window.location.href = redirectUrl;

        }).catch(error => {

            $('.loading').hide();

            if (!!error.response.data.errors) {
                $('.error-message').empty();

                $.each(error.response.data.errors, function (key, value) {
                    $('.error-message').append(value);
                });
                $('.error-message').show();
            }

        });

    })





</script>
<?= $this->endSection() ?>
