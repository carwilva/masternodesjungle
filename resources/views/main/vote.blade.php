@include('main.layout.header')
<style>
    .popover-title {
        color: white;
        background-color: black;
        font-size: 15px;
    }
  
    .star-rating {
        text-decoration: none;
        color: #222;
        font-size: 38px;
      }
    .star-rating .icon-star {
      width: 22px;
      height: 22px;
      vertical-align: middle;
      fill: #999;
      margin-top: -8px;
      animation: inactive 0.2s ease-in-out forwards;
      transform: translate3d(0, 0, 0);
    }
    .star-rating.active {
      color: #e1373e;
    }
    .star-rating.active .icon-star {
      fill: #f38072!important;
      /*animation: active 0.3s ease-in-out forwards;*/
    }
  
    @keyframes active {
      50% {
        transform: rotate(180deg) scale(1.5);
      }
      100% {
        transform: rotate(360deg) scale(1);
      }
    }
    @keyframes inactive {
      50% {
        opacity: 0;
        transform: scale(1.5);
      }
      100% {
        transform: scale(1);
      }
    }
    a:hover {
        color: #23527c;
        text-decoration: none!important;
    }
    a:focus{
        text-decoration: none!important;
        outline: none!important;
        outline-offset: 0px!important;
    }
    /* progress bar style */
    @keyframes bar-fill {
      0% {
        width: 0;
      }
    }
    @-webkit-keyframes bar-fill {
      0% {
        width: 0;
      }
    }
    @-moz-keyframes bar-fill {
      0% {
        width: 0;
      }
    }
    @-o-keyframes bar-fill {
      0% {
        width: 0;
      }
    }
    .bar-graph {
      list-style: none;
      margin: 50px 0px auto;
    }
    .bar-wrap {
      -moz-border-radius: 10px 10px 10px 10px;
      -webkit-border-radius: 10px 10px 10px 10px;
      -ms-border-radius: 10px 10px 10px 10px;
      border-radius: 10px 10px 10px 10px;
      background-color: rgba(0, 155, 202, 0.2);
/*       border: 1px solid rgba(0, 155, 202, 0.8); */
      margin-bottom: 10px;
      width: 80%;
      margin-left: auto;
      margin-right: auto;
    }
    .bar-fill {
      -moz-border-radius: 10px 10px 10px 10px;
      -webkit-border-radius: 10px 10px 10px 10px;
      -ms-border-radius: 10px 10px 10px 10px;
      border-radius: 10px 10px 10px 10px;
      -moz-animation: bar-fill 1s;
      -webkit-animation: bar-fill 1s;
      -ms-animation: bar-fill 1s;
      animation: bar-fill 1s;
      background-color: rgb(51, 122, 183);
      display: block;
      height: 8px;
      width: 0px;
    }
  .end_vote{
      text-align: center;
      padding-top: 30px;
   }
  .btn_vote{
      background: #41463d;
      border: none;
      padding: 7px 20px;
      border-radius: 5px;
      color: #b5b5b5; 
  }
  #active_coin_list td{
    padding: 5px 0!important;
  }

</style>
<body class="exo light-off">
{{--<script type="text/javascript" src="//go.onclasrv.com/apu.php?zoneid=1392435"></script>--}}
{{--@include('main.layout.sidebar')--}}
  
<?php 

$list_header = array(
    '',
    '#', 
    'Icon', 
    'Name', 
    'Votes',
    'Progress'
);
$header_class = array(
    'option',
    'ranking', 
    //'master-cap', 
    'icon', 
    'name', 
    'votes', 
    'progressbar'
);
?>
  
<div class="top_bar">
  <div class="row bar_section">
    <div class="col-sm-4 logo_section">
        <ul class="list-inline stat-counters" data-global-stats-container="">
            <li><a href="/"><img src="/img/logo.png" class="logo"></a></li>
        </ul>
    </div>
    <div class="col-sm-8 set_section" style="padding-top:10px;">
      <ul class="list-inline" style="">
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
        <li class="cur_section" style="margin-left: 160px;">
          <button class="btn_don" id="donationbtn" data-toggle="modal" data-target="#exampleModa2">Donation</button>
        </li>
        <li class="dropdown" style="float:right;">
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
      </ul>
    </div>
  </div>
