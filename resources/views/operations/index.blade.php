@extends('layouts.app')

@section('content')
<section class="card mt-3">
  <div class="card-header">Nuevo registro</div>

  <div class="card-body p-1">
    <form action="{{route('operations.store')}}" method="post">
      @csrf
      <div class="row">
        <div class="form-group col-md-2">
          <label>Fecha</label>
          <input type="date" class="form-control" value="{{old('date')}}" name="date" placeholder="Fecha">
        </div>
        <div class="form-group col-md-5">
          <label>Descripción</label>
          <input type="text" class="form-control @error('description') is-invalid @enderror" value="{{old('description')}}" name="description" placeholder="Descripción">
          @error('description')
            <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group col-md-2">
          <label>Monto</label>
          <input type="number" class="form-control @error('mount') is-invalid @enderror" value="{{old('mount')}}" step="any" name="mount" placeholder="Monto">
          @error('mount')
            <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="form-group col-md-3">
          <label>Tipo</label>
          <select name="type" class="form-control @error('type') is-invalid @enderror">
            <option value="0">Deuda</option>
            <option value="1">Pago</option>
          </select>
          @error('type')
            <small class="text-danger">{{$message}}</small>
          @enderror
        </div>
        <div class="col-sm-12 text-right">
          <button type="submit" class="btn btn-info">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</section>

<br>
<div class="card">
  <div class="card-header">Lista de registros</div>
  <div class="card-body p-1">
    <div class="table-responsive">
      <table id="operations" class="table table-sm text-center">
        <thead class="bg-info text-white">
          <tr>
              <td>#</td>
              <td>Tipo</td>
              <td>Descripción</td>
              <td>Monto</td>
              <td>Fecha</td>
            <td>Operación</td>
          </tr>
        </thead>
        <tbody>
          @foreach ($operations as $key => $item)
          <tr>
              <td>{{$key+1}}</td>
              <td><div class="badge badge-{{$item->type === 0 ? 'danger' : 'success'}}">{{$item->type === 0 ? 'Deuda' : 'Pago'}}</div></td>
              <td>{{$item->description}}</td>
              <td>{{$item->mount}} $</td>
              <td>{{\Carbon\Carbon::parse($item->date)->format('d-m-y')}}</td>
            <td>
              @if ($item->status === 1)
              <form action="{{route('operations.destroy', $item->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-warning btn-sm" type="submit">Anular</button>
              </form>
              @else
              Anulado
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
      <div class="card-header">Gráfica</div>
      <div class="card-body p-1">
        <canvas id="barChart"></canvas>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
        <div class="card-header">Resumen</div>
            <div class="card-body p-1">
                <div class="table-responsive">
                <table class="table table-sm text-center">
                    <thead class="bg-info text-white">
                    <tr>
                        <td>Deuda</td>
                        <td>Pagado</td>
                        <td>Saldo</td>
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
    $('#operations').DataTable({
	        language: {
	            url: "{{asset('assets/js/spanish.json')}}"
	        }
	    });
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
    labels: ["Pagos", "Deudas"]
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
