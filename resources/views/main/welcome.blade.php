@include('main.layout.header')
<style>
    .popover-title {
        color: white;
        background-color: black;
        font-size: 15px;
    }
    #exampleModal input{
        color: black;
        font-weight: 600;
    }
    #exampleModal input::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
        color: gray;
        opacity: 1; /* Firefox */
        font-weight: 400;
    }

    #exampleModal input:-ms-input-placeholder { /* Internet Explorer 10-11 */
        color: red;
    }

    #exampleModal input::-ms-input-placeholder { /* Microsoft Edge */
        color: red;
    }
</style>
<body class="exo light-off">
  <!-- page load -->
<div class="page-load hidden">
</div>
{{--<script type="text/javascript" src="//go.onclasrv.com/apu.php?zoneid=1392435"></script>--}}
{{--@include('main.layout.sidebar')--}} 
<div class="top_bar">
  <div class="row bar_section">
    <div class="col-sm-4 logo_section">
        <ul class="list-inline stat-counters" data-global-stats-container="">
            <li><a href="/"><img src="/img/logo.png" class="logo"></a></li>
<!--             <li>Masternode coins: <strong><a href="#"><span data-global-stats-cryptocurrencies="">{{$coinList[0]['total_node']}}</span></a></strong></li>
            <li>Masternodes online: <strong><a href="#"><span data-global-stats-markets="">{{$coinList[0]['total_online']}}</span></a></strong></li> -->
            
        </ul>
    </div>
    <div class="col-sm-8 set_section" style="padding-top:10px;">
      <ul class="list-inline" style="">
        <li class="btc_info">BTC price: <strong><a href="#"><span data-global-stats-markets="">{{$coinList[0]['usd_btc']}}</span></a></strong></li>
        <li>Light </li>
        <li>
          <ul class="nav nav-pills" style="position: absolute;top: 10px;">
            <li>
                <a onclick="lightOn()" data-toggle="tab">On</a>
            </li>
            <li class="active">
                <a onclick="lightOff()" data-toggle="tab">Off</a>
            </li>
        </ul>
        </li>
<!--         <li class="active">
            <a onclick="lightOn()" data-toggle="tab">On</a>
        </li>
        <li>
            <a onclick="lightOff()" data-toggle="tab">Off</a>
        </li> -->
        <li class="cur_set" style="margin-left: 70px;">Currency: </li>
        <li>
            <select class="currency" id="currency" onchange="OnSelectionChange()">
                <?php 
                  if($coinList[0]['trans_cur'] == 'USD') {
                ?>
                <option value="USD" class="btc_usd" selected="selected">USD</option>
                <option value="BTC" class="btc_opt">BTC</option>
                <?php }else { ?>
                <option value="USD" class="btc_usd">USD</option>
                <option value="BTC" class="btc_opt" selected="selected">BTC</option>
                <?php } ?>
                <!--option value="EUR" selected="">EUR</option-->

            </select>
        </li>

        <li>View Setting: </li>
        <li style="position: absolute;">
            <ul class="nav nav-pills btn_mod">
                <li class="active">
                    <a href="#view_list" data-toggle="tab">List View</a>
                </li>
                <li>
                    <a href="#view_grid" data-toggle="tab">Grid View</a>
                </li>
            </ul>
        </li>
        <li class="cur_section" style="margin-left: 160px;">
          <button class="btn_don" id="donationbtn" data-toggle="modal" data-target="#exampleModa2">Donation</button>
        </li>
      </ul>
<!--         <ul class="list-inline stat-counters" data-global-stats-container="">
            <li>Masternodes worth: <strong><a href="#"><span data-global-stats-market-cap="" data-global-currency-market-cap="">{{$coinList[0]['total_wrth_usd']}} / {{$coinList[0]['total_wrth_btc']}}</span></a></strong></li>
            <li>24h Volume: <strong><a href="#"><span data-global-stats-volume="" data-global-currency-volume="">{{$coinList[0]['total_vol_usd']}} / {{$coinList[0]['total_vol_btc']}}</span></a></strong> MarketCap: <strong><a href="#"><span data-global-stats-btc-dominance="">{{$coinList[0]['total_mcp_usd']}} / {{$coinList[0]['total_mcp_btc']}}</span></a></strong></li>
        </ul> -->
    </div>
<!--     <div class="col-sm-1 text-right" style="padding-top: 8px;">
      <ul class="list-inline" style="">
        <li>
          <button class="btn_don" id="donationbtn" data-toggle="modal" data-target="#exampleModa2">Donation</button>
        </li>
      </ul> -->
