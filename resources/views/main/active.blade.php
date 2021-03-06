@include('main.layout.header')
<style>
    .popover-title {
        color: white;
        background-color: black;
        font-size: 15px;
    }
</style>
<body>
@include('main.layout.sidebar')
<div class="container-fluid">
    @include('main.layout.logo')
    <div class="row middle">
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
        <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
        </div>
        <div class="col-lg-1 hidden-md hidden-sm hidden-xs"></div>
    </div>
    <div class="row" style="margin-top: 50px;">
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="text-align: center;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <div class="row">
                    <div class="span4"></div>
                    <div class="span4"><a href="https://www.vultr.com/?ref=6877914"><span style="font-size: 16px">Best VPS Hosting for Masternodes</span><br><img src="https://www.vultr.com/media/banner_1.png" class="img-responsive center-block"></a></div>
                    <div class="span4"></div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <br><br><br>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <div class="alert alert-info">Want your Coin Listed here? Email us:
                    <a href="mailto:addme@masternodes.pro">addme@masternodes.pro</a> or join us on
                    <a href="https://join.slack.com/t/masternodespro/shared_invite/MjEzNDg5NjM2NjI3LTE1MDAyNjE2ODgtZTQ0Y2M5ZDk5OQ"><i class="fa fa-slack" aria-hidden="true"></i>SLACK</a>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                @foreach ($coinList as $key => $one)
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 align-left" style="margin-top: 20px;">
                        <div style="border:2px solid #E4E6EB;border-radius: 10px;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif;min-width:285px;">
                            <div>
                                <div style="float:right;width:67%;border: 0px solid #000;text-align:center;padding:5px 0px;line-height:30px;">
                                    <div>
                                        <span style="font-size: 18px;">
                                            <a href="https://{!! strtoupper($one['coin']) !!}.masternodes.pro" target="_blank" style="text-decoration: none; color: rgb(66, 139, 202);">{!! $one['name'] !!} ({!! strtoupper($one['coin']) !!})</a>
                                        </span>
                                    </div>
                                    <div>
                                        <span style="font-size: 16px;">${!! number_format($one['currentUSDPrice'],2,'.','') !!} USD</span>
                                    </div>
                                </div>
                                <div style="text-align:center;padding:5px 0px;width:33%;"><a href="https://{!! strtoupper($one['coin']) !!}.masternodes.pro" target="_blank"><img src="{!! $one['logo'] !!}" width="50vw"></a></div>
                            </div>
                            <div style="border-top: 1px solid #E4E6EB;text-align:center;clear:both;font-size:10px;font-style:italic;padding:5px 0;">
                                Coin Supply: {!! $one['coin_supply'] !!}
                            </div>
                            <div style="border-top: 1px solid #E4E6EB;clear:both;">
                                <div style="text-align:center;float:left;width:50%;font-size:12px;padding:12px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Total Master Nodes <br><br> <span style="font-size: 17px; ">{!! $one['totalMasterNodes'] !!}</span></div>
                                <div style="text-align:center;float:left;width:50%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Coins Locked <br><br> <span
                                            style="font-size: 14px; ">{!! number_format($one['totalMasterNodes'] * $one['masterNodeCoinsRequired'],'0','',',') !!} ({!! number_format(((($one['totalMasterNodes'] * $one['masterNodeCoinsRequired']) /  $one['coin_supply'] ) * 100),'2','.',',') !!}%)<Br></span></div>
                            </div>
                            <div style="border-top: 1px solid #E4E6EB;clear:both;">
                                <div style="text-align:center;float:left;width:33%;font-size:12px;padding:12px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Required Coin's <br><br> <span style="font-size: 17px; ">{!! $one['masterNodeCoinsRequired'] !!}</span></div>
                                <div style="text-align:center;float:left;width:34%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Node Worth <br><br> <span
                                            style="font-size: 14px; ">${!! number_format($one['currentUSDPrice'] * $one['masterNodeCoinsRequired'],2,'.','') !!}</span></div>
                                <div style="text-align:center;float:left;width:33%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;">
                                    ROI % <br><br> <span
                                            style="font-size: 14px; ">{!!  number_format($one['roi'],2,'.','') !!}%</span>
                                </div>
                            </div>
                            <div style="border-top: 1px solid #E4E6EB;clear:both;">
                                <div style="text-align:center;float:left;width:25%;font-size:12px;padding:12px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Daily <br><br> <span style="font-size: 17px; ">${!! number_format($one['income']['daily'],2,'.','') !!}</span></div>
                                <div style="text-align:center;float:left;width:25%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Weekly <br><br> <span style="font-size: 14px; ">${!! number_format($one['income']['weekly'],2,'.','') !!}</span></div>
                                <div style="text-align:center;float:left;width:25%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #E4E6EB;line-height:1.25em;"> Monthly <br><br> <span style="font-size: 14px; ">${!! number_format($one['income']['monthly'],2,'.','') !!}</span></div>
                                <div style="text-align:center;float:left;width:25%;font-size:12px;padding:12px 0 16px 0;line-height:1.25em;"> Yearly <br><br> <span style="font-size: 14px; ">${!! number_format($one['income']['yearly'],2,'.','') !!}</span></div>
                            </div>
                            <div style="border-top: 1px solid #E4E6EB;text-align:center;clear:both;font-size:10px;font-style:italic;padding:5px 0;">
                                Last Updated <br>{!! $one['lastUpdated'] !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <br><br><br>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
                <script data-cfasync=false src="//s.ato.mx/p.js#id=2194065&size=728x90"></script>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align: center;">
            <div class="col-lg-12 col-md-12 col-sm-9 col-xs-9" style="text-align: center;">
                <a class="twitter-timeline" href="https://twitter.com/MasterNodesPro">Tweets by MasterNodesPro</a>
                <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>
    </div>
    @include('main.layout.footer')
    <!-- Modal Section -->
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>

    <!-- Applicants Modal -->
    <!-- Button trigger modal -->
    
    
</div>
@include('main.layout.analytics')
<script>
    $('[data-toggle="popover"]').popover();
</script>
</body>
</html>
