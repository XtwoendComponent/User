
<section id="content" class="m-t-lg wrapper-md animated fadeInDown">
    <div class="container aside-xl">
      <a class="navbar-brand block" href="{{ url('/') }}"><span class="h1 font-bold"> </span></a>
      <section class="m-b-lg">
        <header class="wrapper text-center">
          <strong>Sign up to find interesting thing</strong>
        </header>

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

        {!! Form::open(['url'=> url('auth/register'), 'method'=>'post']) !!}
        	
        	  <div class="form-group">
              {!! Form::text('first_name', null, ['class'=> 'form-control rounded input-lg text-center no-border', 'placeholder' => 'First Name']) !!}
          	</div>
            <div class="form-group">
              {!! Form::text('last_name', null, ['class'=> 'form-control rounded input-lg text-center no-border', 'placeholder' => 'Last Name']) !!}
            </div>
            <div class="form-group">
              {!! Form::text('email', null, ['class'=> 'form-control rounded input-lg text-center no-border', 'placeholder' => 'Email']) !!}
          	</div>          	
            <div class="form-group">
              {!! Form::password('password', ['class'=>'form-control rounded input-lg text-center no-border' ,'placeholder' => 'Password']) !!}
         	</div>
          	
          <div class="checkbox i-checks m-b">
            <label class="m-l">
              <input type="checkbox" checked=""><i></i> Agree the <a href="#">terms and policy</a>
            </label>
          </div>

          <button type="submit" class="btn btn-lg btn-warning lt b-white b-2x btn-block btn-rounded"><i class="icon-arrow-right pull-right"></i><span class="m-r-n-lg">Sign up</span></button>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Already have an account?</small></p>
          <a href="{{ url('auth/login') }}" class="btn btn-lg btn-info btn-block btn-rounded">Sign in</a>
       	{!! Form::close() !!}
      </section>
    </div>
  </section>
