@extends('layouts.app')

@section('content')
<section class="card mt-3">
<div class="card-header">{{Route::currentRouteName() == 'operations.create' ? 'Crear' : 'Editar'}} una operación</div>

  <div class="card-body">
    @if (Route::currentRouteName() == 'operations.create')
    <form action="{{route('operations.store')}}" method="post">
    @else
    <form action="{{route('operations.update', $operation->id)}}" method="post">
      @method('put')
    @endif
      @csrf
      <div class="row">
        <div class="form-group col-md-4">
          <label>{!! trans('text.input_one') !!}</label>
          <input type="date" class="form-control" value="{{old('date', @$operation->date)}}" name="date">
        </div>
        <div class="form-group col-md-4">
          <label>{!! trans('text.input_tree') !!}</label>
          <input type="number" class="form-control @error('mount') is-invalid @enderror" value="{{old('mount', @$operation->mount)}}" step="any" name="mount" placeholder="{!! trans('text.placeholder_tree') !!}">
          @error('mount')
            <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group col-md-4">
          <label>{!! trans('text.input_four') !!}</label>
          <select name="type" class="form-control @error('type') is-invalid @enderror">
            <option {{@$operation->type === 0 ? 'selected' : ''}} value="0">Deuda</option>
            <option {{@$operation->type === 1 ? 'selected' : ''}} value="1">Pago</option>
          </select>
          @error('type')
            <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group col-md-12">
          <label>{!! trans('text.input_two') !!}</label>
          <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="{!! trans('text.placeholder_two') !!}" rows="4">{{old('description', @$operation->description)}}</textarea>
          @error('description')
            <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="col-sm-12 text-right">
          <hr>
          <a href="{{route('operations.index')}}" class="btn btn-sm">Cancelar</a>
          <button type="submit" class="btn btn-sm btn-success">{!! trans('text.save') !!}</button>
        </div>
      </div>
    </form>
  </div>
</section>
@endsection
