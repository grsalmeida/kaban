<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Kaban</title>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link href="{{asset('css/main.css')}}" rel="stylesheet">
    </head>

    <form>
        <div class="container-fluid">
            <p></p>
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="curso">Curso</label>
                        <select class="form-control" name="curso" id="curso">
                            <option value="null">Selecionar</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="disciplina">Disciplina</label>
                        <select class="form-control" name="disciplina" id="disciplina">
                            <option value="null">Selecionar</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="aula">N° Aula</label>
                        <select class="form-control" name="aula" id="aula">
                            <option value="null">Selecionar</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="professor">Nome do Professor</label>
                        <input type="text" class="form-control" name="professor" id="professor"/>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ano">Ordernar Por</label>
                                <select class="form-control" name="ano" id="ano">
                                    <option value="null">ano</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" name="order" id="order" style="margin-top: 24px;">
                                    <option value="asc">asc</option>
                                    <option value="desc">desc</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div id="sortableKanbanBoards" class="row">
                <div class="col-md-12">

                    <div class="panel panel-primary kanban-col">
                        <div class="panel-heading">
                            Demanda <span class="badge">{{$card['total_demanda']}}</span>
                        </div>
                        <div class="panel-body">
                            <div id="demanda" class="kanban-centered">
                                @if(isset($card['demanda']))
                                    @foreach($card['demanda'] as $key => $demanda)
                                        <article class="kanban-entry grab" id="{{$demanda['aula']}}" draggable="true">
                                            <div class="kanban-entry-inner">
                                                <div class="kanban-label">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <span style="font-weight: bold;">{{$demanda['curso']}}</span>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                        <p></p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <span style="font-size: 10px; font-weight: bold;">{{$demanda['disciplina']}}</span>
                                                        </div>
                                                        <div class="col-md-04">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h6 class="text-center" style="background-color: #3490dc;left:16px;position: relative;padding-left: 25px;padding-right: 32px;padding-bottom: 10px;top: -25px;padding-top: 10px;">
                                                                    {{$demanda['aula']}}
                                                                </h6>
                                                            </div>
                                                            <div class="col-md-2" style="background-color: #38c172;top: 21px;right: 14px;padding-left: 10px;">
                                                                <span class="text-center">{{$demanda['ano']}}</span>
                                                            </div>
                                                        </div>
                                                        @foreach($demanda['professor'] as $professor)
                                                            <div class="col-md-4" style="background-color: #3490dc;margin-left: 10px;border-radius: 4px;padding: 6px;">
                                                                <div style="color: #ffffff;font-size: 9px; font-weight: bold;">
                                                                    {{$professor}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            @if($demanda['material'] === 1 ||$demanda['material'] === 3)
                                                                <span class="glyphicon glyphicon-file" style="margin-bottom: 10px;margin-top: 13px;"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if($demanda['material'] === 2 ||$demanda['material'] === 3)
                                                                <span class="glyphicon glyphicon-facetime-video" style="margin-bottom: 10px;margin-top: 13px;"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2" style="margin-bottom: 10px;margin-top: 13px;left:45%">
                                                            <span><a href="#" data-toggle="modal" class="editar" data-id="{{$demanda['aula']}}" data-target="#cadastrar-editar">Editar</a></span>
                                                        </div>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="#" data-toggle="modal" data-target="#cadastrar-editar">criar card</a>
                        </div>
                    </div>

                    <div class="panel panel-info kanban-col">
                        <div class="panel-heading">
                            Material Recebido <span class="badge">{{$card['total_recebido']}}</span>
                        </div>
                        <div class="panel-body">
                            <div id="recebido" class="kanban-centered">
                                @if(isset($card['recebido']))
                                    @foreach($card['recebido'] as $key => $demanda)
                                        <article class="kanban-entry grab" id="{{$demanda['aula']}}" draggable="true">
                                            <div class="kanban-entry-inner">
                                                <div class="kanban-label">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <span style="font-weight: bold;">{{$demanda['curso']}}</span>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                        <p></p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <span style="font-size: 10px; font-weight: bold;">{{$demanda['disciplina']}}</span>
                                                        </div>
                                                        <div class="col-md-04">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h6 class="text-center" style="background-color: #3490dc;left:16px;position: relative;padding-left: 25px;padding-right: 32px;padding-bottom: 10px;top: -25px;padding-top: 10px;">
                                                                    {{$demanda['aula']}}
                                                                </h6>
                                                            </div>
                                                            <div class="col-md-2" style="background-color: #38c172;top: 21px;right: 14px;padding-left: 10px;">
                                                                <span class="text-center">{{$demanda['ano']}}</span>
                                                            </div>
                                                        </div>
                                                        @foreach($demanda['professor'] as $professor)
                                                            <div class="col-md-4" style="background-color: #3490dc;margin-left: 10px;border-radius: 4px;padding: 6px;">
                                                                <div style="color: #ffffff;font-size: 9px; font-weight: bold;">
                                                                    {{$professor}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            @if($demanda['material'] === 1 ||$demanda['material'] === 3)
                                                                <span class="glyphicon glyphicon-file" style="margin-bottom: 10px;margin-top: 13px;"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if($demanda['material'] === 2 ||$demanda['material'] === 3)
                                                                <span class="glyphicon glyphicon-facetime-video" style="margin-bottom: 10px;margin-top: 13px;"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2" style="margin-bottom: 10px;margin-top: 13px;left:45%">
                                                            <span><a href="#" data-toggle="modal" class="editar" data-id="{{$demanda['aula']}}" data-target="#cadastrar-editar">Editar</a></span>
                                                        </div>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-warning kanban-col">
                        <div class="panel-heading">
                            Para Conferencia <span class="badge">{{$card['total_conferencia']}}</span>
                        </div>
                        <div class="panel-body">
                            <div id="conferencia" class="kanban-centered">
                                @if(isset($card['conferencia']))
                                    @foreach($card['conferencia'] as $key => $demanda)
                                        <article class="kanban-entry grab" id="{{$demanda['aula']}}" draggable="true">
                                            <div class="kanban-entry-inner">
                                                <div class="kanban-label">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <span style="font-weight: bold;">{{$demanda['curso']}}</span>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                        <p></p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <span style="font-size: 10px; font-weight: bold;">{{$demanda['disciplina']}}</span>
                                                        </div>
                                                        <div class="col-md-04">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h6 class="text-center" style="background-color: #3490dc;left:16px;position: relative;padding-left: 25px;padding-right: 32px;padding-bottom: 10px;top: -25px;padding-top: 10px;">
                                                                    {{$demanda['aula']}}
                                                                </h6>
                                                            </div>
                                                            <div class="col-md-2" style="background-color: #38c172;top: 21px;right: 14px;padding-left: 10px;">
                                                                <span class="text-center">{{$demanda['ano']}}</span>
                                                            </div>
                                                        </div>
                                                        @foreach($demanda['professor'] as $professor)
                                                            <div class="col-md-4" style="background-color: #3490dc;margin-left: 10px;border-radius: 4px;padding: 6px;">
                                                                <div style="color: #ffffff;font-size: 9px; font-weight: bold;">
                                                                    {{$professor}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            @if($demanda['material'] === 1 ||$demanda['material'] === 3)
                                                                <span class="glyphicon glyphicon-file" style="margin-bottom: 10px;margin-top: 13px;"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if($demanda['material'] === 2 ||$demanda['material'] === 3)
                                                                <span class="glyphicon glyphicon-facetime-video" style="margin-bottom: 10px;margin-top: 13px;"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2" style="margin-bottom: 10px;margin-top: 13px;left:45%">
                                                            <span><a href="#" data-toggle="modal" class="editar" data-id="{{$demanda['aula']}}" data-target="#cadastrar-editar">Editar</a></span>
                                                        </div>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-success kanban-col">
                        <div class="panel-heading">
                            Conferido <span class="badge">{{$card['total_conferido']}}</span>
                        </div>
                        <div class="panel-body">
                            <div id="conferido" class="kanban-centered">
                                @if(isset($card['conferido']))
                                    @foreach($card['conferido'] as $key => $demanda)
                                        <article class="kanban-entry grab" id="{{$demanda['aula']}}" draggable="true">
                                            <div class="kanban-entry-inner">
                                                <div class="kanban-label">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <span style="font-weight: bold;">{{$demanda['curso']}}</span>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                        <p></p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <span style="font-size: 10px; font-weight: bold;">{{$demanda['disciplina']}}</span>
                                                        </div>
                                                        <div class="col-md-04">
                                                            <div class="col-md-4">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <h6 class="text-center" style="background-color: #3490dc;left:16px;position: relative;padding-left: 25px;padding-right: 32px;padding-bottom: 10px;top: -25px;padding-top: 10px;">
                                                                    {{$demanda['aula']}}
                                                                </h6>
                                                            </div>
                                                            <div class="col-md-2" style="background-color: #38c172;top: 21px;right: 14px;padding-left: 10px;">
                                                                <span class="text-center">{{$demanda['ano']}}</span>
                                                            </div>
                                                        </div>
                                                        @foreach($demanda['professor'] as $professor)
                                                            <div class="col-md-4" style="background-color: #3490dc;margin-left: 10px;border-radius: 4px;padding: 6px;">
                                                                <div style="color: #ffffff;font-size: 9px; font-weight: bold;">
                                                                    {{$professor}}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            @if($demanda['material'] === 1 ||$demanda['material'] === 3)
                                                                <span class="glyphicon glyphicon-file" style="margin-bottom: 10px;margin-top: 13px;"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2">
                                                            @if($demanda['material'] === 2 ||$demanda['material'] === 3)
                                                                <span class="glyphicon glyphicon-facetime-video" style="margin-bottom: 10px;margin-top: 13px;"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2" style="margin-bottom: 10px;margin-top: 13px;left:45%">
                                                            <span><a href="#" data-toggle="modal" class="editar" data-id="{{$demanda['aula']}}" data-target="#cadastrar-editar">Editar</a></span>
                                                        </div>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </article>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal modal-static fade" id="processing-modal" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                   <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-center">
                                <i class="fa fa-refresh fa-5x fa-spin"></i>
                                <h4>Processando...</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="cadastrar-editar" tabindex="-1" role="dialog" aria-labelledby="cadastrarLabel" data-backdrop="static">
                <form id="form" method="post" enctype="multipart/form-data">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Criar novo card</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id" value="">
                                <div class="form-group">
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="type" id="type" value="1" checked>
                                            Aula Regular
                                        </label>
                                    </div>
                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" name="type" id="type" value="2">
                                            Aulão Livre
                                        </label>
                                    </div>
                                </div>
                                <div class="form-inline" style="background: #ccc;padding-top: 10px;padding-bottom: 10px;padding-left: 15px;">
                                    <label>Material a ser Produzido</label>
                                    <p></p>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" class="check1" id="educational_material[]" value="1"> Apostila
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" class="check2" id="educational_material[]" value="2"> Video
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select class="form-control" name="year" id="year">
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                                    <option value="2021">2021</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="curso">Curso</label>
                                    <select class="form-control" name="id_course" id="id_course">
                                        <option value="null">Selecionar</option>
                                        @foreach($card['data']['course'] as $course)
                                            <option value="{{$course['id']}}">{{$course['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="disciplina">Disciplina</label>
                                    <select class="form-control" name="id_discipline" id="id_discipline">
                                        <option value="null">Selecionar</option>
                                        @foreach($card['data']['discipline'] as $discipline)
                                            <option value="{{$discipline['id']}}">{{$discipline['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-info btn-sm add_teacher">Adcionar Professor</button>
                                    <p></p>
                                    <div class="add-prof">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <select class="form-control" name="id_teacher[]" id="id_teacher">
                                                    <option value="null">Selecionar</option>
                                                    @foreach($card['data']['teacher'] as $teacher)
                                                        <option value="{{$teacher['id']}}">{{$teacher['name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="file" accept="image/*" id="image" name="image[]" multiple />
                                    <div id="preview"><img src="filed.png" /></div><br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default cancelar" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-primary" id="cadastrar_form">Salvar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="err"></div>
            </div>

        </div>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="{{asset('js/main.js')}}"></script>
        <script src="{{asset('js/action.js')}}"></script>
    </body>

</html>
