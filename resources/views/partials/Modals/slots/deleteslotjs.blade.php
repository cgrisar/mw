$(document).ready(function(){
    $('#slotstable .icon.delete').click(function(){
        warehouse = {{ $warehouse->id }};
        slot = $(this).closest('td').attr('data-value');
        $('#deleteModal')
            .modal({
                closable : false,
                onApprove : function(){
                    $.ajax({
                        type : 'GET',
                        url : 'http://movingwine.app/warehouses/' + warehouse + '/slots/' + slot + '/delete',
                        success : location.reload()
                    })
                }
            })
            .modal('show');
    });
});