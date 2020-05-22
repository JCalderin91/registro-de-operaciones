@extends('layouts.app')

@section('css')
    <style>
      tr.disabled td span{
        text-decoration: line-through;
        color: #555;
      }
    </style>
@endsection

@section('content')

@if ($daysLastPay>0)
<div class="card p-1 mb-1">
<p class="mb-0 text-center"><b>Notificación:</b> {!! trans('text.lastPayText_one') !!} <b>"{{$lastPay->description}}"</b> {!! trans('text.lastPayText_two') !!} <b>{{$lastPay->mount}}</b> $ {!! trans('text.lastPayText_tree') !!} <b>{{$daysLastPay}}</b> {!! trans('text.lastPayText_four') !!}</p>
</div>
@endif
<div class="card mb-1">
  <div class="card-header">
    {!! trans('text.title_two') !!}
    <a href="{{route('operations.create')}}" class="btn btn-sm btn-info float-right">Nuevo</a>
  </div>
  <div class="card-body p-1">
    <div class="table-responsive">
      <table id="operations" class="table table-sm text-center table-hover">
        <thead class="bg-info text-white">
          <tr>
            <td>#</td>
            <td>{!! trans('text.table_one') !!}</td>
            <td>{!! trans('text.table_two') !!}</td>
            <td>{!! trans('text.table_tree') !!}</td>
            <td>{!! trans('text.table_four') !!}</td>
            <td>{!! trans('text.table_five') !!}</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($operations as $key => $item)
          @php
          $class = $item->type === 0 ? 'danger' : 'success';
          $canceled = $item->status === 2;
          $class = $canceled ? 'secondary' : $class;
          @endphp
          <tr class="{{$canceled ? 'disabled' : ''}}">
              <td>{{$key+1}}</td>
              <td>
                <div class="badge badge-{{$class}}">
                  {{$item->type === 0 ? trans('text.value_two') : trans('text.value_one') }}
                </div>
              </td>
              <td><span>{{$item->description}}</span></td>
              <td><span>{{$item->mount}} $</span></td>
              <td><span>{{\Carbon\Carbon::parse($item->date)->format('d-m-y')}}</span></td>
            <td>
              @if ($item->status === 1)
              <form class="d-inline-block" action="{{route('operations.destroy', $item->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button title="Anular" class="btn btn-outline-warning btn-sm" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
              </form>
              @elseif($item->status === 2)
              <form class="d-inline-block" action="{{route('operations.destroy', $item->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button title="Eliminar" class="btn btn-outline-danger btn-sm" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
              </form>
              @endif
              <a href="{{route('operations.edit', $item->id)}}" title="Editar" class="btn btn-outline-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-6 pr-md-1">
    <div class="card mb-1">
      <div class="card-header">{!! trans('text.title_tree') !!}</div>
      <div class="card-body p-1">
        <canvas id="barChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6 pl-md-0">
    <div class="card">
        <div class="card-header">{!! trans('text.title_four') !!}</div>
            <div class="card-body p-1">
                <div class="table-responsive">
                  <table class="table table-sm text-center">
                      <thead class="bg-info text-white">
                      <tr>
                          <td>{!! trans('text.table_six') !!}</td>
                          <td>{!! trans('text.table_seven') !!}</td>
                          <td>{!! trans('text.table_eight') !!}</td>
                      </tr>
                      </thead>
                      <tbody>
                      <tr>
                          <td>{{$debe}} $</td>
                          <td>{{$haber}} $</td>
                          <td>{{$saldo}} $</td>
                      </tr>
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
  $(document).ready(function(){
    $('#operations').DataTable(
      @if(App::getLocale() == 'es')
      {
	        language: {
	            url: "{{asset('assets/js/spanish.json')}}"
	        }
      }
      @endif
      );
  })
var ctx = document.getElementById("barChart");
var myChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    datasets: [{
      data: [{{$haber}}, {{$debe - $haber}}, ],
      backgroundColor: ['#08c501aa', '#c51010aa'],
      hoverBackgroundColor: ['#08c501aa', '#c51010aa'],
      borderColor: 'transparent',
    }],
    labels: ["{!! trans('text.table_seven') !!}", "{!! trans('text.table_six') !!}"]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      labels: {
        fontColor: "#bbc1ca"
      },
    },
  }
});
</script>
@endsection
