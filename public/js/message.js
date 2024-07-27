$(document).ready(function () {

    /* Send message to user */
    $("#send-message").on("click", function(event){

        const toId = $("#send-message").attr('data-to');
        let message = $("#message-body").val();

        if (message.trim().length > 0) {
            // Get from ID from the PHP SESSION to avoid sending msgs as different user
            $.post("/php_js/user.php", {
                urlcommand: 'getUserIdFromSession'
            }).done(function (data) {
                const parsedData = JSON.parse(data)
                const fromId = parsedData['id'];

                console.log(toId)
                console.log(fromId)
                console.log(message)

                // Send message
                $.post("/php_js/message.php", {
                    urlcommand: 'sendMessage',
                    fromId: fromId,
                    toId: toId,
                    message: message
                }).done(function (data) {
                    const parsedData = JSON.parse(data)
                    console.log(parsedData)

                    if(parsedData['status_code'] == 201) {
                       $('#send-msg-response-wrapper').html(
                           '<p class="alert alert-success">Message sent</p>'
                       );
                    } else {
                            $('#send-msg-response-wrapper').html(
                                '<p class="alert alert-danger">Error while sending message</p>'
                            );
                    }

                    setTimeout(function(){
                        location.reload();
                    }, 300)


                }).fail(function (xhr, status, error) {
                    alert("Unable to send message")
                });

            }).fail(function (xhr, status, error) {

            });
        }
    });



});
