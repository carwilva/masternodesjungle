@extends('admin.main')

@section('content')
<!-- Main bar -->
<style>
  .dropdown-menu.pull-right{
    position: relative; 
   }
  .page-content{
    max-height: 500px;  
  }
  .pre_th th{
    width: 10%;
    padding: 10px;
    font-size: 10px;
  }
  .pre_tbody td{
    width: 10%;
    padding: 10px;
    font-size: 13px;
  }
  .pre_btn.hidebtn,
  .edit_btn.hidebtn,
  .close_btn.hidebtn,
  .btn-mini.hidebtn{
    display: none;
  }
  .pre_btn,
  .edit_btn,
  .close_btn,
  .btn-mini{
    display: block;
    width: 100%;
  }
  .transback{
    border: none;
    background: transparent;
  }
</style>
<div class="page-content">
    <div class="page-heading">
        <h1>Applicant</h1>
        <div class="options">
            <div class="btn-toolbar">
                <a href="#" class="btn btn-default"><i class="fa fa-fw fa-cog"></i></a>
            </div>
        </div>
    </div>
    <!-- <ol class="breadcrumb">

        <li><a href="#">Home</a></li>
        <li><a href="#">Admin</a></li>
        <li class="active"><a href="#">Manage Coin</a></li>

    </ol> -->
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">
                <!-- <div class="row">
                    <div class="col-md-4">
                        <a class="info-tiles tiles-success has-footer" href="#">
                            <div class="tiles-body">
                                <div class="pull-left">
                                    <p class="tile-number" id="cc_count">1</p>
                                    <p class="tile-subname">CC online</p>
                                </div>
                                <div class="pull-right"><i class="fa fa-cloud-upload tile-icon"></i></div>
                            </div>
                            <div class="tiles-footer">
                                <div class="pull-left">&nbsp;</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="info-tiles tiles-danger has-footer" href="#">
                            <div class="tiles-body">
                                <div class="pull-left">
                                    <p class="tile-number" id="dead_count">2</p>
                                    <p class="tile-subname">Dead CC</p>
                                </div>
                                <div class="pull-right"><i class="fa fa-times tile-icon"></i></div>
                            </div>
                            <div class="tiles-footer">
                                <div class="pull-left">&nbsp;</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="info-tiles tiles-primary has-footer" href="#">
                            <div class="tiles-body">
                                <div class="pull-left">
                                    <p class="tile-number" id="total_count">3</p>
                                    <p class="tile-subname">Total CC</p>
                                </div>
                                <div class="pull-right"><i class="fa fa-list tile-icon"></i></div>
                            </div>
                            <div class="tiles-footer">
                                <div class="pull-left">&nbsp;</div>
                            </div>
                        </a>
                    </div>
                </div> -->

            </div>
        </div>
        <div class="row">
            <!-- <div class="col-md-12">
                <div class="panel panel-inverse dash-top-panel">
                    <div class="row">
                        <div class="col-sm-4 switch-div-my">
                            <div class="switch-div-first">
                                <p class="my-switch">
                                    <input class="bootstrap-switch " type="checkbox" checked="false" data-size="mini" data-on-color="success" data-off-color="default" data-on-text="ON" data-off-text="OFF">
                                </p>
                                <p class="my-switch">
                                    <input class="bootstrap-switch " type="checkbox"  data-size="mini" data-on-color="success" data-off-color="default" data-on-text="ON" data-off-text="OFF">
                                </p>
                            </div>
                            <div class="switch-div-second">
                                <h3>AUTOMATED MODE</h3>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> -->
        </div>
        <div class="row">
          <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: white;">
                        <h2 style="font-size: 17px;font-weight: 500;">Masternodes cryptocurrency</h2>
                    </div>
                    <div class="panel-body table-responsive bash-table-wrap">
                        <table class="table table-bordered" style="min-height: 150px;">
                            <thead>
                            <tr>
                                <th scope="col" width="1%">No</th>
                                <th scope="col" width="3%">Coin</th>
                                <th scope="col" width="3%">Symbol</th>
                                <th scope="col" width="7%">Coin Api</th>
                                <th scope="col" width="7%">Website Url</th>
                                <th scope="col" width="7%">Icon Url</th>
                                <th scope="col" width="3%">Price Api</th>
                                <th scope="col" width="3%">Price Parameter</th>
                                <th scope="col" width="7%">Total nodes Api</th>
                                <th scope="col" width="3%">Total nodes Parameter</th>
                                <th scope="col" width="3%">Required Coins</th>
                                <th scope="col" width="3%">Supply Api</th>
                                <th scope="col" width="3%">Supply Parameter</th>
                                <th scope="col" width="7%">Change Api</th>
                                <th scope="col" width="3%">Change Parameter</th>
                                <th scope="col" width="7%">Volume Api</th>
                                <th scope="col" width="3%">Volume Parameter</th>
                                <th scope="col" width="7%">ROI Api</th>
                                <th scope="col" width="3%">ROI Parameter</th>
                                <th scope="col" width="7%">Api1</th>
                                <th scope="col" width="7%">Api2</th>
                                <th scope="col" width="7%">Edit</th>
                            </tr>
                            </thead>
                            <tbody id="dataContainer">

                            @foreach ($applicant as $masternode1 => $value) 
                                <tr class="tr{{$masternode1}}">
                                    <td class="tdindex{{$masternode1}}">{{$value->id}}</td>
                                    <td class="tdname{{$masternode1}}"><input class="coinname transback" value="{{$value->coin_name}}"></td>
                                    <td class="tdsymbol{{$masternode1}}"><input class="coinsym transback" value="{{$value->coin_symbol}}"></td>
                                    <td class="tdapi{{$masternode1}}"><input class="coinapi transback" value="{{$value->coin_api}}"></td>
                                    <td class="tdurl{{$masternode1}}"><input class="coinurl transback" value="{{$value->website_url}}"></td>
                                    <td class="tdicon{{$masternode1}}"><input class="coinicon transback" value="{{$value->icon_url}}"></td>
                                    <td class="tdpriapi{{$masternode1}}"><input class="coinpriapi transback" value="{{$value->price_api}}"></td>
                                    <td class="tdpripa{{$masternode1}}"><input class="coinpripa transback" value="{{$value->price_para}}"></td>
                                    <td class="tdmnapi{{$masternode1}}"><input class="coinmnapi transback" value="{{$value->mn_api}}"></td>
                                    <td class="tdmapa{{$masternode1}}"><input class="coinmapa transback" value="{{$value->mn_para}}"></td>
                                    <td class="tdrecoi{{$masternode1}}"><input class="coinrecoi transback" value="{{$value->required_coin}}"></td>
                                    <td class="tdsupapi{{$masternode1}}"><input class="coinsupapi transback" value="{{$value->supply_api}}"></td>
                                    <td class="tdsuppara{{$masternode1}}"><input class="coinsuppara transback" value="{{$value->supply_para}}"></td>
                                    <td class="tdchapi{{$masternode1}}"><input class="coinchapi transback" value="{{$value->change_api}}"></td>
                                    <td class="tdchpa{{$masternode1}}"><input class="coinchpa transback" value="{{$value->change_para}}"></td>
                                    <td class="tdvolapi{{$masternode1}}"><input class="coinvolapi transback" value="{{$value->volume_api}}"></td>
                                    <td class="tdvolpa{{$masternode1}}"><input class="coinvolpa transback" value="{{$value->volume_para}}"></td>
                                    <td class="tdroiapi{{$masternode1}}"><input class="coinroiapi transback" value="{{$value->roi_api}}"></td>
                                    <td class="tdroipa{{$masternode1}}"><input class="coinroipa transback" value="{{$value->roi_para}}"></td>
                                    <td class="tdapi1{{$masternode1}}"><input class="coinapi1 transback" value="{{$value->api1}}"></td>
                                    <td class="tdapi2{{$masternode1}}"><input class="coinapi2 transback" value="{{$value->api2}}"><input class="hid_nw" value="" hidden></td>
                                    
                                    
                                    
                                   
                                    <td class="hidden-phone" style="width:5%">
                                        <div class="btn-group ">
                                          <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                                            Action 
                                            <span class="caret">
                                            </span>
                                          </button>
                                          <button class="pre_btn hidebtn" onclick="preview({{$masternode1}})">Preview</button>
                                          <button class="edit_btn hidebtn" onclick="savepre({{$masternode1}})">Save</button>
                                          <button class="close_btn hidebtn" onclick="closebtn({{$masternode1}})">Close</button>
                                          <ul class="dropdown-menu pull-right">
                                            <!-- <div id="block_status3" style="margin-left:20px;"> -->
                                              <li>
                                                  <a onClick="edit_node({{$masternode1}})" data-original-title="" style="cursor:pointer;">Preview & Edit</a>
                                              </li>
                                            <!-- </div> -->
                                              <li>
                                                <a onClick="add_vote({{$masternode1}})" data-original-title="" style="cursor:pointer;" readonly>Add to Vote</a>
                                              </li>
                                              <li>
                                                <a onClick="add_list({{$masternode1}})" data-original-title="" style="cursor:pointer;" readonly>Add to Mainlist</a>
                                              </li>
                                              <li>
                                                <a onClick="delete_node({{$value->id}})" data-original-title="" style="cursor:pointer;">Delete</a>
                                              </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- .container-fluid -->
