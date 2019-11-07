@extends('index')

@section('content')
<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-1">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton1" data-toggle="dropdown">
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="javascript:void(0)" onclick="showChart(0,1)">Chart</a>
                        <a class="dropdown-item" href="{{ route('user.index') }}">Detail</a>
                    </div>
                </div>
            </div>
            <h4 class="mb-0">
                <span class="count">10468</span>
            </h4>
            <p class="text-light">Users</p>

            <div class="chart-wrapper px-0" style="height:70px;" height="70">
                <canvas id="chart"></canvas>
            </div>

        </div>

    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-2">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                    <div class="dropdown-menu-content">
                       <a class="dropdown-item" href="javascript:void(0)"  onclick="showChart(1,1)">Chart</a>
                       <a class="dropdown-item" href="{{ route('story.index') }}">Detail</a>
                   </div>
               </div>
           </div>
           <h4 class="mb-0">
            <span class="count">10468</span>
        </h4>
        <p class="text-light">Stories</p>

        <div class="chart-wrapper px-0" style="height:70px;" height="70">
            <canvas id="widgetChart2"></canvas>
        </div>

    </div>
</div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-3">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton3" data-toggle="dropdown">
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="javascript:void(0)" onclick="showChart(2,1)">Chart</a>
                    </div>
                </div>
            </div>
            <h4 class="mb-0">
                <span class="count">10468</span>
            </h4>
            <p class="text-light">Videos of user</p>

        </div>

        <div class="chart-wrapper px-0" style="height:70px;" height="70">
            <canvas id="widgetChart3"></canvas>
        </div>
    </div>
</div>
<!--/.col-->

<div class="col-sm-6 col-lg-3">
    <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
            <div class="dropdown float-right">
                <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton4" data-toggle="dropdown">
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                    <div class="dropdown-menu-content">
                        <a class="dropdown-item" href="javascript:void(0)" onclick="showChart(3,1)">Chart</a>
                    </div>
                </div>
            </div>
            <h4 class="mb-0">
                <span class="count">10468</span>
            </h4>
            <p class="text-light">Views</p>

            <div class="chart-wrapper px-3" style="height:70px;" height="70">
                <canvas id="widgetChart4"></canvas>
            </div>

        </div>
    </div>
</div>

<div class="col-xl-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="card-title mb-0">Chart</h4>
                </div>
                <!--/.col-->
                <div class="col-sm-8 hidden-sm-down">
                    <div class="btn-toolbar float-right" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-3" data-toggle="buttons" aria-label="First group">
                            <label class="btn btn-outline-secondary changeDT">
                                <input type="radio" name="options" id="option1" value="0"> Day
                            </label>
                            <label class="btn btn-outline-secondary changeDT active">
                                <input type="radio" name="options" id="option2" value= "1" checked="checked" > Month
                            </label>
                            <label class="btn btn-outline-secondary changeDT">
                                <input type="radio" name="options" id="option3" value="2"> Year
                            </label>
                        </div>
                    </div>
                </div>
                <!--/.col-->


            </div>
            <!--/.row-->
            <div class="chart-wrapper">
                <canvas id="myChart"></canvas>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        function showChart(id, type){
            response(id, type);

            $(".changeDT").click(function() {
                type= $(this)[0].childNodes[1].value;
                response(id, type);
            });


        }
        function response(id, type){
         $.ajax( {
            method:'GET',
            url: "/admin/chart/"+id+"/"+type,
            data:{
                id: id,
                type: type,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json'
        })
         .done(function(result) {
            console.log('ok');

            let massPopChart = new Chart($('#myChart'), {
                type: result.usersChart.datasets[0].type,
                data:{
                    labels:result.usersChart.labels,
                    datasets:[{
                      label:result.usersChart.datasets[0].name,
                      data:result.usersChart.datasets[0].values
                  }]
              },
          });
        })
         .fail(function() {
            alert('error');
        });
     }
 </script>

 @endsection