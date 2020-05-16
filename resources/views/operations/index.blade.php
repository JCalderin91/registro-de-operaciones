@extends('layouts.app')

@section('content')
<section class="card mt-3">
  <div class="card-header">{!! trans('text.title_one') !!}</div>

  <div class="card-body p-1">
    <form action="{{route('operations.store')}}" method="post">
      @csrf
      <div class="row">
        <div class="form-group col-md-2">
          <label>{!! trans('text.input_one') !!}</label>
          <input type="date" class="form-control" value="{{old('date')}}" name="date">
        </div>
        <div class="form-group col-md-5">
          <label>{!! trans('text.input_two') !!}</label>
          <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}" name="description" placeholder="{!! trans('text.placeholder_two') !!}">
          @error('description')
            <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group col-md-2">
          <label>{!! trans('text.input_tree') !!}</label>
          <input type="number" class="form-control @error('mount') is-invalid @enderror" value="{{old('mount')}}" step="any" name="mount" placeholder="{!! trans('text.placeholder_tree') !!}">
          @error('mount')
            <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group col-md-3">
          <label>{!! trans('text.input_four') !!}</label>
          <select name="type" class="form-control @error('type') is-invalid @enderror">
            <option value="0">Deuda</option>
            <option value="1">Pago</option>
          </select>
          @error('type')
            <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="col-sm-12 text-right">
          <button type="submit" class="btn btn-info">{!! trans('text.save') !!}</button>
        </div>
      </div>
    </form>
  </div>
</section>
@if ($daysLastPay>0)
<br>
<div class="card p-1">
<p class="mb-0 text-center"> {!! trans('text.lastPayText_one') !!} <b>"{{$lastPay->description}}"</b> {!! trans('text.lastPayText_two') !!} <b>{{$lastPay->mount}}</b> $ {!! trans('text.lastPayText_tree') !!} <b>{{$daysLastPay}}</b> {!! trans('text.lastPayText_four') !!}</p>
</div>
@endif
<br>
<div class="card">
  <div class="card-header">{!! trans('text.title_two') !!}</div>
  <div class="card-body p-1">
    <div class="table-responsive">
      <table id="operations" class="table table-sm text-center">
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
          <tr>
              <td>{{$key+1}}</td>
              <td><div class="badge badge-{{$item->type === 0 ? 'danger' : 'success'}}">{{$item->type === 0 ? trans('text.value_two') : trans('text.value_one') }}</div></td>
              <td>{{$item->description}}</td>
              <td>{{$item->mount}} $</td>
              <td>{{\Carbon\Carbon::parse($item->date)->format('d-m-y')}}</td>
            <td>
              @if ($item->status === 1)
              <form action="{{route('operations.destroy', $item->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-warning btn-sm" type="submit">{!! trans('text.operation_one') !!}</button>
              </form>
              @else
              {!! trans('text.operation_two') !!}
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<br>

<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">{!! trans('text.title_tree') !!}</div>
      <div class="card-body p-1">
        <canvas id="barChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
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

@section('scriptpage')
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
    labels: ["{!! trans('text.table_six') !!}", "{!! trans('text.table_seven') !!}"]
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
