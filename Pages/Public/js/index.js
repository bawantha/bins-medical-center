$(document).ready(function(){
    $('#diseaseButton').click(function(e){
        e.preventDefault();

        $('#exampleModal')
            .modal('hide')
            .on('hidden.bs.modal', function (e) {
                $('#exampleModal1').modal('show');

                $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
            });

    });
});
