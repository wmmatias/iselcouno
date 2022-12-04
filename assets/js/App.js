$(document).ready(function(){
    $('#datatable').DataTable({
        "order":[],
        "aLengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
        "pageLength": 3,
        "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information"ip><"clear">'
    });


    $('#profile').on('show.bs.modal', function (e) {
        $('form#form-input input').attr('readonly',true);
        $('form #form-button').attr('disabled',true);
        $('#change_password').hide();
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

    $.get('/dashboards/index_html', function(res) {
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