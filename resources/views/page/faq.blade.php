@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-12">
                <header class="bg-gradient-info text-white p-3 mb-3" style="border-radius: 300px">
                    <div class="container text-center">
                        <h1 class="mb-0">F A Q</h1>
                        <p class="lead">How does the pool work?</p>
                    </div>
                </header>

                <div class="card">
                    <div id="accordion" role="tablist" aria-multiselectable="true" class="card-collapse">
                        <div class="card card-plain">
                            <div class="card-header" id="headingOne">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Do I need to register an account to mine?
                                    <i class="tim-icons icon-minimal-down"></i>
                                </a>
                            </div>
                            <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-body">
                                    <p>
                                        Registration is not required. Just configure your miner
                                        according to our instructions and start mining. Your
                                        first submitted share will automatically register you
                                        with our pool. Good Luck!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain">
                            <div class="card-header" id="headingTwo">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Why is my reported hashrate zero or different from what my miner reports?
                                    <i class="tim-icons icon-minimal-down"></i>
                                </a>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body">
                                    <p>
                                        Pool and miner hashrates are re-calculated every ten
                                        minutes. Therefore it can take a maximum of ten minutes
                                        for your hashrate to update depending on the submission
                                        time of your first valid share. The hashrate we display
                                        at the pool is a rough approximation of your hashrate
                                        based on your submitted shares and can therefore differ
                                        significantly from the hashrate displayed locally. When
                                        in doubt always consider the value displayed by your
                                        miner as the correct one.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain">
                            <div class="card-header" id="headingThree">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    How will I get paid?
                                    <i class="tim-icons icon-minimal-down"></i>
                                </a>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="card-body">
                                    <p>
                                        All of our pools utilize the PPLNS payment system. PPLNS
                                        is short for "Pay Per Last N Shares". The image below
                                        illustrates the system. One round has an arbitrary
                                        number of shares which is solely based on sheer luck.
                                        Proportional reward systems only consider shares of one
                                        round when calculating rewards. PPLNS however, uses a
                                        quite constant number N of shares for calculating
                                        rewards. This number N changes only with the difficulty:
                                    </p>
                                    <p class="text-center mt-3 mb-3">
                                        <img alt="PPLNS" src="{{ asset('assets/images/shares_round.png') }}" style="width:100%;max-width: 500px;">
                                    </p>
                                    <p>
                                        As you know the number of shares needed to solve a block
                                        within a round is different. Round one and three needed
                                        (difficulty * 2) shares to be solved. Round two and four
                                        are quite short rounds. There were less than (difficulty
                                        * 2) shares necessary to solve them. Round five however
                                        is a very long round which means the pool needed more
                                        than (difficulty * 2) shares to solve the block. From
                                        this follows that:
                                    </p>
                                    <ul>
                                        <li>
                                            Rounds one and three are like proportional rounds. All
                                            of your shares from the given round are considered for
                                            reward calculations
                                        </li>
                                        <li>
                                            For rounds two and four, shares from the previous
                                            rounds are considered for calculations as well (marked
                                            green). In other words: regardless of round boundaries
                                            we always consider the last
                                            <em>(difficulty * 2)</em> shares. Your portion of the
                                            amount of shares is used to calculate your reward.
                                        </li>
                                        <li>
                                            Round five however is very long. In this round your
                                            lowermost shares (within the marked red part) are
                                            silently dropped if they are not within the last
                                            <em>(difficulty * 2)</em> shares.
                                        </li>
                                    </ul>
                                    <p>
                                        <strong>PPLNS favors constant and/or occasional loyal pool
                                            members over pool hoppers.
                                        </strong>
                                        Pool hoppers are betting for a "quick win" (like round
                                        two above) with low shares per round. If the round
                                        exceeds a certain amount of shares they "hop" to another
                                        proportional pool which started a new round more
                                        recently. This assures better rewards for pool hoppers
                                        over occasional or constant miners which are loyal to
                                        their pool. Pool hopping however implies that pool
                                        hoppers need to know when a round is started and how
                                        much shares are considered for reward. This is very easy
                                        with proportional reward system. While using PPLNS, this
                                        is no longer true. On long rounds (like round five
                                        above) the pool hoppers shares won’t be considered for
                                        reward calculations in favor of loyal miners. This is
                                        due to the fact that pool hoppers only mine on the
                                        beginning of rounds. On short and normal rounds pool
                                        hoppers won’t lose their shares. Due to the fact that
                                        shares from previous rounds from loyal miners are
                                        considered twice (or even more often on extremely short
                                        rounds) the pool hopper won’t get the same reward as
                                        from proportional reward system.
                                    </p>
                                    <p>
                                        Assuming blocks have been found, payouts are processed
                                        and send every 10 minutes. This process is fully automated.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card card-plain">
                            <div class="card-header" id="headingFour">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    When will I get paid?
                                    <i class="tim-icons icon-minimal-down"></i>
                                </a>
                            </div>
                            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="card-body">
                                    <p>
                                        You won't see any balance in your account until a block
                                        has been found by the pool and after the block has
                                        reached a mature status. This may take a couple hours,
                                        depending on the coin. As soon as a block can be
                                        considered 'mature' by the pool, your shares will be
                                        used to calculate your contribution towards finding the
                                        block. The more you've contributed, the higher your cut
                                        of the block reward will be. Your cut of the block
                                        reward will then be credited to your pending balance. If
                                        your balance reaches or exceeds the pool's minimum
                                        payout amount, the pool will transfer your
                                        <b>entire</b> balance to your wallet and
                                        <b>reset</b> your pending balance to zero. The minimum
                                        payout for each pool is listed in its 'Pool Stats' area.
                                    </p>
                                    <p>
                                        We are a small pool for the time being, and as such it
                                        may take some time to find a block. On larger pools you
                                        would see some balance earlier because they will find
                                        blocks faster, but you will get a smaller share of the
                                        reward than what you would in a smaller pool. Over time
                                        you will earn more or less the same amount when mining
                                        on a large pool or on a small one.
                                    </p>
                                    <p>
                                        In other words, the rewards you get on average are
                                        exactly proportional to your part in the total work done
                                        by the pool. If you mine in a pool
                                        <strong>twice as large</strong>, the pool will collect
                                        twice as much rewards but your share in them will be
                                        <strong>cut by half</strong>, meaning you get the same
                                        on average.
                                    </p>
                                    <p>
                                        Trustworthiness, reliability, support and low latency
                                        are the things you should consider when choosing a pool.
                                        By avoiding the largest pools you contribute to the
                                        network health by spreading the hash power.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')

@endsection