@extends('admin.main')

@section('content')
<!-- Main bar -->
<style type="text/css">
    .edit_value {
        width: 100%;
    }
    .node_item {
        border: none;
        background: transparent;
    }
    .sel_node {
        box-shadow: 7px -1px 12px 0px #949191;
    }
    .confirm, .canbtn {
        cursor: pointer;
        font-size: 16px;
        background: #dddddd;
        color: #6d6d6d;
        padding: 3px 7px 3px 7px;
        box-shadow: 0px 1px 2px 0px #a1a1a1;
        font-weight: bold;
    }
    .pt10 {
        margin-bottom: 10px!important;
    }
</style>
<div class="page-content">
    <div class="page-heading">
        <h1>DASHBOARD</h1>
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
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background: white;">
                        <h2 style="font-size: 17px;font-weight: 500;">Vote Coin Lists</h2>
                    </div>
                    <div class="panel-body table-responsive bash-table-wrap" style="max-height: 600px;">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" width="80px">No</th>
                                <th scope="col" width="350px">Icon Url</th>
                                <th scope="col" width="80px">Coin</th>
                                <th scope="col" width="80px">Symbol</th>
                                <th scope="col">Voted</th>
                                <th scope="col">Edit</th>
                            </tr>
                            </thead>
                            <tbody id="dataContainer">

                            <?php 
                            foreach ($vote as $votenode => $value) 
                            { 
                            ?>
                                <tr class="tr{{$value->id}}">
                                    <td><input type="" name="" value="{{$value->id}}" class="node_item{{$value->id}} node_item id" size="4" readonly></td>
                                    <td><input type="" name="" value="{{$value->icon_url}}" class="node_item{{$value->id}} node_item cid" readonly style="width:100%;"></td>
                                    <td><input type="" name="" value="{{$value->coin}}" class="node_item{{$value->id}} node_item cname" readonly></td>
                                    <td><input type="" name="" value="{{$value->coin_symbol}}" class="node_item{{$value->id}} node_item csym" readonly></td>
                                    <td><input type="" name="" value="{{$value->votes}}" class="node_item{{$value->id}} node_item capi" readonly></td>
                                    <td class="hidden-phone" style="width:15%">
                                        <div class="btn-group ">
                                          <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle btn{{$value->id}}">
                                            Action 
                                            <span class="caret">
                                            </span>
                                          </button>
                                          <ul class="dropdown-menu pull-right">
                                            <!-- <div id="block_status3" style="margin-left:20px;"> -->
<!--                                               <li>
                                                  <a onClick="edit_node({{$value->id}})" style="cursor:pointer;">Edit</a>
                                              </li> -->
                                            <!-- </div> -->
                                            <li>
                                              <a onClick="delete_node({{$value->id}})" data-original-title="" style="cursor:pointer;">Delete</a>
                                            </li>
                                            </ul>
                                        </div>
                                        <a onClick="confirm_btn({{$value->id}})" class="confirm{{$value->id}} confirm" style="cursor:pointer;" hidden>Ok</a>
                                        <a onClick="canbtn_btn({{$value->id}})" class="canbtn{{$value->id}} canbtn" style="cursor:pointer;" hidden>Cancel</a>
                                        
                                    </td>
                                </tr>
                            <?php 
                            } 
                            ?>  

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-8" style="text-align:center;">
          <h3 style="font-weight: 600;">
            Change the banner...
          </h3>
          Input Banner URL: <input type="text" class="banner_link"></br></br>
          Input Banner Link:  <input type="text" class="banner_url"></br></br>

          Input Footer URL: <input type="text" class="footer_url"></br></br>
          Input Footer Link:  <input type="text" class="footer_link"></br></br>
          <button class="update_banner">Update</button>
        </div>
        <div class="col-sm-1"></div>
      </div>
    </div>
    <!-- .container-fluid -->
</div>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Masternode Edit</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">ID</th>
                    <th scope="col">Coin</th>
                    <th scope="col">Symbol</th>
                    <th scope="col">Api</th>
                    <th scope="col">Website url</th>
                </tr>
            </thead>
            <tboday>
                <td></td>
                <td><input class="edit_value" type="" name="" value="asdf"/></td>
                <td><input class="edit_value" type="" name="" value=""/></td>
                <td><input class="edit_value" type="" name="" value=""/></td>
                <td><input class="edit_value" type="" name="" value="asdfasdfasdfasd"/></td>
                <td><input class="edit_value" type="" name="" value=""/></td>
            </tboday>
        </table>
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
        /*$('.edit_coin').click(function(){
            alert("hello");
        })*/
//         function edit_node(n){
//             var node = '.node_item' + n;
//             var row = '.tr' + n;
//             var btn = '.btn' + n;
//             var confirm = '.confirm' + n;
//             var canbtn = '.canbtn' + n;
//             $(node).removeClass('node_item');
//             $(node).removeAttr('readonly');
//             $(row).addClass('sel_node');
//             $(btn).addClass('hidden');
//             $(confirm).removeAttr('hidden');
//             $(canbtn).removeAttr('hidden');
//             $(confirm).removeClass('hidden');
//             $(canbtn).removeClass('hidden');
//         }

//         function confirm_btn(n){
//             var node = '.node_item' + n;
//             var row = '.tr' + n;
//             var btn = '.btn' + n;
//             var confirm = '.confirm' + n;
//             var canbtn = '.canbtn' + n;
//             $(node).addClass('node_item');
//             $(node).attr('readonly');
//             $(row).removeClass('sel_node');
//             $(btn).removeClass('hidden');
//             $(confirm).addClass('hidden');
//             $(canbtn).addClass('hidden');
//             var cid = node + '.cid';
//             var cid_val = $(cid).val();

//             var cid = node + '.cid';
//             var cid_val = $(cid).val();

//             var cname = node + '.cname';
//             var cname_val = $(cname).val();

//             var csym = node + '.csym';
//             var csym_val = $(csym).val();

//             var capi = node + '.capi';
//             var capi_val = $(capi).val();

//             var cweb = node + '.cweb';
//             var cweb_val = $(cweb).val();

//             $.ajax({
//               url: 'update_node',
//               type: "get",
//               data: {index:n,
//                      id:cid_val,
//                      name: cname_val,
//                      sym: csym_val,
//                      api: capi_val,
//                      web: cweb_val},
//                success: function(response){ // What to do if we succeed
//                     //alert(response); 
//                 }
//             });

//         }

        function delete_node(n){
            $.ajax({
              url: 'delete_vote',
              type: "get",
              data: {index:n},
               success: function(response){ // What to do if we succeed
                    location.reload();
                }
            });
        }

        $('.update_banner').click(function(){
          
            var url = $('.banner_url').val();
            var link = $('.banner_link').val();
            var urlfooter = $('.footer_url').val();
            var linkfooter = $('.footer_link').val();
            $.ajax({
              url: 'update_banner',
              type: "get",
              data: {
                    bannerurl:url,
                    bannerlink:link,
                    footerurl:urlfooter,
                    footerlink:linkfooter,
                    },
               success: function(response){ 
                }
            });
        })
        

    </script>
   
@stop