<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!-- Active Coin list -->
    <div class="coin-list row">

        <?php 

        $list_header = array(
            '#', 
            //'master-cap', 
            'Icon', 
            'Name', 
            'ROI', 
            'Price', 
            'Change',
            'Volume', 
            'MarketCap', 
            'Total MasterNodes', 
            'Required Coins', 
            'Node Worth'
        );
        $header_class = array(
            'ranking', 
            //'master-cap', 
            'icon', 
            'name', 
            'roi', 
            'price', 
            'change',
            'volume', 
            'marketcap', 
            'Total MasterNodes', 
            'Required Coins', 
            'Node Worth'
        );
        ?>
        <div class="text-center" style="margin-top:  30px;margin-bottom:  -15px;">
          
          <button type="button" class="btn btn-primary" id="applicants" data-toggle="modal" data-target="#exampleModal">
              Applicants Here..
          </button>
          <a class="vote" href="\vote">Vote</a>
        </div>

        <table id="active_coin_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
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
                foreach ($coinList as $coinRecord) 
                {
                    $index ++;
                    $row = '<tr class="tr' .$index.' '. $coinRecord['title'] . '" onclick="coinDetailView(\'' . $coinRecord['title'] . '\''.' ,'.$index.',\''.$coinRecord['url'].'\')">';
                    $row .= '<td class="' . $header_class[0] . '">' . $index . '</td>';
                    
                    
                    $row .= '<td class="' . $header_class[1] . '"><img src="'. $coinRecord['url'] . '" alt="' . $coinRecord['url'] . '"></td>';
                    $row .= '<td class="' . $header_class[2] . '">' . $coinRecord['title'] . '</td>';
                    $row .= '<td class="' . $header_class[3] . '">' . $coinRecord['roi'] . '% </td>';  
                    $row .= '<td class="' . $header_class[4] . '"><span class="prc_usd">' . $coinRecord['price_usd'] . '</span><span class="prc_btc hid">'. $coinRecord['price_usd'] .'</span></td>';
                    if((float)substr_replace($coinRecord['change'], "", -1) >= 0) {
                    $row .= '<td class="' . $header_class[5] . '" style="color: #42bd42;">' . $coinRecord['change'] . '</td>';
                    } else {
                    $row .= '<td class="' . $header_class[5] . '" style="color: #d65858;">' . $coinRecord['change'] . '</td>';
                    }
                    $row .= '<td class="' . $header_class[6] . '">$' . $coinRecord['volume'] . '</td>';
                    $row .= '<td class="' . $header_class[7] . '">' . $coinRecord['marketcap'] . '</td>';
                    $row .= '<td class="' . $header_class[8] . '">' . $coinRecord['nodes'] . '</td>';
                    $row .= '<td class="' . $header_class[9] . '">' . $coinRecord['require'] . '</td>';
                    $row .= '<td class="' . $header_class[10] . '">' . $coinRecord['mnworth'] . '</td>';
                    $row .= '</tr>';

                    echo $row;
                }
//                 $row = '<tr class="Nanucoin (NNC)" onclick="coinDetailView(Nanucoin (NNC))">';
//                 $n = $index + 1;
//                 $row .= '<td class="' . $header_class[0] . '">' . $n . '</td>';