<!--        <div class="btn-group">
          <button type="button" class="btn btn-xs dropdown-toggle language-dropdown" data-toggle="dropdown">
              <span data-language-dropdown="">English</span> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu text-center" role="menu">
              <li class="pointer"><a href="/" data-language-toggle="en">English</a></li>
               <li class="pointer"><a href="/es/" data-language-toggle="es">Español</a></li>
              <li class="pointer"><a href="/pt-br/" data-language-toggle="pt-br">Português Brasil</a></li>
              <li class="pointer"><a href="/zh/" data-language-toggle="zh">简体中文</a></li> -->
<!--      </ul>
        </div>
         <div data-global-currency-switch="" class="btn-group global-currency-dropdown-container">
          <button type="button" class="btn btn-xs dropdown-toggle global-currency-dropdown" data-toggle="dropdown">
              <span data-currency-display="">USD</span> <span class="caret"></span>
          </button>
          <ul class="dropdown-menu text-center" role="menu">
                <li class="pointer"><a data-currency-toggle="">USD</a></li>
<!--                 <li class="pointer"><a data-currency-toggle="">DKK</a></li>
                <li class="pointer"><a data-currency-toggle="">JPY</a></li>
                <li class="pointer"><a data-currency-toggle="">PLN</a></li>
                <li class="pointer"><a data-currency-toggle="">AUD</a></li>
                <li class="pointer"><a data-currency-toggle="">EUR</a></li>
                <li class="pointer"><a data-currency-toggle="">KRW</a></li>
                <li class="pointer"><a data-currency-toggle="">RUB</a></li>
                <li class="pointer"><a data-currency-toggle="">BRL</a></li>
                <li class="pointer"><a data-currency-toggle="">GBP</a></li>
                <li class="pointer"><a data-currency-toggle="">MXN</a></li>
                <li class="pointer"><a data-currency-toggle="">SEK</a></li>
                <li class="pointer"><a data-currency-toggle="">CAD</a></li>
                <li class="pointer"><a data-currency-toggle="">HKD</a></li>
                <li class="pointer"><a data-currency-toggle="">MYR</a></li>
                <li class="pointer"><a data-currency-toggle="">SGD</a></li>
                <li class="pointer"><a data-currency-toggle="">CHF</a></li>
                <li class="pointer"><a data-currency-toggle="">HUF</a></li>
                <li class="pointer"><a data-currency-toggle="">NOK</a></li>
                <li class="pointer"><a data-currency-toggle="">THB</a></li>
                <li class="pointer"><a data-currency-toggle="">CLP</a></li>
                <li class="pointer"><a data-currency-toggle="">IDR</a></li>
                <li class="pointer"><a data-currency-toggle="">NZD</a></li>
                <li class="pointer"><a data-currency-toggle="">TRY</a></li>
                <li class="pointer"><a data-currency-toggle="">CNY</a></li>
                <li class="pointer"><a data-currency-toggle="">ILS</a></li>
                <li class="pointer"><a data-currency-toggle="">PHP</a></li>
                <li class="pointer"><a data-currency-toggle="">TWD</a></li>
                <li class="pointer"><a data-currency-toggle="">CZK</a></li>
                <li class="pointer"><a data-currency-toggle="">INR</a></li>
                <li class="pointer"><a data-currency-toggle="">PKR</a></li>
                <li class="pointer"><a data-currency-toggle="">ZAR</a></li> -->
<!--        </ul>
        </div> 
      </div>-->
  </div>
<!--   <div class="">
    <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif
        
      </ul>
  </div> -->
</div>
<div class="container">
    @include('main.layout.logo')
<!--     <div class="row middle stripe">

        <div class="col-sm-12">
            <ul class="list-inline pull-right" style="padding-right: 150px;padding-top: 10px;">
                <li>Light </li>
                <li class="active">
                    <a onclick="lightOn()" data-toggle="tab">On</a>
                </li>
                <li>
                    <a onclick="lightOff()" data-toggle="tab">Off</a>
                </li>
                <li>Currency: </li>
                <li>
                    <select class="currency" id="currency" onchange="OnSelectionChange()">
                        <?php 
                          if($coinList[0]['trans_cur'] == 'USD') {
                        ?>
                        <option value="USD" class="btc_usd" selected="selected">USD</option>
                        <option value="BTC" class="btc_opt">BTC</option>
                        <?php }else { ?>
                        <option value="USD" class="btc_usd">USD</option>
                        <option value="BTC" class="btc_opt" selected="selected">BTC</option>
                        <?php } ?>
                        <!--option value="EUR" selected="">EUR</option-->
                        
