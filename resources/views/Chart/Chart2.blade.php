@extends('layouts.app')

@section('content')


<div class="box">

    <div class="box-header with-border">
        <a href="{{url('chart')}}" class="btn btn-danger my-2 ">Kembali</a>
        <div class="box-tools pull-right">
        </div>
    </div>

    <div class="box-body">

		<div class="row">
            @foreach ($soal as $key => $item)
            @if(count($item->pilihan) > 4)
            <div class="col-md-12" align="center">
                <br>
                <div id="lebar" style="width: 600px">
		        <b>{{$item->soal}}</b>
		        <canvas id="chart{{$key}}" class="chart"></canvas>
		        <progress id="animationProgress{{$key}}" max="1" value="0" style="width: 100%; height: 5px"> </progress>
                </div>
            </div>
            @else
		    <div class="col-md-6">
				<br>
		        <b>{{$item->soal}}</b>
		        <canvas id="chart{{$key}}" class="chart" width="400" height="300"></canvas>
		        <progress id="animationProgress{{$key}}" max="1" value="0" style="width: 100%; height: 5px"> </progress>

            </div>
            @endif
		    @endforeach
		</div>
		
		
    </div>

</div>

@endsection

@section('javascript')
	<script> 
	
		var chartCount = document.getElementsByClassName('chart');
		Chart.defaults.global.defaultFontSize = 10;
        var kategori = {{$kategori}};
        var periode = "{{$periode}}";
        var tahun = "{{$tahun}}";

		for (let index = 0; index < chartCount.length; index++) {
			
			$.ajax({
				url: '{{url('chart-data')}}' + '/' +kategori+ '?periode='+periode+'&tahun='+tahun,
				method: "GET",
				success: function(data){
					console.log(data['soal'][index].nilai);
					var pilihanValue = data['soal'][index].pilihan;
					var nilaiValue = data['soal'][index].nilai;

					console.log(nilaiValue);
					var chartData = {
                        labels: pilihanValue,
                        datasets: [{
                            label: 'Pilihan',
                            data: nilaiValue,
                            backgroundColor: 
                                [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 206, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(255, 159, 64, 0.5)'
                                ],
                            borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                            borderWidth: 1,
                            
                        }],
                    };
                    
                    
                    var barGraph = new Chart(document.getElementById("chart"+index).getContext('2d'), {
                                    type: 'bar',
                                    data: chartData,
                                    options: {
                                                scales: {
                                                    yAxes: [{
                                                        ticks: {
                                                            beginAtZero: true
                                                        }
                                                    }]
                                                },
                                                animation: {
                                                    onProgress: function(animation) {
                                                        document.getElementById("animationProgress"+index).value = animation.currentStep / animation.numSteps;
                                                        },
                                                    onComplete: function() {
                                                        window.setTimeout(function() {
                                                            document.getElementById("animationProgress"+index).value = 0;
                                                            }, 2000);
                                                        }
                                                },

                                            }
                                    });
				}
			});
			
		}
	

	</script>
@endsection