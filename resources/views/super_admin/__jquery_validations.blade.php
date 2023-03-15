@section('plugins.jqueryValidation',true)
<script>
    $('form').each(function(index, value) {
        if ($(this).data('validate') == true) {
            console.log('Validation activated');
            $(this).validate({
                errorElement: 'div',
                errorPlacement: function(error, element) {
                    error.addClass('text-danger');
                    element.closest('.col-sm-10').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        }
    });
</script>