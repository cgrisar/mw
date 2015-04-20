$(document).ready(function(){
    $('#Create').click(function(){
        $('#createSlotForm')
            .form({
                address: {
                    identifier : 'address',
                    rules : [
                        {   type : 'empty',
                            prompt : 'enter the address of the slot'
                        }
                    ]
                },
                capacity: {
                    identifier : 'capacity',
                    rules : [
                        {   type : 'empty',
                            prompt : 'enter the address of the slot'
                        }
                    ]
                }
            });
        $('#createModal').modal('show');
        $('.ui.radio.checkbox')
            .checkbox();
    });
});