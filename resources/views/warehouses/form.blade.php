@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Crear nueva bodega</div>
                <div class="panel-body">
                    <form class="form" name="warehouse-store" method="POST" action="{{ route('warehouse-store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-2">
                            <label class="form-control">Nombre</label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="text" maxlength="200" name="name" value=""/><br>
                        </div>
                        <div class="col-md-2">
                            <label class="form-control">Código</label>
                        </div>
                        <div class="col-md-10">
                            <input class="form-control" type="text" maxlength="5" name="code" value=""/><br>
                        </div>
                        <div class="col-md-4" style="border-radius: 25px; border: 2px solid #810B29;">
                            <label class="form-control">Descripción de la zona</label>
                            <textarea style="resize:none" class="form-control" name="description[0]" cols="30" rows="5"></textarea><br>
                            <label class="form-control">Galería de imágenes</label>
                            <input class="form-control" type="file" name="images[0][0]">
                            <input class="form-control" type="file" name="images[0][1]">
                            <input class="form-control" type="file" name="images[0][2]">
                            <input class="form-control" type="file" name="images[0][3]">
                        </div>
                        <div class="col-md-4" style="border-radius: 25px; border: 2px solid #810B29;">
                            <label class="form-control">Descripción de la viña</label>
                            <textarea style="resize:none" class="form-control" name="description[1]" cols="30" rows="5"></textarea><br>
                            <label class="form-control">Galería de imágenes</label>
                            <input class="form-control" type="file" name="images[1][0]">
                            <input class="form-control" type="file" name="images[1][1]">
                            <input class="form-control" type="file" name="images[1][2]">
                            <input class="form-control" type="file" name="images[1][3]">
                        </div>
                        <div class="col-md-4" style="border-radius: 25px; border: 2px solid #810B29;">
                            <label class="form-control">Descripción de la bodega</label>
                            <textarea style="resize:none" class="form-control" name="description[2]" cols="30" rows="5"></textarea><br>
                            <label class="form-control">Galería de imágenes</label>
                            <input class="form-control" type="file" name="images[2][0]">
                            <input class="form-control" type="file" name="images[2][1]">
                            <input class="form-control" type="file" name="images[2][2]">
                            <input class="form-control" type="file" name="images[2][3]">
                        </div>
                        <div class="col-md-2">
                        <br>
                            <label class="form-control">Estado</label>
                        </div>
                        <div class="col-md-10">
                        <br>
                            <select class="form-control" name="flag_active">
                                <option value="1">ACTIVA</option>
                                <option value="0">INACTIVA</option>
                            </select><br>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="form-control">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
