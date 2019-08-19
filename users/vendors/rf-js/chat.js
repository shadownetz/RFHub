$(function () {
    $(".js-chat-snd").click(sendMessage);
    let parent_block = $("#rf-chat-block");
    parent_block.scrollTop(parent_block.height() + 200);
    function sendMessage(event) {
        event.preventDefault();
        // let parent_block = $("#rf-chat-block");
        let message_block = $("#js-msg-holder");
        let message = message_block.val();
        // let sender_message_block = $(".chat-right-block");
        let sender_message_block = $("#rf-chat-block");
        // let sender_messages = sender_message_block.html();
        let status = true;
        $.post( "chat_post.php", {send_message:true, message: message })
        .done(function() {
            if(message.length>0){
                new_message = message;
                new_message_html = " \
                <div class='col-12 js-chat-sender chat-right-block'><div class='col-12'><div class='chat-icn pull-right'><p>\
                    <span style = 'float:right' > <i class='fa fa-user'></i> you</span ></p >\
                        <p>" + new_message + "</p></div></div></div>";
                // let final_message = sender_messages + new_message_html;
                // sender_message_block.html(final_message);
                sender_message_block.append(new_message_html);
                parent_block.animate({ scrollTop: parent_block.height() + 100 }, 800);
                // Swal.fire({
                //     position: 'center',
                //     type: 'success',
                //     title: 'Success',
                //     showConfirmButton: false,
                //     timer: 2000
                // });
                message_block.val("");
            }
        })
        .fail(function() {
            swiss_allert('warning', 'An unknown error occured. Please check your internet connection!', '');
        })

    }
})
