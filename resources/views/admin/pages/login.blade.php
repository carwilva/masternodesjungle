@extends('admin.main')

@section('content')
<style>.head{display:none !important;}</style>
<div class="admin-form">
  <div class="container-fluid">

    <div class="row-fluid">
      <div class="span12">
        <!-- Widget starts -->
            <div class="widget worange">
              <!-- Widget head -->
              <div class="widget-head">
                <i class="icon-lock"></i> Login 
              </div>
              <div class="widget-content">
                <div class="padd">
                  <!-- Login form -->
                  <form class="form-horizontal" action="{{ route('auth.admin.login') }}" method="post" id="login-form">
										{!! csrf_field() !!}
                    <input type="hidden" name="page" value="login">
                    <!-- Email -->
                    <div class="control-group">
                      <label class="control-label" for="inputEmail">Email</label>
                      <div class="controls">
                        <input type="text"  name="username" id="inputEmail" placeholder="Email" value="{{ old('username') }}">
                      </div>
                    </div>
                    <!-- Password -->
                    <div class="control-group">
                      <label class="control-label" for="inputPassword">Password</label>
                      <div class="controls">
                        <input type="password"  name="password" id="inputPassword" placeholder="Password">
                      </div>
                    </div>
                    <!-- Remember me checkbox and sign in button -->
                    <div class="control-group">
                      <div class="controls">
                       
                        <button type="submit" class="btn btn-danger">Sign in</button>
                        <button type="reset" class="btn">Reset</button>
                      </div>
                    </div>
                    <?php if(isset($_SESSION['login_error'])){ ?> <p id="login_error" align="center"><?php echo $_SESSION['login_error'];?></p><script>
              
        $(function(){
          $('#login_error').css('color',"#900");
           $('#login_error').fadeIn(function(){$('#login_error').fadeOut(4000);});
        }); 
        </script>
        
            <?php  unset($_SESSION['login_error']); }
       
        
        ?>
                  </form>

                </div>
              </div>
                
            </div>  
      </div>
    </div>
  </div> 
</div>
	
@stop