</div>

<div class="page-content">
    <div class="page-heading">
        <h1>Edit & Preview</h1>
    </div>
    <div class="container-fluid">
      <div class="row">
          <div class="col-md-4">
            <div class="row">
              <div class="col-sm-2">
                Input Api
              </div>
              <div class="col-sm-5">
                <input class="api_test" style="width: 100%;">
              </div>
              <div class="col-sm-2">
                <button class="btn_show">Show</button>
              </div>
            </div>
            <div class="row" style="padding: 10px;margin-bottom: 80px;">
              <h3>Result</h3>
              <div class="result_section col-sm-8">
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <table>
              <thead class="pre_th">
                <th>ICON</th>
                <th>NAME</th>
                <th>ROI</th>
                <th>PRICE</th>
                <th>CHANGE</th>
                <th>VOLUME</th>
                <th>MARKETCAP</th>
                <th>TOTAL MASTERNODES</th>
                <th>REQUIRED COINS</th>
                <th>NODE WORTH</th>
              </thead>
              <tbody class="pre_tbody">
                <tr>
                  <td class="pre_icon"></td>
                  <td class="pre_name"></td>
                  <td class="pre_roi"></td>
                  <td class="pre_price"></td>
                  <td class="pre_change"></td>
                  <td class="pre_volume"></td>
                  <td class="pre_marketcap"></td>
                  <td class="pre_totalmn"></td>
                  <td class="pre_requirecoin"></td>
                  <td class="pre_nw"></td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
  </div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Masternode</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Edit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@stop