//                 $row .= '<td class="' . $header_class[1] . '"><img src="/img/nnc.png" alt="' . $coinRecord['url'] . '"></td>';
//                 $row .= '<td class="' . $header_class[2] . '">' . 'Nanucoin (NNC)' . '</td>';
//                 $row .= '<td class="' . $header_class[3] . '">' . '450.51' . '% </td>';  
//                 $row .= '<td class="' . $header_class[4] . '"><span class="prc_usd">' . '$0.70' . '</span><span class="prc_btc hid">'. '0.51050000BTC' .'</span></td>';
//                 if((float)substr_replace($coinRecord['change'], "", -1) >= 0) {
//                 $row .= '<td class="' . $header_class[5] . '" style="color: #42bd42;">' . '?' . '</td>';
//                 } else {
//                 $row .= '<td class="' . $header_class[5] . '" style="color: #d65858;">' . '?' . '</td>';
//                 }
//                 $row .= '<td class="' . $header_class[6] . '">' . '?' . '</td>';
//                 $row .= '<td class="' . $header_class[7] . '">' . '?' . '</td>';
//                 $row .= '<td class="' . $header_class[8] . '">' . '21' . '</td>';
//                 $row .= '<td class="' . $header_class[9] . '">' . '10000' . '</td>';
//                 $row .= '<td class="' . $header_class[10] . '">' . '?' . '</td>';
//                 $row .= '</tr>';
//
//                echo $row;
                ?>
            </tbody>
        </table>

    </div>
    <!-- /.active coin list -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#active_coin_list").DataTable({
            "pageLength": 25
        });
    })

    function coinDetailView(coinID,n, ico_url) {
        
        var roi_str = '.tr'+n+' '+'.roi';
        var roi = $(roi_str).html();
      
        var price_str = '.tr'+n+' '+'.price .prc_usd';
        var price = $(price_str).html();
      
        var change_str = '.tr'+n+' '+'.change';
        var change = $(change_str).html();
        var opt_color = change.slice(0,1)
        console.log(opt_color);
      
        var volume_str = '.tr'+n+' '+'.volume';
        var volume = $(volume_str).html();
      
        var marketcap_str = '.tr'+n+' '+'.marketcap';
        var marketcap = $(marketcap_str).html();
      
        var MasterNodes_str = '.tr'+n+' '+'.MasterNodes';
        var MasterNodes = $(MasterNodes_str).html();
      
        var Required_str = '.tr'+n+' '+'.Required';
        var Required = $(Required_str).html();
      
        var Worth_str = '.tr'+n+' '+'.Worth';
        var Worth = $(Worth_str).html();
        
        var modal_content = '';
//         modal_content += '<p>You selected <span style="color:red">' + coinID + '</span></p>';
        modal_content += '<h4 style="text-align:center;">Detail Info Coming Soon!!!</h4>';
        var n = coinID.indexOf('(');
        var s = coinID;
        s = s.substring(n+1, s.length-1);
        $.ajax({
          url: '/detail',
          type: "get",
          dataType: "json",
          data: {detail_url:s},
           success: function(response){ // What to do if we succeed
                console.log(response.title);
//                 var title_str = '<div class="row"><div class="col-md-1 col-xs-12"></div><div class="col-md-2 col-xs-12"><img src="'+ico_url+'"></div><div class="col-md-5 col-xs-12"><p class="dt_title_header">NAME</p><p class="dt_title">'+coinID+'</p></div><div class="col-md-4 col-xs-12"><p class="dt_title_header">ROI(ANNUAL)</p><p class="dt_title_roi">'+response.roi_det+'</p>';
                
                var title_str = '<div class="row">';
                title_str += '<div class="col-md-1 col-xs-12"></div>';
                title_str += '<div class="col-md-2 col-xs-12">';
                title_str += '<img src="'+ ico_url + '" alt="' +ico_url+ '">';
                title_str += '</div>';
                title_str += '<div class="col-md-5 col-xs-12">';
                title_str += '<p><span>Name</span></p>';
                title_str += '<p class="g_name">'+coinID+'</p>';
                title_str += '</div>';
                title_str += '<div class="col-md-4 col-xs-12">';
                title_str += '<p><span>ROI</span></p>';
                title_str += '<p class="grid_roi">'+roi+'</p>';
                title_str += '</div>';
                title_str += '</div>';
                title_str += '<div class="row text-center firstrow">';
                title_str += '<div class="col-md-3 col-xs-6">';
                title_str += '<p><span>PRICE</span></p>';
                title_str += '<p class="grid_price">'+price +'</p>';
                title_str += '</div>';
                title_str += '<div class="col-md-3 col-xs-6">';
                title_str += '<p><span>CHANGE</span></p>';
                if(opt_color == '-'){
                  title_str += '<p class="grid_change" style="color:red!important;">'+change+'</p>';
                }else{
                  title_str += '<p class="grid_change">'+change+'</p>';
                }
                title_str += '</div>';  
                title_str += '<div class="col-md-3 col-xs-6">';
                title_str += '<p><span>VOLUME</span></p>';
                title_str += '<p class="mvol">'+volume+'</p>';  
                title_str += '</div>'; 
                title_str += '<div class="col-md-3 col-xs-6">';
                title_str += '<p><span>MARKETCAP</span></p>';
                title_str += '<p class="mcap">'+marketcap+'</p>';
                title_str += '</div>';
                title_str += '</div>';
                title_str += '<div class="row text-center secondrow">';
                title_str += '<div class="col-md-4 col-xs-6">';  
                title_str += '<p><span>TOTAL MASTERNODES</span></p>';
                title_str += '<p class="g_perh">'+MasterNodes+'</p>';  
                title_str += '</div>'; 
                title_str += '<div class="col-md-4 col-xs-6">';  
                title_str += '<p><span>Required Coins</span></p>';
                title_str += '<p class="g_perh">'+Required+'</p>';
                title_str += '</div>';
                title_str += '<div class="col-md-4 col-xs-6">'; 
                title_str += '<p><span>NODE WORTH</span></p>';
                title_str += '<p class="g_perh">'+Worth+'</p>';
                title_str += '</div>';
                title_str += '</div>';
//                 title_str +=
//                 title_str +=
//                 title_str +=
//                 title_str +=
//                 title_str +=
//                 title_str +=
                  
                  
                $('#coin_detail_modal .modal-title').html(title_str);
                var title = ['Daily','Weekly','Monthly','Yearly'];
                for(i = 0; i<4; i++)
                {
                  var header = '#coin_detail_modal .modal-body .detail_header' + i;   
                  var info = '#coin_detail_modal .modal-body .detail_inifo' + i;
                  $(header).html(title[i]);
                  $(info).html((response.info)[i]);
                  $('#coin_detail_modal').modal();
                }
                
            }
        });  
      
        
    }
   
    jQuery(document).ready(function( $ ){
      $(document).scroll(function() {  
       var top = $(window).scrollTop();   
       if(top > 270){
        $('.top_header').addClass('fix_section container');
       }else{
        $('.top_header').removeClass('fix_section container');
       }
      })
    })
    
    function vote(){
      
    }
    
</script>

<?php //exit; ?> 