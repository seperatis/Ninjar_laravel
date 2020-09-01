@extends('layouts.admin')

@section('content')
    <?php
    function thousandsCurrencyFormat($num) {

        if($num>1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('K', 'M', 'G', 'T','P');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 && $x_array[1][0] !== 0 ? '.' . $x_array[1][0].$x_array[1][1] : '');
            $x_display .= $x_parts[$x_count_parts - 1];
            return $x_display;
        }

        return $num;
    }
    ?>
    <input type="hidden" id="miners" value="{{json_encode($miners)}}">
    <div class="row">
        <div class="col-md-12 mb-5">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Miners</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="simple-table">
                            <thead class=" text-primary">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Address</th>
                                <th>Hashrate</th>
                                <th>Share Rate</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($miners as $miner)
                                <tr>
                                    <td class="text-center">0</td>
                                    <td>
                                        {{ substr($miner->miner, 0, 10) }} ... ... {{ substr($miner->miner, -10) }}
                                    </td>
                                    <td>
                                        {{ thousandsCurrencyFormat($miner->hashrate) }}H/s
                                    </td>
                                    <td>
                                        {{ $miner->sharesPerSecond }}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ml-auto">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category"></h5>
                    <h3 class="card-title text-info"><i class="tim-icons icon-shape-star"></i> Hashrate
                    </h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="hashrate"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 ml-auto">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category"></h5>
                    <h3 class="card-title text-primary"><i class="tim-icons icon-shape-star"></i> Shares Per Second
                    </h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="sharesPerSecond"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            miners.loadMinerChart();
        });
    </script>
@endsection