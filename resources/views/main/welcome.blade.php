@include('main.layout.header')
<style>
    .popover-title {
        color: white;
        background-color: black;
        font-size: 15px;
    }
</style>
<body class="exo light-off">
{{--<script type="text/javascript" src="//go.onclasrv.com/apu.php?zoneid=1392435"></script>--}}
{{--@include('main.layout.sidebar')--}} 
<div class="container-fluid">
    @include('main.layout.logo')
    <div class="row middle">
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
        </div>
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="mstr-spon-click">
                                <h3>Want your Coin Listed here?</h3>
                                <div>
                                    <a href="https://goo.gl/forms/vz313NokCtnVD5Yk2" target="_blank">Click Here</a>
                                </div>
                                <br/>
                                <br/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="list-inline pull-right">
                                <li>Coin Setting: </li>
                                <li>
                                    <div id="tab" class="btn-group" data-toggle="buttons-radio">
                                        <a href="#" class="btn btn-large btn-info active" data-toggle="tab">Masternodes</a>
                                        <a href="#" class="btn btn-large btn-info" data-toggle="tab">All</a>
                                    </div>
                                </li>
                                <li>View Setting: </li>
                                <li>
                                    <div id="tab" class="btn-group" data-toggle="buttons-radio">
                                        <a href="#" class="btn btn-large btn-info active" data-toggle="tab">List View</a>
                                        <a href="#" class="btn btn-large btn-info" data-toggle="tab">Grid View</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row activeCoinList">
                @include('main.layout.activeCoinList')
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="mstr-welcome-header text-center">Coming Soon...</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {{--@include('main.layout.activeComingSoonList')--}}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="mstr-welcome-header text-center">Help Fund Masternode Detail Site for 1 Year.</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {{--@include('main.layout.activeDonateList')--}}
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <br/>
                    <br/>
                </div>
                <div class="col-md-offset-1 col-md-10 hidden-sm hidden-xs text-center">
                    <a class="twitter-timeline" data-height="400" data-theme="dark" data-link-color="#000000" href="https://twitter.com/MasterNodesPro">Tweets by MasterNodesPro</a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>


            </div>
            <div class="row">
                <div class="col-md-12">
                    <br/><br/>
                </div>
            </div>
        </div>
    </div>
    @include('main.layout.footer')
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>
    @include('main.layout.coinDetailModal')
</div>
{{--@include('main.layout.analytics')--}}
<script>
    $('[data-toggle="popover"]').popover()
</script>
</body>
</html>