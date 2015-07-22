$(function (){

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#uploadCtl').on('change', function (){
        readURL(this)
    })

    $('.thumb-list').on('click', function (){
        $('.modal-title').html('Preview');
        $('.modal-body').html('<img src="' + $(this).attr('data-zoom') + '"  style="max-width: 500px;"/>');
        $('#myModal').modal('show')
    });

    $('.ajax-details').on('click', function (e){
        e.preventDefault();
        $('.modal-body').load($(this).attr('href'), function (){
            $('#myModal').modal('show')
        });
    });
})