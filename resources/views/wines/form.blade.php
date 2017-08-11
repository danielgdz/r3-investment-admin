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
                        <label class="form-control">Nombre</label>
                        <input class="form-control" type="text" maxlength="200" name="name" value=""/><br>
                        
                        <label class="form-control">Bodega</label>
                        <select class="form-control" name="warehouses_id">
                            @foreach ($warehouses as $key => $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select><br>

                        <label class="form-control">Resumen</label>
                        <textarea class="form-control" name="short_description" cols="30" rows="5"></textarea><br>

                        <label class="form-control">Descripción completa</label>
                        <textarea class="form-control" name="description" cols="30" rows="5"></textarea><br>

                        <label class="form-control">Imagen principal</label>
                        <input class="form-control" type="file" name="url_image"><br>

                        <label class="form-control">Archivo PDF</label>
                        <input class="form-control" type="file" name="url_pdf"><br>

                        <label class="form-control">Ficha técnica</label>
                        <textarea class="form-control" name="tech_details" cols="30" rows="5"></textarea><br>

                        <label class="form-control">Estrellas</label>
                        <select class="form-control" name="stars">
                            <option value="1">1 estrella</option>
                            <option value="2">2 estrellas</option>
                            <option value="3">3 estrellas</option>
                            <option value="4">4 estrellas</option>
                            <option value="5">5 estrellas</option>
                        </select><br>

                        <label class="form-control">Estado</label>
                        <select class="form-control" name="flag_active">
                            <option value="1">ACTIVA</option>
                            <option value="0">INACTIVA</option>
                        </select><br>

                        <button type="submit" class="form-control">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
