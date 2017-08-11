@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear nuevo producto
                </div>
                <div class="panel-body">
                    <form class="form" name="wine-store" method="POST" action="{{ route('wine-store') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}                    
                        <input type="hidden" name="id" value="{{ $wine->id }}"/><br>
                        <label class="form-control">Nombre</label>
                        <input class="form-control" type="text" maxlength="200" name="name" value="{{ $wine->name }}"/><br>
                        
                        <label class="form-control">Bodega</label>
                        <select class="form-control" name="warehouses_id">
                            @foreach ($warehouses as $key => $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select><br>

                        <label class="form-control">Resumen</label>
                        <textarea class="form-control" name="short_description" cols="30" rows="5">{{ $wine->short_description }}</textarea><br>

                        <label class="form-control">Descripción completa</label>
                        <textarea class="form-control" name="description" cols="30" rows="5">{{ $wine->description }}</textarea><br>

                        @if (!is_null($wine->url_image))
                            <img src="{{ $wine->url_image }}" height="100px">
                        @endif

                        <label class="form-control">Imagen principal</label>
                        <input class="form-control" type="file" name="url_image"><br>

                        @if (!is_null($wine->url_pdf))
                            <a href="{{ $wine->url_pdf }}">Descargar PDF</a>
                        @endif

                        <label class="form-control">Archivo PDF</label>
                        <input class="form-control" type="file" name="url_pdf"><br>

                        <label class="form-control">Ficha técnica</label>
                        <textarea class="form-control" name="tech_details" cols="30" rows="5">{{ $wine->tech_details }}</textarea><br>

                        <label class="form-control">Estrellas</label>
                        <select class="form-control" name="stars">
                            @if ( (int)$wine->stars === 1 )
                                <option selected="selected" value="1">1 estrella</option>
                                <option value="2">2 estrellas</option>
                                <option value="3">3 estrellas</option>
                                <option value="4">4 estrellas</option>
                                <option value="5">5 estrellas</option>
                            @elseif ( (int)$wine->stars === 2 )
                                <option value="1">1 estrella</option>
                                <option selected="selected" value="2">2 estrellas</option>
                                <option value="3">3 estrellas</option>
                                <option value="4">4 estrellas</option>
                                <option value="5">5 estrellas</option>
                            @elseif ( (int)$wine->stars === 3 )
                                <option value="1">1 estrella</option>
                                <option value="2">2 estrellas</option>
                                <option selected="selected" value="3">3 estrellas</option>
                                <option value="4">4 estrellas</option>
                                <option value="5">5 estrellas</option>
                            @elseif ( (int)$wine->stars === 4 )
                                <option value="1">1 estrella</option>
                                <option value="2">2 estrellas</option>
                                <option value="3">3 estrellas</option>
                                <option selected="selected" value="4">4 estrellas</option>
                                <option value="5">5 estrellas</option>
                            @else
                                <option value="1">1 estrella</option>
                                <option value="2">2 estrellas</option>
                                <option value="3">3 estrellas</option>
                                <option value="4">4 estrellas</option>
                                <option selected="selected" value="5">5 estrellas</option>
                            @endif
                        </select><br>

                        <label class="form-control">Estado</label>
                        <select class="form-control" name="flag_active">
                            @if( (int)$wine->flag_active === 1 )
                                <option selected="selected" value="1">ACTIVA</option>
                                <option value="2">INACTIVA</option>
                            @else
                                <option value="1">ACTIVA</option>
                                <option selected="selected" value="2">INACTIVA</option>
                            @endif
                        </select><br>

                        <button type="submit" class="form-control">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
