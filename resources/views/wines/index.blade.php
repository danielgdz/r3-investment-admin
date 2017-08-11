@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="panel panel-default">
                <div class="panel-heading">Listado de productos
                    <a href="{{ route('wine-create') }}" class="btn">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                </div>
                <div class="col-xms-12 panel-body">
                    <table class="table">
                        <thead>
                            <th>Código</th>
                            <th>(<span class="glyphicon glyphicon-star" aria-hidden="true"></span>) Nombre</th>
                            <th>Bodega</th>
                            <th>Registro</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </thead>
                        <tbody>
                            @foreach($list as $key => $object)
                            <tr>
                                <td> {{ str_pad($object->id, 6, "0" ,STR_PAD_LEFT) }} </td>
                                <td> {{ '(' . $object->stars . ') ' . $object->name }} </td>
                                <td> {{ $object->warehouse_name }} </td>
                                <td> {{ $object->created_at }} </td>
                                <td> {{ (($object->flag_active)? 'ACTIVA':'INACTIVA') }} </td>
                                <td> 
                                    <a href="{{ route('wine-edit', $object->id) }}" class="btn">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                    </a>
                                    <form name="wine-delete" action="{{ route('wine-delete', $object->id) }}" 
                                            method="post" style="display: inline">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <a onclick="$(this).closest('form').submit();" class="btn" style="color:red;">
                                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        </a>
                                    </form>
                                </td>
                            <tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