@section('script')
    <script>
        function edit_node(n){
            var node = '.tr' + n;
            $('.btn-mini').addClass('hidebtn');
            $('.pre_btn').removeClass('hidebtn');
            $('.edit_btn').removeClass('hidebtn');
            $('.close_btn').removeClass('hidebtn');
            var tr_sel = node + ' ' + 'input';
            $(tr_sel).removeClass('transback');
        }
        $('.btn_show').click(function(){
            var url = $('.api_test').val();
            var src = '<iframe src="'+url+'" width="100%" height="350px"></iframe>';
            $('.result_section').html(src);
        })
        
        function preview(n){
            var tdnamestr = '.tdname'+n+' '+'.coinname';
            var tdname = $(tdnamestr).val();
          
            var tdsymbolstr = '.tdsymbol'+n+' '+'input';
            var tdsymbol = $(tdsymbolstr).val();
          
            var tdapistr = '.tdapi'+n+' '+'input';
            var tdapi = $(tdapistr).val();
          
            var tdurlstr = '.tdurl'+n+' '+'input';
            var tdurl = $(tdurlstr).val();
          
            var tdiconstr = '.tdicon'+n+' '+'input';
            var tdicon = $(tdiconstr).val();
          
            var tdpriapistr = '.tdpriapi'+n+' '+'input'
            var tdpriapi = $(tdpriapistr).val();
          
            var tdpripastr = '.tdpripa'+n+' '+'input';
            var tdpripa = $(tdpripastr).val();
          
            var tdmnapistr = '.tdmnapi'+n+' '+'input';
            var tdmnapi = $(tdmnapistr).val();
          
            var tdmapastr = '.tdmapa'+n+' '+'input';
            var tdmapa = $(tdmapastr).val();
          
            var tdrecoistr = '.tdrecoi'+n+' '+'input';
            var tdrecoi = $(tdrecoistr).val();
          
            var tdsupapistr = '.tdsupapi'+n+' '+'input';
            var tdsupapi = $(tdsupapistr).val();
          
            var tdsupparastr = '.tdsuppara'+n+' '+'input';
            var tdsuppara = $(tdsupparastr).val();
          
            var tdchapistr = '.tdchapi'+n+' '+'input';
            var tdchapi = $(tdchapistr).val();
          
            var tdchpastr = '.tdchpa'+n+' '+'input';
            var tdchpa = $(tdchpastr).val();
          
            var tdvolapistr = '.tdvolapi'+n+' '+'input';
            var tdvolapi = $(tdvolapistr).val();
          
            var tdvolpastr = '.tdvolpa'+n+' '+'input';
            var tdvolpa = $(tdvolpastr).val();
          
            var tdroiapistr = '.tdroiapi'+n+' '+'input';
            var tdroiapi = $(tdroiapistr).val();
          
            var tdroipastr = '.tdroipa'+n+' '+'input';
            var tdroipa = $(tdroipastr).val();
          
            var tdapi1str = '.tdapi1'+n+' '+'input';
            var tdapi1 = $(tdapi1str).val();
          
            var tdapi2str = '.tdapi2'+n+' '+'input';
            var tdapi2 = $(tdapi2str).val();
          
            $.ajax({
              url: '/preview',
              type: "get",
              dataType: "json",
              data: {coinapi: tdapi,
                     priceapi:tdpriapi,
                     pricepara:tdpripa,
                     totalmnapi:tdmnapi,
                     totalmnpara:tdmapa,
                     supplyapi:tdsupapi,
                     supplypara:tdsuppara,
                     changeapi:tdchapi,
                     changepara:tdchpa,
                     volapi:tdvolapi,
                     volpara:tdvolpa,
                     roiapi:tdroiapi,
                     roipara:tdroipa,
                    },
               success: function(response){ // What to do if we succeed
                    console.log(response.data);
                    $('.pre_icon').html('<img src="{{$value->icon_url}}" width="32px">');
                    $('.pre_name').html('{{$value->coin_name}} ( {{$value->coin_symbol}} )')
                    $('.pre_roi').html(response.data['roi']);
                    
                    $('.pre_price').html(response.data['price']);
                    $('.pre_change').html(response.data['change']);
                    $('.pre_volume').html(response.data['volume']);
                    $('.pre_totalmn').html(response.data['totalmasternode']);
                    var requirecoinstr = '.tdrecoi' + n + ' .coinrecoi';
                    $('.pre_requirecoin').html($(requirecoinstr).val());
                    $('.pre_nw').html(parseFloat(response.data['price'])*parseFloat($('.coinrecoi').val()));
                    $('.pre_marketcap').html(parseFloat(response.data['price']) * parseFloat(response.data['supply']));
                    var coinnodeworth = parseInt(response.data['price'])*parseInt($('.coinrecoi').val());
                    $('.hid_nw').val(coinnodeworth);
                 
               }
            });
        }
      
        function savepre(n){
            var indexstr = '.tdindex'+n;
            var index = parseInt($(indexstr).html());
            
            var tdnamestr = '.tdname'+n+' '+'.coinname';
            var tdname = $(tdnamestr).val();
          
            var tdsymbolstr = '.tdsymbol'+n+' '+'input';
            var tdsymbol = $(tdsymbolstr).val();
          
            var tdapistr = '.tdapi'+n+' '+'input';
            var tdapi = $(tdapistr).val();
          
            var tdurlstr = '.tdurl'+n+' '+'input';
            var tdurl = $(tdurlstr).val();
          
            var tdiconstr = '.tdicon'+n+' '+'input';
            var tdicon = $(tdiconstr).val();
          
            var tdpriapistr = '.tdpriapi'+n+' '+'input'
            var tdpriapi = $(tdpriapistr).val();
          
            var tdpripastr = '.tdpripa'+n+' '+'input';
            var tdpripa = $(tdpripastr).val();
          
            var tdmnapistr = '.tdmnapi'+n+' '+'input';
            var tdmnapi = $(tdmnapistr).val();
          
            var tdmapastr = '.tdmapa'+n+' '+'input';
            var tdmapa = $(tdmapastr).val();
          
            var tdrecoistr = '.tdrecoi'+n+' '+'input';
            var tdrecoi = $(tdrecoistr).val();
          
            var tdsupapistr = '.tdsupapi'+n+' '+'input';
            var tdsupapi = $(tdsupapistr).val();
          
            var tdsupparastr = '.tdsuppara'+n+' '+'input';
            var tdsuppara = $(tdsupparastr).val();
          
            var tdchapistr = '.tdchapi'+n+' '+'input';
            var tdchapi = $(tdchapistr).val();
          
            var tdchpastr = '.tdchpa'+n+' '+'input';
            var tdchpa = $(tdchpastr).val();
          
            var tdvolapistr = '.tdvolapi'+n+' '+'input';
            var tdvolapi = $(tdvolapistr).val();
          
            var tdvolpastr = '.tdvolpa'+n+' '+'input';
            var tdvolpa = $(tdvolpastr).val();
          
            var tdroiapistr = '.tdroiapi'+n+' '+'input';
            var tdroiapi = $(tdroiapistr).val();
          
            var tdroipastr = '.tdroipa'+n+' '+'input';
            var tdroipa = $(tdroipastr).val();
          
            var tdapi1str = '.tdapi1'+n+' '+'input';
            var tdapi1 = $(tdapi1str).val();
          
            var tdapi2str = '.tdapi2'+n+' '+'input';
            var tdapi2 = $(tdapi2str).val();  
          
            var tdnw = $('.hid_nw').val();
            
            $.ajax({
              url: '/savepreview',
              type: "get",
              dataType: "json",
              data: {coinindex: index,
                     coinname:tdname,
                     coinsymbol:tdsymbol,
                     coinapi: tdapi,
                     coinurl: tdurl,
                     coinicon: tdicon,
                     priceapi:tdpriapi,
                     pricepara:tdpripa,
                     totalmnapi:tdmnapi,
                     totalmnpara:tdmapa,
                     requiredcoin: tdrecoi,
                     supplyapi:tdsupapi,
                     supplypara:tdsuppara,
                     changeapi:tdchapi,
                     changepara:tdchpa,
                     volapi:tdvolapi,
                     volpara:tdvolpa,
                     roiapi:tdroiapi,
                     roipara:tdroipa,
                     api1:tdapi1,
                     api2:tdapi2,
                     coinnw:tdnw,
                    },
               success: function(response){ // What to do if we succeed
                    console.log(response.data);
               }
            });
        }
      
        function add_vote(n){
            var tdnamestr = '.tdname'+n+' '+'.coinname';
            var tdname = $(tdnamestr).val();
          
            var tdsymbolstr = '.tdsymbol'+n+' '+'input';
            var tdsymbol = $(tdsymbolstr).val();
          
            var tdiconstr = '.tdicon'+n+' '+'input';
            var tdicon = $(tdiconstr).val();
          
            $.ajax({
              url: '/addvotecoin',
              type: "get",
              dataType: "json",
              data: {coinname: tdname,
                     coinsymbol:tdsymbol,
                     coinicon:tdicon,
                    },
               success: function(response){ // What to do if we succeed
                    console.log(response);
               }
            });
            
        }
      
        function add_list(n){
            var indexstr = '.tdindex'+n;
            var index = parseInt($(indexstr).html());  
            
            var tdnamestr = '.tdname'+n+' '+'.coinname';
            var tdname = $(tdnamestr).val();
          
            var tdsymbolstr = '.tdsymbol'+n+' '+'input';
            var tdsymbol = $(tdsymbolstr).val();
          
            var tdapistr = '.tdapi'+n+' '+'input';
            var tdapi = $(tdapistr).val();
          
            var tdurlstr = '.tdurl'+n+' '+'input';
            var tdurl = $(tdurlstr).val();
          
            var tdiconstr = '.tdicon'+n+' '+'input';
            var tdicon = $(tdiconstr).val();         
          
            $.ajax({
              url: '/addmaincoin',
              type: "get",
              dataType: "json",
              data: {coinname: tdname,
                     coinsymbol:tdsymbol,
                     coinapi:tdapi,
                     coinurl:tdurl,
                     coinIndex: index,
                     coinicon: tdicon,
                    },
               success: function(response){ // What to do if we succeed
                    console.log(response);
               }
            });
            
        }
      
        function closebtn(n){
          $('.btn-mini').removeClass('hidebtn');
          $('.pre_btn').addClass('hidebtn');
          $('.edit_btn').addClass('hidebtn');
          $('.close_btn').addClass('hidebtn');
          var node = '.tr' + n;
          var tr_sel = node + ' ' + 'input';
          $(tr_sel).addClass('transback');
        };
        
        function delete_node(n){
          $.ajax({
              url: '/removeapplicant',
              type: "get",
              dataType: "json",
              data: {index: n
                    },
               success: function(response){ // What to do if we succeed
                    console.log(response);
                    location.reload(true);
               }
            });
        }
      
    </script>
    
   
@stop