@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pool Configuration</h4>
                        <p class="card-category">All you need to connect your miners</p>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="flag">
                                            @if(session(session('id'))->coin->type == 'LTC')
                                                <img src="{{ asset('assets/images/lightcoin.png') }}" width="30">
                                            @else
                                                <img src="{{ asset('assets/images/dgb1.png') }}" width="30">
                                            @endif
                                        </div>
                                    </td>
                                    <td>Crypto Coin name</td>
                                    <td class="text-right">
                                        {{ session(session('id'))->coin->name }} ({{ session(session('id'))->coin->type }})
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flag">
                                            @if(session(session('id'))->coin->type == 'LTC')
                                                <img src="{{ asset('assets/images/lightcoin.png') }}" width="30">
                                            @else
                                                <img src="{{ asset('assets/images/dgb1.png') }}" width="30">
                                            @endif
                                        </div>
                                    </td>
                                    <td>Coin Algorithm</td>
                                    <td class="text-right">
                                        {{ session(session('id'))->coin->algorithm }}

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flag">
                                            @if(session(session('id'))->coin->type == 'LTC')
                                                <img src="{{ asset('assets/images/lightcoin.png') }}" width="30">
                                            @else
                                                <img src="{{ asset('assets/images/dgb1.png') }}" width="30">
                                            @endif
                                        </div>
                                    </td>
                                    <td>Pool Wallet</td>
                                    <td class="text-right">
                                        <button class="btn btn-primary btn-round btn-fill" onclick="showInfoModal('{{ session(session('id'))->address }}')">View</button>
                                        <a class="btn btn-info btn-round btn-fill" href="{{ session(session('id'))->addressInfoLink }}" target="_blank">
                                            Goto</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flag">
                                            @if(session(session('id'))->coin->type == 'LTC')
                                                <img src="{{ asset('assets/images/lightcoin.png') }}" width="30">
                                            @else
                                                <img src="{{ asset('assets/images/dgb1.png') }}" width="30">
                                            @endif
                                        </div>
                                    </td>
                                    <td>Payout Scheme</td>
                                    <td class="text-right">
                                        {{ session(session('id'))->paymentProcessing->payoutScheme }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flag">
                                            @if(session(session('id'))->coin->type == 'LTC')
                                                <img src="{{ asset('assets/images/lightcoin.png') }}" width="30">
                                            @else
                                                <img src="{{ asset('assets/images/dgb1.png') }}" width="30">
                                            @endif
                                        </div>
                                    </td>
                                    <td>Minimum Payment</td>
                                    <td class="text-right">
                                        {{ session(session('id'))->paymentProcessing->minimumPayment }} DGB
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flag">
                                            @if(session(session('id'))->coin->type == 'LTC')
                                                <img src="{{ asset('assets/images/lightcoin.png') }}" width="30">
                                            @else
                                                <img src="{{ asset('assets/images/dgb1.png') }}" width="30">
                                            @endif
                                        </div>
                                    </td>
                                    <td>Pool Fee</td>
                                    <td class="text-right">
                                        {{ session(session('id'))->poolFeePercent }} %
                                    </td>
                                </tr>
                                @foreach( session(session('id'))->ports as $key => $value)
                                    <tr>
                                        <td>
                                            <div class="flag">
                                                @if(session(session('id'))->coin->type == 'LTC')
                                                    <img src="{{ asset('assets/images/lightcoin.png') }}" width="30">
                                                @else
                                                    <img src="{{ asset('assets/images/dgb1.png') }}" width="30">
                                                @endif
                                            </div>
                                        </td>
                                        <td>stratum+tcp://dgb.luckyblocks.ninja:{{ $key }}</td>
                                        <td class="text-right">
                                            Difficulty Variable / {{ $value->varDiff->minDiff }} ↔ {{ $value->varDiff->maxDiff ? $value->varDiff->maxDiff : '∞' }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="tim-icons icon-light-3"></i> Miner Configuration</h4>
                        <p class="card-category">
                            This is the basic guide how to setup your miner to this pool.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="typo-line">
                            <h2>Getting started</h2>
                            <hr>
                            <p>
                                To get started mining and use this pool you need the following
                            </p><ul>
                                <li>{{ session(session('id'))->coin->name }} Wallet address</li>
                                <li>crypto mining software that supports the Digibyte-Scrypt coin and aglorithm Scrypt</li>
                                <li>hardware to run it on. This can be you home PC, mining rig, ASIC miner or cloud mining</li>
                            </ul>
                            <br>
                            <h4>{{ session(session('id'))->coin->name }} Wallet address</h4>
                            A wallet address is needed to payout you shares mined at this pool server.<br>
                            When the total mined value is past the payout threshold, we will send your coin to this wallet address.<br>
                            <br>
                            <br>
                            <h4>crypto mining software</h4>
                            To mine at this pool you can use any miner supporting the Scrypt aglorithm or Digibyte-Scrypt coin.<br>
                            Use an search engine and search for "Digibyte-Scrypt miner software".
                            download the miner software and configure your crypto miner.<br>
                            <p></p>
                            <p>Where:</p>
                            <ul>
                                <li>POOL STRATUM ADDRESS AND PORT - one off the stratum addresses above in the Pool Configuration section depending on the difficuty you want</li>
                                <li>YOUR_WALLET_ADDRESS - your valid Digibyte-Scrypt wallet address</li>
                                <li>WORKERNAME - an optional workername can be used to identify the miner or RIG</li>
                                <li>PASSWORD - use x or leave it blank</li>
                                <br>
                                Optional:
                                <li>STATIC DIFFICULTY - to mine with a static (fixed) difficulty
                                    simply use&nbsp;<code>d=xxx</code>&nbsp;as password in your
                                    miner configuration where&nbsp;<code>xxx</code>&nbsp;denotes your
                                    preferred difficulty.
                                </li>
                            </ul>
                            <br>

                        </div>
                        <blockquote>
                            <p class="blockquote blockquote-primary" style="font-size: 12px; color: #999">
                                <span class="text-primary">For AMD Graphic cards in a Windows system, make sure you add this at the top of your .bat file:</span><br>
                                setx GPU_FORCE_64BIT_PTR 0 <br>
                                setx GPU_MAX_HEAP_SIZE 100 <br>
                                setx GPU_USE_SYNC_OBJECTS 1 <br>
                                setx GPU_MAX_ALLOC_PERCENT 100 <br>
                                setx GPU_SINGLE_ALLOC_PERCENT 100 <br>

                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('assets/js/plugins/sweetalert2.min.js') }}"></script>
<script>
    function showInfoModal(content) {
        Swal.fire({
            title: 'Wallet Address',
            text: '" '+content+' "',
            customClass: {
                confirmButton: 'btn btn-info'
            },
            buttonsStyling: false

        })
    }
</script>
@endsection