@extends('layouts.main')

@section('content')
	<!--================ Start Home Banner Area =================-->
	<section class="home_banner_area">
		<div class="banner_inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 ttt">
						<div class="banner_content">
							<h2>
								We See our daily routine 
							</h2>
							{{-- <p>
								In the history of modern astronomy, there is probably no one greater leap forward than the building and launch
								of
								the space telescope known as the Hubble.
							</p> --}}
							<div class="search_course_wrap">
								<form action="" class="form_box d-flex justify-content-between w-100">
									<input type="text" placeholder="Search Courses" class="form-control" name="username" onfocus="this.placeholder = ''"
									 onblur="this.placeholder = 'Search Courses'">
									<button type="submit" class="btn search_course_btn">Search</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Home Banner Area =================-->

	<!--================ Start Feature Area =================-->
	<section class="feature_area">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-lg-4 sss">
					<div class="single_feature d-flex flex-row pb-30">
						<div class="icon">
							<span class="lnr lnr-book"></span>
						</div>
						<div class="desc">
							<h4>New Classes</h4>
							<p>
								In the history of modern astronomy, there is probably no one greater leap forward building and launch.
							</p>
						</div>
					</div>
					<div class="single_feature d-flex flex-row pb-30">
						<div class="icon">
							<span class="fa fa-trophy"></span>
						</div>
						<div class="desc">
							<h4>Top Courses</h4>
							<p>
								In the history of modern astronomy, there is probably no one greater leap forward building and launch.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================ End Feature Area =================-->
	@endsection
	@section('css')
	<style>
		.ttt {
			padding-bottom: 100px;
		}
		.sss {
			padding-bottom: 100px;
		}
	</style>
	@endsection