@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ml-auto mr-auto">
                <div class="card" style="border-radius: 300px">
                    <div class="card-body text-center border-primary"  style="border-radius: 300px">
                        <h3 class="card-text mb-1 text text-uppercase">Please Try to Track Wallet Address!</h3>
                        <button class="btn btn-dark btn-round" onclick="showForm()">
                            <i class="tim-icons icon-zoom-split"> </i> Discover Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="info-icon text-center bg-gradient-primary">
                                <i class="tim-icons icon-chat-33"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">PENDING SHARES</p>
                                <h3 class="card-title" id="pendingShares">0.0 K</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-primary" style="height: 6px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="info-icon text-center bg-gradient-success">
                                <i class="tim-icons icon-chat-33"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">PENDING BALANCE</p>
                                <h3 class="card-title" id="pendingBalance">0.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-success" style="height: 6px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="info-icon text-center bg-gradient-danger">
                                <i class="tim-icons icon-chat-33"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">PAID BALANCE TODAY</p>
                                <h3 class="card-title" id="todayPaid">0.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-danger" style="height: 6px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="info-icon text-center bg-gradient-info">
                                <i class="tim-icons icon-chat-33"></i>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="numbers">
                                <p class="card-category">LIFETIME BALANCE</p>
                                <h3 class="card-title" id="totalPaid">0.00</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-info" style="height: 6px;"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category">Miner's Hash Rate</h5>
                    <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i><span id="hash_rate"></span></h3>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="memberHashRate"></canvas>
                    </div>
                </div>
                <div class="card-footer bg-primary p-0 m-0" style="height: 6px;">
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h6 class="title d-inline" id="workers">Workers (<span id="worker_number"></span>)</h6>
                    <p class="card-category d-inline">List of miners working for you</p>

                </div>
                <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <tbody>
                            <tr id="tr_content">

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-blue p-0 m-0" style="height: 6px;">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/js/plugins/sweetalert2.min.js') }}"></script>
    <script>
        const showForm = function() {
            Swal.fire({
                title: 'Please enter your coin wallet address.',
                @if(count(session(session('id'))->topMiners)==0)
                    html: `<input id='value' autocapitalize="off" placeholder="Please enter miner" class="swal2-input" value="" type="text" style="display: flex;">`,
                @else
                    html: `<input id='value' autocapitalize="off" class="swal2-input" value="{{ session(session('id'))->topMiners[0]->miner }}" type="text" style="display: flex;">`,
                @endif
                showCancelButton: true,
                confirmButtonText: 'Look up',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-default'
                },
                buttonsStyling: false,
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    wallet = document.querySelector('#value').value;
                    return fetch(`//luckyblocks.ninja:4000/api/pools/dgb1/miners/${wallet}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `Request failed: ${error}`
                            )
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value.pendingShares) {
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Correct!',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    $('#pendingShares').text(stats.formatter(result.value.pendingShares, 2, ''));
                    $('#pendingBalance').text(stats.formatter(result.value.pendingBalance, 2, ''));
                    $('#totalPaid').text(stats.formatter(result.value.totalPaid, 2, ''));
                    $('#todayPaid').text(stats.formatter(result.value.todayPaid, 2, ''));



                    // $('#dickHashrate').text(stats.formatter(result.value.performance.workers.Dick.hashrate, 2, ''));
                    // $('#dickShareRate').text(result.value.performance.workers.Dick.sharesPerSecond);
                    // $('#janeHashrate').text(stats.formatter(result.value.performance.workers.Jane.hashrate, 2, ''));
                    // $('#janeShareRate').text(result.value.performance.workers.Jane.sharesPerSecond);
                    // $('#hash_rate').text(result.value.performance.workers.Jane.hashrate + result.value.performance.workers.Jane.hashrate);
                    var table = '<td style="padding-right: 20px; width: 100px">\n' +
                        '<p class="title text-right" style="width: 100px;">Name</p>\n' +
                        '<p class="text-muted text-right" style="width: 100px;">Hashrate</p>\n' +
                        '<p class="text-muted text-right" style="width: 100px;">Share Rate</p>\n' +
                        '</td>';
                    var hashrate = 0;
                    var i =0;
                    $.each(result.value.performanceSamples[result.value.performanceSamples.length-1].workers, function (index, value) {
                        table = table + '<td>' +
                            '<p class="title">'+ index +'</p>' +
                            '<p class="text-muted">'+ stats.formatter(value.hashrate, 2, '') +'</p>' +
                            '<p class="text-muted">'+ value.sharesPerSecond +'</p>' +
                            '</td>';
                        i++;
                        hashrate = hashrate + value.hashrate;
                    });
                    $('#worker_number').text(i);
                    $('#tr_content').html(table);
                    $('#hash_rate').html(stats.formatter(hashrate, 2, '') + 'H/s');


                    labels = [];
                    memberHashRate = [];
                    memberHashRate_unit = '';
                    $.each(result.value.performanceSamples, function(index, value){
                        var createDate = stats.convertLocalDateToUTCDate(new Date(value.created), false);
                        labels.push(createDate.getHours() + ":00");
                        // spliter = stats.formatter((value.workers.Jane.hashrate+value.workers.Dick.hashrate), 2, '').split(' ');
                        var number = 0.00;
                        $.each(value.workers, function (index, value) {
                            number = number + value.hashrate;
                        });
                        memberHashRate.push(number/1000000000);
                    });
                    memberHashRate_unit = 'G';
                    id = 'memberHashRate';
                    chart_title = 'Member\'s Hash Rate';
                    stats.initChart(id, labels, memberHashRate, memberHashRate_unit, chart_title);

                } else {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success btn-round',
                            cancelButton: 'btn btn-danger btn-round'
                        },
                        buttonsStyling: false
                    });

                    swalWithBootstrapButtons.fire({
                        title: 'Wrong Code',
                        text: "Could you check again?",
                        type: 'warning',
                        showCancelButton: true,
                        cancelButtonText: 'No, cancel!',
                        confirmButtonText: 'Try Again',
                    }).then(function (isConfirm) {
                        if (isConfirm.value){
                            showForm();
                        }
                    })

                }
            })
        }
        $(document).ready(function() {
            showForm();
        });
    </script>
@endsection