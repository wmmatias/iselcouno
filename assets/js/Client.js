$(document).ready(function(){

    $('#profile').on('show.bs.modal', function (e) {
        $('form#form-input input').attr('readonly',true);
        $('form #form-button').attr('disabled',true);
        $('#change_password').hide();
    });

    $('#apply').on('show.bs.modal', function (e) {
        $('#blk').attr('readonly',true);
        $('#baranggay').attr('readonly',true);
        $('#city').attr('readonly',true);
        $('#firstname').attr('readonly',true);
        $('#lastname').attr('readonly',true);
        $('#ptc').attr('disabled', true)
        $('#ptc1').hide();
    });
   

    $('#new_address').change(function(){
        if($('#new_address:checked').length){
            $('#blk').attr('readonly',false);
            $('#baranggay').attr('readonly',false);
            $('#city').attr('readonly',false);
            $('#firstname').attr('readonly',false);
            $('#lastname').attr('readonly',false);
        }else{
            $('#blk').attr('readonly',true);
            $('#baranggay').attr('readonly',true);
            $('#city').attr('readonly',true);
            $('#firstname').attr('readonly',true);
            $('#lastname').attr('readonly',true);
        }
    });

    $('#edit').change(function(){
        var verify = document.getElementById('verify');
        if(verify){
            alert('Please verify your email!')
            $('#edit').attr('disabled', true)
            $('#edit').prop('checked', false)
        }
        else{
            if($('#edit:checked').length){
                $('form#form-input input').attr('readonly',false);
                $('form #form-button').attr('disabled',false);
                $('#change').attr('disabled', true)
            }else{
                $('form#form-input input').attr('readonly',true);
                $('form #form-button').attr('disabled',true);
                $('#change').attr('disabled', false)
            }
        }
    });

    $('#change').change(function(){
        var verify = document.getElementById('verify');
        if(verify){
            alert('Please verify your email!')
            $('#change').attr('disabled', true)
            $('#change').prop('checked', false)
        }
        else{
            if($('#change:checked').length){
                $('#change_password').show();
                $('#form-input').hide();
                $('#edit').attr('disabled', true)
            }else{
                $('#change_password').hide();
                $('#form-input').show();
                $('#edit').attr('disabled', false)
            }
        }
    });

    // $('#permanent').change(function(){
    //     if($('#permanent:checked').length){
    //         $('#temporary').attr('disabled', true)
    //         $('#ptc').attr('disabled', true)
    //         $('#cfei').attr('disabled', false)
    //         $('#bfp').attr('disabled', false)
    //         $('#ptc1').hide();
    //         $('#cfei1').show();
    //         $('#bfp1').show();
    //     }else{
    //         $('#temporary').attr('disabled', false)
    //     }
    // });

    // $('#temporary').change(function(){
    //     if($('#temporary:checked').length){
    //         $('#permanent').attr('disabled', true)
    //         $('#ptc1').show();
    //         $('#cfei1').hide();
    //         $('#bfp1').hide();
    //         $('#cfei').attr('disabled', true)
    //         $('#bfp').attr('disabled', true)
    //         $('#ptc').attr('disabled', false)
    //     }else{
    //         $('#permanent').attr('disabled', false)
    //     }
    // });

    $.get('/clients/index_html', function(res) {
        $('#details').html(res);
    });

    $(document).on('submit', '#form-input', function(){
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function(res){
            $('#details').html(res);
            $('#edit').prop('checked', false)
            $('#change').attr('disabled', false)
            $('#change_password').hide();
            // $('#profile').modal('hide');
            // toastr.success("Profile update Success!");
        });
        return false;
    });

    $(document).on('submit', '#change_password', function(){
        var form = $(this);
        $.post(form.attr('action'), form.serialize(), function(res){
            $('#details').html(res);
            $('#form-input').hide();
        });
        return false;
    });

});