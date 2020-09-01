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
    <input type="hidden" id="data" value="{{ json_encode($stats) }}">
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 text-left">
                            <h5 class="card-category">Pool Hashrate</h5>
                            <h3 class="card-title">
                                <i class="tim-icons icon-sound-wave text-primary"></i>
                                {{thousandsCurrencyFormat($stats[count($stats)-1]->poolHashrate)}}
                                <span class="text-primary" style="font-size: 14px; font-weight: 500">(H/s)</span>
                            </h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="pool_hashrate_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 text-left">
                            <h5 class="card-category">Miners (Workers)</h5>
                            <h3 class="card-title">
                                <i class="tim-icons icon-settings text-primary"></i>
                                {{thousandsCurrencyFormat($stats[count($stats)-1]->connectedMiners)}}
                                <span class="text-primary" style="font-size: 14px; font-weight: 500">(miners)</span>
                            </h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="miner_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="info-icon text-center bg-gradient-green">
                                <i class="tim-icons icon-chart-bar-32"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Block Chain height</p>
                                <h3 class="card-title">{{number_format (session(session('id'))->networkStats->blockHeight, 0)}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-gradient-green" style="height: 6px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="info-icon text-center bg-gradient-blue">
                                <i class="tim-icons icon-delivery-fast"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Connected Peers</p>
                                <h3 class="card-title">{{session(session('id'))->networkStats->connectedPeers}}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-gradient-blue" style="height: 6px;">

                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="info-icon text-center bg-primary">
                                <i class="tim-icons icon-trophy"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Payment Threshold</p>
                                <h3 class="card-title">{{session(session('id'))->paymentProcessing->minimumPayment}} DGB
                                    <span class="text-primary" style="font-weight: 500; font-size: 14px">{{session(session('id'))->paymentProcessing->payoutScheme}}</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary" style="height: 6px"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="info-icon text-center icon-danger">
                                <i class="tim-icons icon-credit-card"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">Pool Fee</p>
                                <h3 class="card-title">{{session(session('id'))->poolFeePercent}}<span>%</span></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-danger" style="height: 6px;"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category"> Network Hashrate</h5>
                    <h3 class="card-title">
                        <i class="tim-icons icon-user-run text-primary"></i>
                        {{thousandsCurrencyFormat($stats[count($stats)-1]->networkHashrate)}}
                        <span class="text-primary" style="font-size: 14px; font-weight: 500">(H/s)</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="network_hashrate_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category"> Network Difficulty</h5>
                    <h3 class="card-title">
                        <i class="tim-icons icon-delivery-fast text-info"></i>
                        {{thousandsCurrencyFormat($stats[count($stats)-1]->networkDifficulty)}}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="network_difficulty_chart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
    <script>
        $(document).ready(function() {
            stats.initDashboardPageCharts();
        });
    </script>
@endsection