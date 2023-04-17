@section('plugins.jqueryValidation',true)
<script>
    $('form').each(function(index, value) {
        if ($(this).data('validate') == true) {
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

    // $('form').each(function(index, value) {
    //     if ($(this).data('validate-remote') == true) {
    //         let start_at = $('#start_at').val();
    //         let end_at = $('#end_at').val();
    //         console.log(start_at, end_at);
    //         console.log('hello');
    //         $(this).validate({
    //             rules: {
    //                 start_at: {
    //                     required: true,
    //                     remote: {
    //                         url: "isShowAvailable",
    //                         type: "post",
    //                         data: 'start_at=' + start_at + '&end_at=' + end_at + '&_token={{csrf_token()}}',
    //                         messages: {
    //                             start_at: {
    //                                 remote: "Show exist"
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //         });
    //     }
    // });

</script>