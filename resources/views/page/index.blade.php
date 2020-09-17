@extends('layouts.first')


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
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-gradient-info">
            <div class="tools float-right">
            </div>
            <h4 class="card-title text-uppercase" style="letter-spacing: 2px; font-weight: 700"><i class="tim-icons icon-coins"> </i> &nbsp;&nbsp;Pool Coins</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive table-first" style="overflow: auto">
              <table class="table table-striped table-hover">
                <thead class="text-primary">
                <tr>
                  <th></th>
                  <th>Pool coin</th>
                  <th>Algorithm</th>
                  <th class="text-center">Miners</th>
                  <th class="text-right">Pool Hashrate</th>
                  {{--<th class="text-right">Fee</th>--}}
                  <th class="text-right">Network Hashrate</th>
                  <th class="text-right">Network Difficulty</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pools as $pool)
                  @if($pool->paymentProcessing->payoutScheme != "Solo")
                    <tr>
                      <td class="text-center">
                        <a href="{{ route('stats', ['id' => $pool->id]) }}">
                          <div class="photo">
                            <img src="{{ asset('assets/images/icon/'.strtolower($pool->coin->type)).'.png' }}" alt="image">
                          </div>
                        </a>
                      </td>
                      <td>
                        {{ $pool->coin->name }}
                      </td>
                      <td>
                        {{ $pool->coin->algorithm }}
                      </td>
                      <td class="text-center">
                        {{ $pool->poolStats->connectedMiners }}
                      </td>
                      <td class="text-right">
                        {{ thousandsCurrencyFormat((int)$pool->poolStats->poolHashrate) }}H/s
                      </td>
                      {{--<td class="text-right">--}}
                        {{--{{ $pool->poolFeePercent }}%--}}
                      {{--</td>--}}
                      <td class="text-right">
                        {{ thousandsCurrencyFormat((int)intval($pool->networkStats->networkHashrate)) }}H/s
                      </td>
                      <td class="text-right">
                        {{ thousandsCurrencyFormat((int)$pool->networkStats->networkDifficulty) }}
                      </td>
                      <td class="text-center" style="min-width: 200px">
                        <a href="{{ route('stats', ['id' => $pool->id]) }}" class="btn btn-round btn-info">
                          <img width="25" src="{{ asset('assets/images/icon/'.strtolower($pool->coin->type)).'.png' }}" alt="image">
                          &nbsp;&nbsp;Go Mine
                        </a>
                      </td>
                    </tr>
                  @endif
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="google-ads-980-120" style="margin-bottom: 30px">
      <span style="font-size: 60px">980 X 120</span>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header bg-gradient-primary">
            <div class="tools float-right">
            </div>
            <h4 class="card-title text-uppercase" style="letter-spacing: 2px; font-weight: 700"><i class="tim-icons icon-money-coins"> </i> &nbsp;&nbsp;Solo Mining</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive table-first" style="overflow: auto">
              <table class="table table-striped table-hover">
                <thead class="text-primary">
                <tr>
                  <th></th>
                  <th>Pool coin</th>
                  <th>Algorithm</th>
                  <th class="text-center">Miners</th>
                  <th class="text-right">Pool Hashrate</th>
                  {{--<th class="text-right">Fee</th>--}}
                  <th class="text-right">Network Hashrate</th>
                  <th class="text-right">Network Difficulty</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pools as $pool)
                  @if($pool->paymentProcessing->payoutScheme == "Solo")
                    <tr>
                      <td class="text-center">
                        <a href="{{ route('stats', ['id' => $pool->id]) }}">
                          <div class="photo">
                            <img src="{{ asset('assets/images/icon/'.strtolower($pool->coin->type)).'.png' }}" alt="image">
                          </div>
                        </a>
                      </td>
                      <td>
                        {{ $pool->coin->name }}
                      </td>
                      <td>
                        {{ $pool->coin->algorithm }}
                      </td>
                      <td class="text-center">
                        {{ $pool->poolStats->connectedMiners }}
                      </td>
                      <td class="text-right">
                        {{ thousandsCurrencyFormat((int)$pool->poolStats->poolHashrate) }}H/s
                      </td>
                      {{--<td class="text-right">--}}
                        {{--{{ $pool->poolFeePercent }}%--}}
                      {{--</td>--}}
                      <td class="text-right">
                        {{ thousandsCurrencyFormat((int)intval($pool->networkStats->networkHashrate)) }}H/s
                      </td>
                      <td class="text-right">
                        {{ thousandsCurrencyFormat((int)$pool->networkStats->networkDifficulty) }}
                      </td>
                      <td class="text-center" style="min-width: 200px">
                        <a href="{{ route('stats', ['id' => $pool->id]) }}" class="btn btn-round btn-primary">
                          <img width="25" src="{{ asset('assets/images/icon/'.strtolower($pool->coin->type)).'.png' }}" alt="image">
                          &nbsp;&nbsp;Go Mine
                        </a>
                      </td>
                    </tr>
                  @endif
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-5">
      <h3 class="title">LuckyBlocks.Ninja Mining Pool</h3>
    </div>
    <div class="row">
      <div class="col-md-4">
        <p>
          Honest, high-performance, DigiByte mining pool.
          Your pending balance will change every time the pool finds a block, earnings aren't estimated.
          Payouts happen automatically after a block is found, and has 100 confirmations.
        </p>
      </div>
      <div class="col-md-6 ml-auto">
        <div class="progress-container progress-warning">
          <span class="progress-badge">500GB</span>
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
            </div>
          </div>
        </div>
        <div class="progress-container progress-primary">
          <span class="progress-badge">4 years</span>
          <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection