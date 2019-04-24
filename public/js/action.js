$(function () {
    $('#cadastrar-editar .close').click(function () {
        $('#cadastrar-editar').modal('hide');
    });

    $('#cadastrar-editar .cancelar').click(function () {
        $('#cadastrar-editar').remove();
    });

    $('.editar').click(function (e) {
        e.preventDefault();
        id = $(this).data('id');
        $.ajax({
            url: 'card',
            type: 'get',
            data: {
                id: id,
            },
            dataType: 'JSON',
            success:function (data) {
                $('#cadastrar-editar input[name=type][value=' +data.type + ']').attr('checked', 'checked');
                if(data.educational_material === 1){
                    $('#cadastrar-editar .check1').attr('checked', true);
                    $('#cadastrar-editar .check2').attr('checked', false);
                }else if(data.educational_material === 2){
                    $('#cadastrar-editar .check1').attr('checked', false);
                    $('#cadastrar-editar .check2').attr('checked', true);
                }else if(data.educational_material === 3){
                    $('#cadastrar-editar .check1').attr('checked', true);
                    $('#cadastrar-editar .check2').attr('checked', true);
                }

                $('#cadastrar-editar #id').val(id);

                $('#year').val(data.year);
                $('#cadastrar-editar #id_course option[value='+data.id_course+']').attr('selected','selected');
                $('#cadastrar-editar #id_discipline option[value='+data.id_discipline+']').attr('selected','selected');
                for(i = 0; i < data.teachers.length; i++) {
                    if(i === 0){
                        $('#id_teacher').val(data.teachers[i].id);
                    }
                }

            }
        })
    });


    $('.add_more').click(function(e){
        e.preventDefault();
        $(this).after("<p></p><input name='file[]' type='file'/>");
    });

    $('.remove_file').click(function(e){
        e.preventDefault();
        $(this).delete("<p></p><input name='file[]' type='file'/>");
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#cadastrar_form').click(function() {

        formdata = new FormData();;
        if($('#image').prop('files').length > 0) {
            file =$('#image').prop('files')[0];
            formdata.append("file", file);
        }

        var type = $('input[name=type]:checked').val();
        var material = [];
        $("input[type='checkbox']:checked").each(function() {
            material.push($(this).val());
        });
        var year = $('#year').val();
        var id_course = $('#id_course').val();
        var id_discipline = $('#id_discipline').val();
        var id_teacher = $('#id_teacher').val();
        var id = $('#id').val();

        if(type === 'undefined') {
            return;
        }
        if(material === 'undefined'){
            return;
        }
        if(id_course === 'undefined'){
            return;
        }
        if(id_discipline === 'undefined'){
            return;
        }
        if(id_teacher === 'undefined'){
            return;
        }
        if(id == 'undefined' || id === '') {
            $.ajax({
                url: 'cadastrar',
                type: 'post',
                data: {
                    type: type,
                    material: material,
                    year: year,
                    id_course: id_course,
                    id_discipline: id_discipline,
                    id_teacher: id_teacher,
                },
                dataType: 'JSON',

                success: function (data) {
                    console.log(data);
                    if(data.id !== 'undefined' && $('#image').prop('files').length > 0){
                        formdata.append("id", data.id);
                        $.ajax({
                            url: 'upload',
                            type: 'post',
                            data: formdata,
                            processData: false,
                            contentType: false,
                            success: function (data) {
                                console.log(data);
                            }
                        })
                    }
                    $('#cadastrar-editar').modal('hide');
                    location.reload();

                }
            })
        }
        $.ajax({
            url: 'editar',
            type: 'put',
            data: {
                type: type,
                material: material,
                year: year,
                id_course: id_course,
                id_discipline: id_discipline,
                id_teacher: id_teacher,
                id:id
            },
            dataType: 'JSON',
            success: function (data) {
                $('#cadastrar-editar').modal('hide');
                location.reload();
            }
        })
    })
});
