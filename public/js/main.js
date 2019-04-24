$(function () {
    var kanbanCol = $('.panel-body');
    kanbanCol.css('max-height', (window.innerHeight - 150) + 'px');

    var kanbanColCount = parseInt(kanbanCol.length);
    $('.container-fluid').css('min-width', (kanbanColCount * 350) + 'px');

    draggableInit();

    $('.panel-heading').click(function() {
        var $panelBody = $(this).parent().children('.panel-body');
        $panelBody.slideToggle();
    });
});

function draggableInit() {
    var sourceId;
    var id;

    $('[draggable=true]').bind('dragstart', function (event) {
        sourceId = $(this).parent().attr('id');//nome do painel
        console.log(event.target.getAttribute('id'));
        event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));//id
        id = event.target.getAttribute('id');
    });

    $('.panel-body').bind('dragover', function (event) {
        event.preventDefault();
    });

    $('.panel-body').bind('drop', function (event) {
        var children = $(this).children();
        var targetId = children.attr('id');
        console.log(id);
        console.log(targetId);
        console.log(sourceId);
        var elementId = event.originalEvent.dataTransfer.getData("text/plain");
        event.preventDefault();
        if (sourceId != targetId) {
            $.ajax({
                url: 'mover',
                type: 'put',
                data: {
                    id: id,
                    status_affter: targetId,
                    status_before: sourceId,
                },
                dataType: 'JSON',

                success: function (data) {
                    if (data['mensage']) {
                        alert(data['mensage']);
                        return;
                    }
                    $('#processing-modal').modal('toggle');
                    setTimeout(function () {
                        var element = document.getElementById(elementId);
                        children.prepend(element);
                        $('#processing-modal').modal('toggle');
                    }, 1000);
                 }
            })
        }
    });
}

//professor
$('#professor').autocomplete({
    source: '/professor',
    minLength: 3
});

//curso
$.ajax({
    type: "get",
    url: "/curso",
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function (obj) {
        if (obj != null) {
            var data = obj;
            var selectbox = $('#curso');
            selectbox.find('option').remove();
            $.each(data, function (i, d) {
                $('<option>').val(d.id).text(d.name).appendTo(selectbox);
            });
        }
    }
});

//disciplina
$.ajax({
    type: "get",
    url: "/disciplina",
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function (obj) {
        if (obj != null) {
            var data = obj;
            var selectbox = $('#disciplina');
            selectbox.find('option').remove();
            $.each(data, function (i, d) {
                $('<option>').val(d.id).text(d.name).appendTo(selectbox);
            });
        }
    }
});

//aula
$.ajax({
    type: "get",
    url: "/aula",
    dataType: 'json',
    contentType: "application/json; charset=utf-8",
    success: function (obj) {
        if (obj != null) {
            var data = obj;
            var selectbox = $('#aula');
            selectbox.find('option').remove();
            $.each(data, function (i, d) {
                $('<option>').val(d.id).text(d.id).appendTo(selectbox);
            });
        }
    }
});