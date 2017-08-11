@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Crear nueva bodega
                </div>
                <div class="panel-body">
                    <form class="form" name="warehouse-store" method="POST" action="{{ route('warehouse-store') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}                    
                        <label class="form-control">Nombre</label>
                        <input class="form-control" type="text" maxlength="200" name="name" value=""/><br>
                        
                        <label class="form-control">Descripción</label>
                        <textarea class="form-control" name="description" cols="30" rows="5"></textarea><br>

                        <label class="form-control">Imagen principal</label>
                        <input class="form-control" type="file" name="url_image"><br>

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
