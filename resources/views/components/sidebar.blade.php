<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ url('/') }}" class="simple-text logo-mini">
                @if(session(session('id'))->coin->type == 'LTC')
                    <img src="{{ asset('assets/images/lightcoin.png') }}">
                @else
                    <img src="{{ asset('assets/images/dgb1.png') }}">
                @endif
            </a>
            <a href="{{ url('/') }}" class="simple-text logo-normal">
               {{ session(session('id'))->coin->name }}
            </a>
        </div>
        <ul class="nav">
            @if($page == 'home')
                <li class="active">
            @else
                <li>
            @endif
                <a href="{{ url('/') }}">
                    <i class="tim-icons icon-bank"></i>
                    <p>Home</p>
                </a>
            </li>
            @if($page == 'stats')
                <li class="active">
            @else
                <li>
            @endif
                <a href="{{ route('stats', ['id'=>session('id')]) }}">
                    <i class="tim-icons icon-chart-bar-32"></i>
                    <p>Stats</p>
                </a>
            </li>
            @if($page == 'dashboard')
                <li class="active">
            @else
                <li>
            @endif
                <a href="{{ url('/dashboard') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if($page == 'miners')
                <li class="active">
            @else
                <li>
            @endif
                <a href="{{ route('miners', ['id'=>session('id')]) }}">
                    <i class="tim-icons icon-single-02"></i>
                    <p>Miners</p>
                </a>
            </li>
            @if($page == 'blocks')
                <li class="active">
            @else
                <li>
            @endif
                <a href="{{ url('/blocks') }}">
                    <i class="tim-icons icon-components"></i>
                    <p>Blocks</p>
                </a>
            </li>
            @if($page == 'payments')
                <li class="active">
            @else
                <li>
            @endif
                <a href="{{ url('/payments') }}">
                    <i class="tim-icons icon-money-coins"></i>
                    <p>Payments</p>
                </a>
            </li>
            @if($page == 'connect')
                <li class="active">
            @else
                <li>
            @endif
                <a href="{{ url('/connect') }}">
                    <i class="tim-icons icon-link-72"></i>
                    <p>Connect</p>
                </a>
            </li>
            @if($page == 'faq')
                <li class="active">
            @else
                <li>
            @endif
                <a href="{{ url('/faq') }}">
                    <i class="tim-icons icon-chat-33"></i>
                    <p>FAQ</p>
                </a>
            </li>
            @if($page == 'support')
                <li class="active">
            @else
                <li>
            @endif
                <a href="{{ url('/support') }}">
                    <i class="tim-icons icon-headphones"></i>
                    <p>Support</p>
                </a>
            </li>
        </ul>
    </div>
</div>