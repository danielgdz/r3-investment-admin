@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Actualizar bodega {{ str_pad($warehouse->id, 6, "0" ,STR_PAD_LEFT) }}</div>
                <div class="panel-body">
                    <form class="form" name="warehouse-store" method="POST" action="{{ route('warehouse-store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-2">
                            <label class="form-control">Nombre</label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="text" maxlength="200" name="name" value="{{ $warehouse->name }}"/><br>
                        </div>
                        <div class="col-md-2">
                            <label class="form-control">Código</label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="text" maxlength="5" name="code" value="{{ $warehouse->code }}"/><br>
                        </div>
                        <div class="col-md-4" style="border-radius: 25px; border: 2px solid #810B29;">
                            <label class="form-control">Descripción de la zona</label>
                            <textarea style="resize:none" class="form-control" name="description[0]" cols="30" rows="5">{{ @$warehouse->description[0] }}</textarea><br>
                            <label class="form-control">Galería de imágenes</label>
                            @for ($i = 0, $j = 0; $i < 4; $i++)
                                <div class="col-md-2">
                                    <a href="{{ @$warehouse->images->$j->$i }}" target="_blank"><img src="{{ @$warehouse->images->$j->$i }}" weight="25px" width="25px"></a>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="file" name="images[{{ $j }}][{{ $i }}]">
                                </div>
                            @endfor
                        </div>
                        <div class="col-md-4" style="border-radius: 25px; border: 2px solid #810B29;">
                            <label class="form-control">Descripción de la viña</label>
                            <textarea style="resize:none" class="form-control" name="description[1]" cols="30" rows="5">{{ @$warehouse->description[1] }}</textarea><br>
                            <label class="form-control">Galería de imágenes</label>
                            @for ($i = 0, $j = 1; $i < 4; $i++)
                                <div class="col-md-2">
                                    <a href="{{ @$warehouse->images->$j->$i }}" target="_blank"><img src="{{ @$warehouse->images->$j->$i }}" weight="25px" width="25px"></a>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="file" name="images[{{ $j }}][{{ $i }}]">
                                </div>
                            @endfor
                        </div>
                        <div class="col-md-4" style="border-radius: 25px; border: 2px solid #810B29;">
                            <label class="form-control">Descripción de la bodega</label>
                            <textarea style="resize:none" class="form-control" name="description[2]" cols="30" rows="5">{{ @$warehouse->description[2] }}</textarea><br>
                            <label class="form-control">Galería de imágenes</label>
                            @for ($i = 0, $j = 2; $i < 4; $i++)
                                <div class="col-md-2">
                                    <a href="{{ @$warehouse->images->$j->$i }}" target="_blank"><img src="{{ @$warehouse->images->$j->$i }}" weight="25px" width="25px"></a>
                                </div>
                                <div class="col-md-10">
                                    <input class="form-control" type="file" name="images[{{ $j }}][{{ $i }}]">
                                </div>
                            @endfor
                        </div>
                        <div class="col-md-2">
                        <br>
                            <label class="form-control">Estado</label>
                        </div>
                        <div class="col-md-10">
                        <br>
                            <select class="form-control" name="flag_active">
                            @if( (int)$warehouse->flag_active === 1 )
                                <option selected="selected" value="1">ACTIVA</option>
                                <option value="2">INACTIVA</option>
                            @else
                                <option value="1">ACTIVA</option>
                                <option selected="selected" value="2">INACTIVA</option>
                            @endif
                            </select><br>
                        </div>
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="{{ $warehouse->id }}"/><br>
                            <button type="submit" class="form-control">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