<!--                    </select>
                </li>
                
                <li>View Setting: </li>
                <li style="position: absolute;top: 0;right: 0;padding-top: 7px;">
                    <ul class="nav nav-pills">
                        <li class="active">
                            <a href="#view_list" data-toggle="tab">List View</a>
                        </li>
                        <li>
                            <a href="#view_grid" data-toggle="tab">Grid View</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

    </div> -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row ">

                <div class="tab-content clearfix">
                    <div class="tab-pane" id="masternodes_only">
                        <h1>Masternodes Only</h1>
                    </div>
                    <div class="tab-pane" id="all_coins">
                        <h1>All Coins</h1>
                    </div>
                    <div class="tab-pane active activeCoinList" id="view_list">
                        @include('main.layout.activeCoinList')
                    </div>
                    <div class="tab-pane activeGrid" id="view_grid">
                        @include('main.layout.activeGrid')
                    </div>
                </div>
                
            </div>
            <div class="text-center" style="margin-bottom: 3%;">
              <a href="{{$coinList[0]['banner_url']}}"><img style="-webkit-user-select: none;background-position: 0px 0px, 10px 10px;background-size: 20px 20px;background-image:linear-gradient(45deg, #eee 25%, transparent 25%, transparent 75%, #eee 75%, #eee 100%),linear-gradient(45deg, #eee 25%, white 25%, white 75%, #eee 75%, #eee 100%);" src="{{$coinList[0]['banner_link']}}"></a>
  <!--             <p class="header_cont">
                Masternodes are computers that run a dash wallet and make decisions, such as locking transactions with InstantSend, coordinate mixing of coins, and voting on budget funding.
              </p> -->
            </div>
            <div class="text-center" style="margin-bottom: 3%;">
            <a href="{{$coinList[0]['footer_link']}}"><img src="{{$coinList[0]['footer_url']}}" width="728" height="90"></a> 
          </div>
<!--             <div class="row" style="margin-bottom: 20%;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="mstr-welcome-header text-center">Coming Soon...</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('main.layout.activeComingSoonList')
                </div>
            </div> -->
            <!--div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h3 class="mstr-welcome-header text-center">Help Fund Masternode Detail Site for 1 Year.</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {{--@include('main.layout.activeDonateList')--}}
                </div>
            </div-->
           
        </div>
    </div>
    <div class="container row" style="text-align: right;">
      
    </div>
    @include('main.layout.footer')
    <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    </div>


    <!-- Applicants Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register New Masternode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        *Coin Name:
                      </div>
                      <div class="col-sm-7">
                        <input class="new_name" required placeholder="Bitcoin">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        *Coin Symbol:
                      </div>
                      <div class="col-sm-7">
                        <input class="new_detail" required placeholder="BTC">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        *Icon URL:
                      </div>
                      <div class="col-sm-7">
                        <input class="new_web_icon" required placeholder="https://files.coinmarketcap.com/static/img/coins/bitcoin.png">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        *Requried Coins:
                      </div>
                      <div class="col-sm-7">
                        <input class="required_coin" required placeholder="1000">
                      </div>
                    </div>
<!--                    <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        Coin API(ROI):
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api_roi" required placeholder="https://api.coinmarketcap.com/v1/ticker/bitcoin/">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        Coin API(Price):
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api_price" required placeholder="https://api.coinmarketcap.com/v1/ticker/bitcoin/">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        Coin API(Change):
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api_change" required placeholder="https://api.coinmarketcap.com/v1/ticker/bitcoin/">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        Coin API(Volume):
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api_vol" required placeholder="https://api.coinmarketcap.com/v1/ticker/bitcoin/">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        Coin API(MarketCap):
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api_market" required placeholder="https://api.coinmarketcap.com/v1/ticker/bitcoin/">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        Coin API(Required Coins):
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api_recoin" required placeholder="https://api.coinmarketcap.com/v1/ticker/bitcoin/">
                      </div>
                   </div> -->
                   <div class="row">
                      <div class="col-sm-2"></div>
<!--                       <div class="col-sm-3">
                        Coin API(Node Worth):
                      </div> -->
                      <div class="col-sm-3">
                        *Coin API:
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api_nw" required placeholder="https://api.coinmarketcap.com/v1/ticker/bitcoin/">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        *Website URL:
                      </div>
                      <div class="col-sm-7">
                        <input class="new_web" required placeholder="https://www.bitcoin.com/">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        Coin API1:
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api1" required placeholder="https://explorer.bitcoin.com/ext/summary?27">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        Coin API2:
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api2" required placeholder="https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id=1182">
                      </div>
                   </div>
<!--                    <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        Icon Upload:
                      </div>
                      <div class="col-sm-7">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                          Select image to upload:
                          <input type="file" required name="fileToUpload" id="fileToUpload">
                       </form>
                      </div>
                   </div> -->
                   <div class="row" style="text-align:center;"> 
