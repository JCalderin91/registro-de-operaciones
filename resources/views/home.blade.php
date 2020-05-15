@extends('layouts.app')

@section('csspage')
    <style>
        .chart{
            height: 400px;
            color: #c510109d
        }
    </style>
@endsection

@section('content')

<div class="card">
    <div class="chart">
        <canvas id="barChart"></canvas>
    </div>
</div>

@endsection


@section('scriptpage')
    <script>
        var ctx = document.getElementById("barChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [{{$operationsDebt}},{{$operationsPay}},],
                    backgroundColor: ['#1753fc', ' #00b3ff'],
                    hoverBackgroundColor: ['#1753fc', ' #00b3ff'],
                    borderColor:'transparent',
                }],
                labels: ["Deudas", "Pagos"]
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
