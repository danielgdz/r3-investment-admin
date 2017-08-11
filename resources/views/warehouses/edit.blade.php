@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Actualizar bodega {{ str_pad($warehouse->id, 6, "0" ,STR_PAD_LEFT) }}
                </div>
                <div class="panel-body">
                    <form class="form" name="warehouse-store" method="POST" action="{{ route('warehouse-store') }}"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}                    
                        <input type="hidden" name="id" value="{{ $warehouse->id }}"/><br>
                        <label class="form-control">Nombre</label>
                        <input class="form-control" type="text" maxlength="200" name="name" value="{{ $warehouse->name }}"/><br>
                        
                        <label class="form-control">Descripción</label>
                        <textarea class="form-control" name="description" cols="30" rows="5">{{ $warehouse->description }}</textarea><br>
                        
                        @if (!is_null($warehouse->url_image))
                            <img src="{{ $warehouse->url_image }}" height="100px">
                        @endif
                        
                        <label class="form-control">Imagen principal</label>
                        <input class="form-control" type="file" name="url_image"><br>

                        <label class="form-control">Estado</label>
                        <select class="form-control" name="flag_active">
                            @if( (int)$warehouse->flag_active === 1 )
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
