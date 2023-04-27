<script>
    $(document).ready(function () {

        let show_prize_list = [];
        let show_id_list = []
        var seat_array = new Set();
        let name = $('#name').val();

        $('#name').on('input', function () {
            name = $('#name').val();
            if (name.length < 6) {
                $('#name-error').html('Name should be more than 4 characters.');
                $('#name').css('borderColor', 'red');
                $('#ticket_count, #show_id, #screen_id, #movie_id, #cinema_id').attr('disabled', true);
            } else if (name.length > 50) {
                $('#name-error').html('Name should be less than 50 characters.');
                $('#name').css('borderColor', 'red');
                $('#ticket_count, #show_id, #screen_id, #movie_id, #cinema_id').attr('disabled', true);
            } else {
                let show_id = parseInt($('#show_id').val());
                if (!show_id) {
                    $('#show_id, #screen_id, #movie_id, #cinema_id').attr('disabled', false);
                } else {
                    $('#ticket_count, #show_id, #screen_id, #movie_id, #cinema_id').attr('disabled', false);
                }
                $('#name-error').html('');
                $('#name').css('borderColor', 'Gainsboro');

            }
        })

        $('#cinema_id, #movie_id').change(function () {
            let cinema_id = $('#cinema_id').val();
            let movie_id = $('#movie_id').val();
            name = $('#name').val();
            if (name.length >= 4 && name.length <= 50) {
                if (cinema_id != '' && movie_id != '') {
                    $.ajax({
                        url: '{{ route('bookings.getScreens') }}',
                        type: 'post',
                        data: 'cinema_id=' + cinema_id + '&_token={{csrf_token()}}',
                        success: function (result) {
                            $('#screen_id').html('<option value="">-- Select Screen --</option>');
                            $.each(result, function (key, value) {
                                $("#screen_id").append('<option value="' + value
                                    .id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#screen_id').html('<option value="">-- Select Cinema & Movie --</option>');
                }
            } else {
                $('#name-error').html('<p>Name is required</p>');
                $('#name').css('borderColor', 'red');
                $('#ticket_count, #show_id, #screen_id, #movie_id, #cinema_id').attr('disabled', true);
            }

        });

        $('#movie_id, #screen_id').change(function () {
            let movie_id = $('#movie_id').val();
            let screen_id = $('#screen_id').val();
            if (screen_id != '' && movie_id != '') {
                show_prize_list = [];
                show_id_list = [];
                $.ajax({
                    url: '{{ route('bookings.getShows') }}',
                    type: 'post',
                    data: 'screen_id=' + screen_id + '&movie_id=' + movie_id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        $('#show_id-error').html('');
                        $('#show_id').html('<option value="">-- Select Show --</option>');
                        $.each(result, function (key, value) {
                            $("#show_id").append('<option value="' + value
                                .id + '">' + value.start_at + " to " + value.end_at + '</option>');
                            show_prize_list.push(value.price);
                            show_id_list.push(value.id);
                        });
                        if (result.length != 0) {
                            $('#show_id-error').html('');
                        } else {
                            $('#show_id-error').html('<p>No show available</p>');
                        }
                    }
                });
            } else {
                $('#show_id').html('<option value="">-- Select Movie & Screen --</option>');
            }
        });


        $('#screen_id').change(function () {
            var screen_id = $('#screen_id').val();
            if (screen_id) {
                $("#seat-menu").removeClass("d-none")
            }
            $("#section").load(location.href + " #section");
            if (screen_id != '') {
                $.ajax({
                    url: '{{ route('bookings.getSeats') }}',
                    type: 'post',
                    data: 'screen_id=' + screen_id + '&_token={{csrf_token()}}',
                    success: function (result) {
                        $('<div class="screen"></div>').appendTo('#screen_section')

                        const letter = 'A'.charCodeAt(0);
                        for (let i = letter; i < (letter + result.rows); i++) {
                            var index_letter = $('<p>' + String.fromCharCode(i) + '</p>')
                            index_letter.appendTo('#index');
                        }

                        const aCharCode = 'A'.charCodeAt(0);
                        for (let i = aCharCode; i < (aCharCode + result.rows); i++) {
                            var row = $('<tr></tr>');
                            for (var x = 1; x <= result.cols; x++) {
                                $('<td id="' + String.fromCharCode(i) + '' + x + '">' + x + '</td>').appendTo(row);
                            }
                            row.appendTo('#seats_formation');
                        }
                    }
                });
            } else {
                $("#seat-menu").addClass("d-none")
                $('#show_id-error').html('');
                $('#ticket_count-error').html('');
            }
        });

        $('#show_id').change(function () {

            $('#seats_formation td').css('background-color', 'white');
            $('#seats_formation td').prop('disabled', false);
            let screen_id = $('#screen_id').val();
            let show_id = $('#show_id').val();
            if (show_id != '') {
                $('#show_id-error').html('');
                $('#ticket_count').attr('disabled', false);
                $.ajax({
                    url: '{{ route('bookings.getSelectedTickets') }}',
                    type: 'post',
                    data: 'screen_id=' + screen_id + '&show_id=' + show_id + '&_token={{csrf_token()}}',
                    success: function (data) {

                        if (data[0]['group_concat(seat_array)'] !== null) {
                            let seats_string = data[0]['group_concat(seat_array)'];
                            let seats_array = seats_string.split(',');
                            for (var i = 0; i < seats_array.length; i++) {
                                let seat = seats_array[i];
                                $('#' + seat).prop('disabled', true);
                                $('#' + seat).css('background-color', 'gray');
                            }
                        }
                    }
                });

                $('#ticket_count').change(function () {
                    var ticket_count = $(this).val();
                    var count = 0;
                    var tcount = Number(ticket_count) + 1;
                    $('#ticket_count-error').html('');
                    $('#ticket_count, #show_id, #screen_id, #movie_id, #cinema_id, #name').attr('disabled', true);
                    $('html, body').animate({
                        scrollTop: $("#section").offset().top
                    }, 1000);
                    $(document).on("click", "#seats_formation td", function (e) {

                        var data = $(this).attr('id');

                        if (ticket_count != '' && count < tcount) {
                            this.style.backgroundColor = this.style.backgroundColor == 'green' ? 'white' : 'green';
                            if (this.style.backgroundColor == 'green') {
                                seat_array.add(data);
                                count++;

                            }
                            if (this.style.backgroundColor == 'white') {
                                seat_array.delete(data);
                                count--;

                            }

                        } else if (ticket_count != '' && count == tcount) {
                            this.style.backgroundColor = this.style.backgroundColor == 'green' ? 'white' : '';
                            if (this.style.backgroundColor == 'white') {
                                seat_array.delete(data);
                                count--;

                            }
                        }
                    });

                });
            } else {
                $('#ticket_count').attr('disabled', true);
            }
        });

        $('#book_submit').on('click', function () {
            let name = $('#name').val();
            let cinema_id = $('#cinema_id').val();
            let movie_id = $('#movie_id').val();
            let screen_id = $('#screen_id').val();
            let show_id = parseInt($('#show_id').val());
            let ticket_count = parseInt($('#ticket_count').val()) + 1;
            let amount = show_prize_list[show_id_list.indexOf(show_id)] * ticket_count;
            let seats = Array.from(seat_array);
            console.log(show_id);
            let count = 0;
            if (seat_array.size == ticket_count) {
                if (count == 0) {
                    $.ajax({
                        url: '{{ route('bookings.getTickets') }}',
                        type: 'post',
                        data: 'name=' + name + '&amount=' + amount + '&cinema_id=' + cinema_id + '&movie_id=' + movie_id + '&screen_id=' + screen_id + '&show_id=' + show_id + '&seat_array=' + seats + '&_token={{csrf_token()}}',
                        success: function () {
                            location.href = '{{ route( 'bookings.index' ) }}';
                        }
                    });
                    count++;
                } else {
                    location.href = '';
                }
            } else if (!show_id) {
                $('#show_id-error').html('Show not selected.');
                $('html, body').animate({
                    scrollTop: $("#booking_form").offset().top
                }, 1000);
            } else if (!ticket_count) {
                $('#show_id-error').html('');
                $('#ticket_count-error').html('Number of Tickets not selected.');
                $('html, body').animate({
                    scrollTop: $("#booking_form").offset().top
                }, 1000);
            } else {
                alert('Select total ' + ticket_count + ' tickets.');
            }
        });

    });
</script>
