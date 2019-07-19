    $(document).ready(function() {
        $('#sendMessageForm').on('submit', function (e) {
            e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'function/messages.php',
                    data: $('#sendMessageForm').serialize(),
                    success: function () {
                        $('#textarea').val(''); 
                    }
                });

        });

    });
