@if (count($errors) > 0)
			<div class="alert alert-danger">
				<strong>Whoops!</strong> There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
        
        {!! Form::open(['url'=> url('auth/login'), 'method'=>'post']) !!}
        	 
            <div class="form-group">
              {!! Form::text('email', null, ['class'=> 'form-control rounded input-lg text-center no-border', 'placeholder' => 'Email']) !!}
          	</div>
          	
            <div class="form-group">
              {!! Form::password('password', ['class'=>'form-control rounded input-lg text-center no-border' ,'placeholder' => 'Password']) !!}
          	</div>

          	<button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign in</span></button>
          	
          	<div class="text-center m-t m-b"><a href="#"><small>Forgot password?</small></a></div>
         
            <header class="wrapper text-center">
              <strong>OR </strong>
            </header>
            <div class="text-center m-t m-b"><a href="{{ url('auth/register') }}"> Register here </a></div>
            <div class="text-center">
              <!--
              <a href="{{ url('oauth/loginByTwitter') }}" class="btn btn-rounded btn-lg btn-icon btn-info"><i class="fa fa-twitter"></i></a>
              -->
              <a href="{{ url('oauth/loginByFacebook') }}" class="btn btn-rounded btn-lg btn-icon btn-primary"><i class="fa fa-facebook"></i></a>
              <a href="{{ url('oauth/loginByGoogle') }}" class="btn btn-rounded btn-lg btn-icon btn-danger"><i class="fa fa-google-plus"></i></a>
            </div>
            {{-- 
            <div class="line line-dashed"></div>
          	<p class="text-muted text-center"><small>Do not have an account?</small></p>
          	<a href="{{ url('auth/register') }}" class="btn btn-lg btn-info btn-block rounded">Create an account</a>
            --}}
        {!! Form::close() !!}