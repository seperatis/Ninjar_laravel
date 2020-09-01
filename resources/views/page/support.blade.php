@extends('layouts.first')

@section('content')
    <div class="container">
        <header class="bg-gradient-primary text-white p-3" style="border-radius: 300px">
            <div class="container text-center">
                <h1 class="mb-0">Luckyblocks.ninja FAQ &amp; SUPPORT</h1>
                <p class="lead">Questions answered and contact a <strong><i>Real Human</i></strong> if you need one.</p>
            </div>
        </header>
        <section id="faq" class="pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2>FAQ</h2>
                        <p class="lead"></p>
                        <ul>
                            <li><strong><font color="red">Question:</font></strong> Why is your pool fee so high? <br><strong><font color="green">Answer:</font></strong> See the section labeled <a href="#fees">Pool Fees</a> below.</li>
                            <li><strong><font color="red">Question:</font></strong> What are your SOLO pools? <br><strong><font color="green">Answer:</font></strong> If you mine in any of our SOLO pools <strong>you get paid 95% of the block reward</strong> if your miner <strong>finds a block</strong>. <br>Please note: <strong>You get nothing unless your miner finds a block in a SOLO pool.</strong></li>
                            <li><strong><font color="red">Question:</font></strong> How long will this pool be active? <br><strong><font color="green">Answer:</font></strong> This pool was created out of the frustration of nearly every Digibyte pool going offline. We will be live for years and years to come.</li>
                            <li><strong><font color="red">Question:</font></strong> Which payment scheme does this mining pool use? <br><strong><font color="green">Answer:</font></strong> Unless you're in one of our SOLO pools (Coming Soon), all our pools use the PPLNS payment scheme. So either PPLNS or SOLO depending on which pool you join.</li>
                            <li><strong><font color="red">Question:</font></strong> Your website isn't using encryption (HTTPS), why not? <br><strong><font color="green">Answer:</font></strong> Basically because we don't need to. None of your personal information is being requested or transmitted. Nothing. So there is no reason to generate SSL/TLS certificates for the website.</li>
                            <li><strong><font color="red">Question:</font></strong> I need help or have a question not answered here. <br><strong><font color="green">Answer:</font></strong> If someone is online you can chat with us right away, just click the chat button in the lower right-hand corner of this webpage. Otherwise see the <a href="#contact">Contact Us</a> section below.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="fees" class="mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2>Pool Fees - They seem high...what gives?</h2>
                        <p class="lead">In short, it's for longevity. No pool can survive on 1% fees unless they're stealing coins on the back-end. As coin wallets get updated we have to hire blockchain-skilled coders to fix new bugs that are created by deprecated code. Running a production pool is time-intensive and requires lots of attention. As the pool grows larger we may be able to lower fees, but we don't want to be one of the pools that disappears on you over night. We're here for the long-haul.</p>

                        <p class="lead">All of our pools charge a <strong>flat 5% fee</strong>. This means the pool keeps <strong>5%</strong> of every block reward and the miners split the other <strong>95%</strong> proportionally based on the number of shares submitted. Like most other pools we use a PPLNS payment system (unless you're on one of our SOLO pools), and PPLNS rewards loyalty, not pool hoppers.</p>

                        <p class="lead"> You're going to be quite surprised how little our fees affect your actual payout. Even though we have higher fees I think you'll find that your payouts are equal or  higher than other pools. There is two reasons for this. First, <strong>we aren't stealing coins on the backend</strong> like many pools are. Second, <strong>we're running extremely high-efficient mining pool software</strong> and have <strong>optimized our database</strong> for a multi-pool configuration.

                        </p><p class="lead">To demonstrate, I can describe to you the earnings of <strong>DGB-SCRYPT pool</strong> recently. The pool has been hitting a block per day on average worth <strong>575 $DGB</strong>. With our <strong>5% fee</strong>, each miner has been averaging <strong>182.3 $DGB</strong>. If our pool fee had been <strong>1%</strong> instead of <strong>5%</strong> they payouts would average <strong>189.75 $DGB</strong>. As you can see, the difference is  <strong>negligible</strong>. But over the long term it can add up for the pool, and this means we can hire programmers needed to maintain the pool code, keep the pool online for years to come, and optimize the front-end.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="mt-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2>Contact us</h2>
                        <p class="lead">If you need help or have questions, then you can chat immediatly if someone is available on the chat, otherwise send an email to <a href="mailto:support@luckyblocks.ninja?subject=Support Request">support@luckyblocks.ninja</a></p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')

@endsection