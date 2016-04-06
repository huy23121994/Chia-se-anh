<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="{{url('public/favicon.ico')}}">
	
    {{ HTML::style('public/assets/css/style.css') }}
    {{ HTML::style('public/assets/css/bootstrap.min.css') }}
    {{ HTML::style('public/assets/css/jquery-ui.min.css') }}
    {{ HTML::style('public/assets/css/animate.css') }}
    {{ HTML::style('public/assets/css/lightslider.css') }}
    {{ HTML::style("vendor/kartik-v/bootstrap-fileinput/css/fileinput.min.css")}}
    
    @yield('style-bot')
    {{ HTML::script('public/assets/js/jquery-1.9.1.min.js') }}
    {{ HTML::script('public/assets/js/jquery-ui.min.js') }}
    {{ HTML::script('public/assets/js/jquery.nicescroll.js') }}
    {{ HTML::script('public/assets/js/bootstrap.min.js') }}
    {{ HTML::script('public/assets/js/imagesloaded.js') }}
    {{ HTML::script('public/assets/js/masonry.pkgd.min.js') }}
    {{ HTML::script("public/assets/js/lightslider.js")}}
    
    {{ HTML::script("vendor/kartik-v/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js")}}
    {{ HTML::script("vendor/kartik-v/bootstrap-fileinput/js/fileinput.min.js")}}
    {{ HTML::script("vendor/kartik-v/bootstrap-fileinput/js/fileinput_locale_LANG.js")}}
	{{ HTML::script("public/assets/js/layout/master.js")}}
    @yield('script-bot')
    

</head>
<body>
    <header class='col-md-12'>
		<div class="top">
			<div class="col-md-3 logo">
                <h1  style='display: none;'>Photo</h1>
                <h4 class='col-md-8'><a href="{{url('/home')}}"><img src="{{url('public/assets/images/logo.png')}}" alt="logo"/></a></h4>
                <h4 id='link-to-home' class='col-md-4'><a href="{{url('/home')}}">HOME</a></h4>
            </div>
			<ul class="col-md-6 search_area">
				
				<li>
                    <form action="{{url('album')}}" method="get">
                        <p class='col-md-12'>
                            <input type="text" placeholder="Search ..." class="search form-control" name="title">
                            <input type="number" class="width form-control" name="width" placeholder="Width">
                            <input type="number" class="height form-control" name="height" placeholder="Height">
                            <input type="submit" class="btn btn-default" value="Search">
                        </p>
                        
                        <!--<button class="icon-search">\</button>-->
                    </form>
				</li>
			</ul>
			<ul class="col-md-3 login_singin_area pull-right">
				@if(Session::has('current_user'))
					<li class="col-md-7">
						<a href="{{url('/details')}}">
                            <p class="user-name"><img class="img-rounded avatar" src="{{url(User::find(Session::get('current_user'))->avatar)}}">
                                <span class="user_name">{{ User::find(Session::get('current_user'))->short_name() }}</span>
                            </p>
                        </a>

					</li>
                    <li class='col-md-5'><a href="{{url('logout')}}">Logout</a></li>
				@else
					<li class="col-md-7 login">
						<a><p>Login</p></a>
						@yield('login')
					</li>
					<li class="col-md-5" >
						<a href="{{Asset('signup')}}"><p>Signup</p></a>
						@yield('signup')
					</li>
				@endif
			</ul>
		</div>
		<div class="pop-up">
			<div class="wrapper">
	            <form action="{{url('login')}}" id="login-form" method="POST">
					<input type="text" name="account" placeholder="Username">
					<input type="password" name="password" placeholder="Password">
	                <button class="submit">Login</button>
				</form>
				<p class="error" style="text-align: center"></p>
				<span title="Click to close">x</span>
			</div>
		</div>
	</header>
    <div class="clearfix"></div>
    <nav>
        <div class="navi">
        	<div class="categories col-md-6">
	            <p class="menu_button"><span></span>Category</p>
	            <div class="menu">
<!--	                <ul>
	                    <li><a href="">Ảnh hot nhất</a></li>
	                    <li><a href="">Mới Nhất</a></li>
	                </ul>-->
	                <ul>
	                    @foreach($categories as $index => $category)
	                    <li><a href="{{Asset('album?category='.$category->id)}}">{{$category->title}}</a></li>
	                    @endforeach
	                </ul>
	                
	            </div>
	        </div>
            <div class='category-title col-md-2'>
            @if(isset($category_title))
            <h2>{{$category_title}}</h2>
            @endif
            </div>
	        @if(Session::has('current_user'))
	        <div class='images-manage-buttons col-md-4 '>
                <span class="button"><a  class="btn btn-danger upload_button" href="{{url('album/create')}}">Upload</a></span>
	            <span class="button"><a class="btn btn-danger mypic_button" href="{{Asset("/album?u=".Session::get('current_user'))}}">My images</a></span>
                @if(User::find(Session::get('current_user'))->is_admin == 1)
                <span class="button"><a href='{{url('admin')}}'><button class='btn btn-default'>Admin page</button></a></span>
                @endif
	        </div>
        	@endif
        </div>
        <div class='clearfix'></div>
    </nav>
    <section>
        <div class="wrapper">
            @yield('content')
        </div>
        <aside>

        </aside>
    </section>
    <div class="clearfix"></div>
    <footer>
        <ul class="team_contact">
            <li><a href="">About us</a></li>
            <li><a href="">Policy</a></li>
            <li><a href="">Contact</a></li>
            
        </ul>
    </footer>
</body>
</html>