</div>
<div class="container">
    @include('main.layout.logo')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row text-center">
              <h5 style="color:#7b7b7b;padding: 40px;">Each registered user can cast multiple votes (maximum one vote per candidate coin) </h5>
            </div>
            <table id="active_coin_list" class="table table-striped table-bordered dt-responsive nowrap vote" cellspacing="0" width="100%">
              <thead>
                  <tr class="top_header">
                      <?php 

                      foreach ($list_header as $key => $header) {
                          echo '<th class="' . $header_class[$key] . '">' . $header . '</th>';
                      }

                      ?>
                  </tr>
              </thead>

              <tbody>
                  <?php 
                    $coinRow = '';

                    $index = 0;
                    foreach ($votecoinList as $coinRecord) 
                    { 
                      $index ++;
                      $row = '<tr class="' . $coinRecord['coin'] . '\')">';
                      $row .= '<td class="' . $header_class[0].$index . '" onclick="vote('.$index.','.$coinRecord['coinID'].')">
                              <svg display="none">
                                <defs>
                                  <symbol id="icon-star" viewBox="0 0 1024 1024">
                                    <title>star</title>
                                    <path d="M511.302 797.603l-316.416 226.397 109.382-372.922-304.268-252.556 370.036-3.258 141.265-395.264 137.309 398.522h375.389l-305.664 254.976 109.382 370.502-316.416-226.397z"></path>
                                  </symbol>
                                </defs>
                              </svg>';
                      if(isset($checked_vote)){
                        if (in_array($coinRecord['coinID'], $checked_vote)) {
                          $row .= '<a href="#0" class="star-rating active">';    
                        }else{
                          $row .= '<a href="#0" class="star-rating">';    
                        } 
                      }else{
                        $row .= '<a href="#0" class="star-rating">';
                      }
                      $row .= '<svg class="icon-star" role="image" aria-labeledby="icon-star-label">
                                   <use xlink:href="#icon-star"></use>
                                   <title id="icon-star-label">Star Rating Icon</title>
                                </svg>

                              </a>';
                      $row .= '<td class="' . $header_class[1].$index . '">' . $index . '</td>';
                      $row .= '<td class="' . $header_class[2] . '"><img src="'. $coinRecord['url'] . '" alt="' . $coinRecord['url'] . '"></td>';
                      $row .= '<td class="' . $header_class[3] . '" style="text-align:center;">' . $coinRecord['coin'].'('. $coinRecord['sysmbol']  . ')</td>';
                      $row .= '<td class="' . $header_class[4] .$index. '" style="text-align:center;color: #f38072;">' . $coinRecord['votes'] . '</td>'; 
                      $row .= '<td class="' . $header_class[5] . '">  <li><div class="bar-wrap"><span class="bar-fill pro'.$index.'" style="width: '.$coinRecord['votes']/5 .'%;"></span></div></li></td>'; 
                      $row .= '</tr>';

                      echo $row;
                    }
                  ?>
              </tbody>
          </table>
<!--           <div class="end_vote">
            <button class="btn_vote">
              Voting ends
            </button>
          </div> -->
      </div>
  </div>
  <div class="container row" style="text-align: right;">

  </div>
  @include('main.layout.footer')
  <div class="modal fade" id="mainModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  </div>
  
@include('main.layout.coinDetailModal')
</div>
{{--@include('main.layout.analytics')--}}
<script>
  function vote(n, id){
    var activeClass = "active";
    var option = '.option' + n + '' + ' .star-rating';
    $(option).toggleClass(activeClass);
    var flag = $(option).hasClass('active');
    var userid = {{Auth::user()->id}};
    var classname ='.votes'+n;
    if(flag == true){
      var vote_num = parseInt($(classname).html(), 10)+1;
      $.ajax({
        url: '/addvote',
        type: "get",
        dataType: "json",
        data: {userID:userid,
               coinID:id,
               vote:vote_num},
         success: function(response){ // What to do if we succeed
             var vote_num = parseInt($(classname).html(), 10)+1;
             $(classname).html(vote_num);
             var progressbar = '.bar-fill.pro' + n;
             var progresswidth = (vote_num/5) + '%';
             $(progressbar).css('width',progresswidth);
         }
      });
      
    }
    else{
      var vote_num = parseInt($(classname).html(), 10)-1;
      $.ajax({
        url: '/removevote',
        type: "get",
        dataType: "json",
        data: {userID:userid,
               coinID:id,
               vote:vote_num},
         success: function(response){ // What to do if we succeed
             var vote_num = parseInt($(classname).html(), 10)-1;
             $(classname).html(vote_num);
             var progressbar = '.bar-fill.pro' + n;

             var progresswidth = (vote_num/5) + '%';
             $(progressbar).css('width',progresswidth);
         }
      });
    } 
  }
  
//   $('.btn_vote').click(function(){
//     alert("flag");
//   });


</script>
</body>
</html>