<!--                       <p style="padding-top:10px;">*Please Enter the Api which provides the full infos.(<button type="button" class="btn" id="registerndoes" data-toggle="modal" data-target="#registerModalshow">
              Show Sample here..
          </button>)</p> -->
                     <p style="padding-top:10px;">*Please Enter the Apis which provide the enough infos.(Using Api1 and Api2)</p>
                     <p style="font-size: 10.5px;color: #b9b9b9;">(Price, Total Masternodes, Circulating Supply, Volume, Change, ROI...)                        </p>
                   </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="register()">Register Request</button>
                </div>
            </div>
        </div>
    </div>
  
    <!-- Donation Modal-->
    <div class="modal fade" id="exampleModa2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thank You For The Donation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align:center;">
                  <h5 class="xrb_sec"><strong>XRB:</strong></h5>
                  <p class="xrb_sec">
                  xrb_1kp6rfzpe7mxacmihgc7aqrom5enxe3kqfurnf85nkg363iwfbfzorqujhdf
                  </p> 
                  <h5 class="eth_sec"><strong>ETH:</strong></h5>
                  <p class="eth_sec">
                  0x514d45659b231ccFaE7d1bE64c9379C072a1604d
                  </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--                     <button type="button" class="btn btn-primary" onclick="register()">Submit</button> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Donation Modal End-->
  
    <div class="modal fade" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thank you</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align:center;">
                    <h4 class="thkmsg" style="color:#7b7b7b;">
                     Thank you!!! Coming soon!
                    </h4>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Sample register new Masternode process show  -->
    <div class="modal fade" id="registerModalshow" tabindex="-1" role="dialog" aria-labelledby="registerModalshow" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">How to register New MasterNode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align:center;">
                    <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        <p>*Coin Name:</p>
                      </div>
                      <div class="col-sm-7">
                        <input class="new_name" readonly value="Bitcoin">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        <p>*Coin Symbol:</p>
                      </div>
                      <div class="col-sm-7">
                        <input class="new_detail" readonly value="BTC">
                      </div>
                   </div>
                   <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        <p>*Icon URL:</p>
                      </div>
                      <div class="col-sm-7">
                        <input class="new_web_icon" readonly value="https://files.coinmarketcap.com/static/img/coins/bitcoin.png">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        <p>*Requried Coins:</p>
                      </div>
                      <div class="col-sm-7">
                        <input class="required_coin" readonly value="1000">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        <p>Coin API:</p>
                      </div>
                      <div class="col-sm-7">
                        <input class="new_api_nw" readonly value="https://api.coinmarketcap.com/v1/ticker/bitcoin/">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2"></div>
                      <div class="col-sm-3">
                        <p>Website URL:</p>
                      </div>
                      <div class="col-sm-7">
                        <input class="new_web" readonly value="https://www.bitcoin.com/">
                      </div>
                    </div>
                </div>
<!--                 <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    <!-- End -->
    @include('main.layout.coinDetailModal')
</div>
{{--@include('main.layout.analytics')--}}
<script>
  
    $('[data-toggle="popover"]').popover()
    function lightOn() {
        $('body').removeClass('light-off');
        $('body').addClass('light-on');
    }
    function lightOff() {
        $('body').removeClass('light-on');
        $('body').addClass('light-off');
    }
    function OnSelectionChange(){
        if($('#currency').val() == "BTC") {
          location.href = "btc#view_grid";
        }else {
          location.href = "usd#view_grid";
        }
    }
    function register() {
        if(($('.new_name').val() == '') || ($('.new_detail').val() == '') || ($('.new_web_icon').val() == '') || ($('.new_web').val() == '') || ($('#ileToUpload') == '')){
            $('.new_name').focus();
        }else{
            $.ajax({
              url: '/registernode',
              type: "get",
              data: {name:$('.new_name').val(),
                     detail:$('.new_detail').val(),
//                      new_api_roi: $('.new_api_roi').val(),
//                      new_api_price: $('.new_api_price').val(),
//                      new_api_change: $('.new_api_change').val(),
//                      new_api_vol: $('.new_api_vol').val(),
//                      new_api_market: $('.new_api_market').val(),
                     new_api1: $('.new_api1').val(),
                     new_api2: $('.new_api2').val(),
                     new_api_nw: $('.new_api_nw').val(),
                     new_web: $('.new_web').val(),
                     new_web_icon: $('.new_web_icon').val(),
                     new_require_coin: $('.required_coin').val()
                    },
               success: function(result){ // What to do if we succeed
                  console.log(result);
                  if(!result){
                      alert('This coin is already existed!');
                  }else{
                    $('#exampleModal').modal('toggle');
                    $('#finishModal').modal('show'); 
                    location.reload();
                  }
                }
            });
            
            
        }
    }
  
    function showsample(){
      
    }
    
</script>
</body>
</html>