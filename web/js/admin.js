function confirmDelete() {
    if( confirm("Удалить эту страницу") ) {
        return true;
    } else {
        return false;
    }
}

function moderation(id, operation) {
    $.ajax({
        url: '/admin/contacts/moderation',
        type: "POST",
        data: {
                id:id,
                operation:operation
            },
        success: function(data){
            if(data) {
                if(operation==0){
                    $('#messageButton'+id).removeClass('btn-success').addClass('btn-danger').html('Отклонить').attr('onclick','moderation('+id+',1);');
                    $('#messageLabel'+id).removeClass('label-danger').addClass('label-success').html('Принят');
                }
                if(operation==1){
                    $('#messageButton'+id).removeClass('btn-danger').addClass('btn-success').html('Принять').attr('onclick','moderation('+id+',0);');
                    $('#messageLabel'+id).removeClass('label-success').addClass('label-danger').html('Отклонено');
                }
            }
        },
        beforeSend: function() {
            $('#messageButton'+id).attr('disabled','disabled');
        },
        complete: function() {
            $('#messageButton'+id).removeAttr('disabled');
        }
    });
//    $.post(
//            '/admin/contacts/moderation', 
//            {
//                id:id,
//                operation:operation
//            },
//            function(data){
//        if(data) {
//            if(operation==0){
//                $('#messageButton'+id).removeClass('btn-success').addClass('btn-danger').html('Отклонить').on("click",function(){moderation(id,1)});
//                $('#messageLabel'+id).removeClass('label-danger').addClass('label-success').html('Принят');
//            }
//            if(operation==1){
//                $('#messageButton'+id).removeClass('btn-danger').addClass('btn-success').html('Принять').on("click",function(){moderation(id,0)});
//                $('#messageLabel'+id).removeClass('label-success').addClass('label-danger').html('Отклонено');
//            }
//        }
//    });
}