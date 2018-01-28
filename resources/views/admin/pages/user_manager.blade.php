@extends('admin.main')

@section('content')
<style>
.btn-warning2 {
color: white;
text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
background-color: #eb5a32;
background-image: -webkit-gradient(linear, left top, left bottom, from(#ed6d49), to(#eb5a32));
background-image: -webkit-linear-gradient(top, #ed6d49, #eb5a32);
background-image: -moz-linear-gradient(top, #ed6d49, #eb5a32);
background-image: -ms-linear-gradient(top, #ed6d49, #eb5a32);
background-image: -o-linear-gradient(top, #ed6d49, #eb5a32);
background-image: linear-gradient(top, #ed6d49, #eb5a32);
border-color: #ed6d49 #ed6d49 #eb5a32;
border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
}
 .btn-warning2:hover, .btn-warning2:active, .btn-warning2.active, .btn-warning2.disabled, .btn-warning2[disabled] {
    color: white;
    background-color: #eb5a32;
    *background-color: #eb5a32; }
  .btn-warning2:active, .btn-warning2.active {
    background-color: #ed6d49 \9; }
  .page-heading{
    margin-left: 0px;
  }
  .pd10{
    padding-top: 10px;
  }

</style>
<!-- Main bar -->
<div class="mainbar">
  <!-- Page heading -->
  <div class="page-heading">
    <!-- Page heading -->
    <h1 class="pull-left">Admin Manager
      <!-- page meta -->
    </h1>
    <!-- Breadcrumb -->
    <div class="clearfix"></div>
  </div>
  <!-- Page heading ends -->

  <!-- Matter -->
  <div class="matter">
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-sm-3 container-fluid">
        <div class="row-fluid dashboard-wrapper">
          <div class="row pd10">
            <div class="col-sm-4" style="text-align: right;">Name</div>
            <div class="col-sm-8"><input class="username" type="" name=""><input class="userid" type="hidde" name="" hidden></div>
          </div>
          <div class="row pd10">
            <div class="col-sm-4" style="text-align: right;">Email</div>
            <div class="col-sm-8"><input class="useremail" type="" name=""></div>
          </div>
          <div class="row pd10">
            <div class="col-sm-4" style="text-align: right;">Password</div>
            <div class="col-sm-8"><input class="userpass" type="Password" name=""></div>
          </div>
          <div style="text-align: center;padding-top: 15px;"><button onclick="submit()">Submit</button></div>
        </div>
      </div>
      <div class="col-sm-8 container-fluid" style="padding-right: 3%;">
        <p id="noti_section" style="text-align: center;color: #52b9e9;"></p>
        <div class="row-fluid dashboard-wrapper">
          <div class="span12">
            <div class="widget">
              <div class="widget-header">
                <div class="title">
                </div>
                <span class="tools">
                  <a class="fs1" aria-hidden="true" data-icon="&#xe090;"></a>
                </span>
              </div>
              
              <div class="widget-body">
                <div id="dt_example" class="example_alt_pagination" >
                    <table class="table table-condensed table-striped table-hover table-bordered pull-left" id="data-table">
                      <input type="hidden" name="page" id="page1" value="delete_job_area" />
                      <thead>
                        <tr>
                          <th style="width:5%;display:none;" >#</th>
                          <th style="width:15%">No</th>
                          <th style="width:15%">Name</th>
                          <th style="width:15%">Email</th>
                          <th style="width:15%">Created Date</th>
                          <th  class="hidden-phone">Actions</th>
                          <th style="width:15%">Eidt</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                          <input type="hidden" name="id" id="id" value="delete_job_area"/>
                          <?php 
                              foreach ($users as $user => $value) 
                          { 
                          ?>
                          <tr class="tr{{$value->id}}">
                            <th style="width:5%;display:none;" >
                            </th>
                            
                            <td class="user_info{{$value->id}} id">{{$value->id}}</td>
                            <td class="user_info{{$value->id}} name">{{$value->name}}</td>
                            <td class="user_info{{$value->id}} email">{{$value->email}}</td>
                            <td class="user_info{{$value->id}}">{{$value->created_at}}</td>
                            <td>
                              <div id="status3">
                                
                                  <span class="label label label-success">
                                    Active
                                  </span>
                                
                              </div>
                            </td>
                            
                            <td class="hidden-phone" style="width:15%">
                              <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                                  Action 
                                  <span class="caret">
                                  </span>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                 
                                  <li>
                                    <a onClick="edit_user({{$value->id}})" data-original-title="" style="cursor:pointer;">Edit</a>
                                  </li>
                               
                                  <li>
                                    <a onClick="delete_user({{$value->id}})" data-original-title="" style="cursor:pointer;">Delete</a>
                                  </li>
                                  <!-- <li>
                                    <a onClick="view_group()" data-original-title="" style="cursor:pointer;">View Group</a>
                                  </li>
                                  <li>
                                    <a onClick="view_game()" data-original-title="" style="cursor:pointer;">View Game</a>
                                  </li>
                                  <li>
                                    <a onClick="view_frnds()" data-original-title="" style="cursor:pointer;">View Friends</a>
                                  </li>
                                  <li>
                                    <a onClick="view_wining_game()" data-original-title="" style="cursor:pointer;">View Wining Game</a>
                                  </li> -->
                                </ul>
                              </div>
                            </td>
                          </tr>
                          <?php } ?>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
</div>
<!-- Main bar -->

<!-- Content ends -->

<!-- Notification box starts -->
   

<!-- Notification box ends -->  

<!-- Scroll to top -->
<span class="totop"><a href="#"><i class="icon-chevron-up"></i></a></span>

<script>
  
  function edit_user(n){

      var user_id = '.user_info' + n + '.id';
      var user_id_val = $(user_id).html();

      var user_name = '.user_info' + n + '.name';
      var user_name_val = $(user_name).html();

      var user_email = '.user_info' + n + '.email';
      var user_email_val = $(user_email).html();

      $('.userid').val(user_id_val);
      $('.username').val(user_name_val);
      $('.useremail').val(user_email_val);

  }

  function submit(){
    var index = $('.userid').val();
    var username = $('.username').val();
    var useremail = $('.useremail').val();
    var userpass = $('.userpass').val();
    
    $.ajax({
      url: 'update_user',
      type: "get",
      data: {index:index,
             username:username,
             useremail: useremail,
             userpass: userpass
            },
       success: function(response){ // What to do if we succeed
            //location.reload();              
            //alert(response); 
        }
    });
  }


  function delete_user(n){
      $.ajax({
        url: 'delete_user',
        type: "get",
        data: {index:n},
         success: function(response){ // What to do if we succeed
              location.reload();
              //alert(response); 
          }
      });
  }

</script>


@stop