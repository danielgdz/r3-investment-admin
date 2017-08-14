@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Crear nuevo producto
                </div>
                <div class="panel-body">
                    <form class="form" name="wine-store" method="POST" action="{{ route('wine-store') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="form-control">Nombre</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" maxlength="200" name="name" value=""/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="form-control">Bodega</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="warehouses_id">
                                        @foreach ($warehouses as $key => $warehouse)
                                            <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="form-control">Resumen</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea style="resize:none" class="form-control" name="short_description" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="form-control">Descripción completa</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea style="resize:none" class="form-control" name="description" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="form-control">Imagen principal</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="file" name="url_image">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="form-control">Archivo PDF</label>
                                </div>
                                <div class="col-md-8">
                                    <input class="form-control" type="file" name="url_pdf">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-12">
                                    <label class="form-control">Ficha técnica</label>
                                </div>
                                <div class="col-md-12">
                                    <textarea style="resize:none" class="form-control" name="tech_details" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="form-control">Estrellas</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="stars">
                                        <option value="1">1 estrella</option>
                                        <option value="2">2 estrellas</option>
                                        <option value="3">3 estrellas</option>
                                        <option value="4">4 estrellas</option>
                                        <option value="5">5 estrellas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <label class="form-control">Estado</label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="flag_active">
                                        <option value="1">ACTIVA</option>
                                        <option value="0">INACTIVA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="form-control">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
