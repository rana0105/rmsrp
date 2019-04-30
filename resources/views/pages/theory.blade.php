@extends('layouts.main')

@section('content')
	<!--================ Start Home Banner Area =================-->
	<section class="home_banner_area">
		<div class="banner_inner">
			<div class="container">
				<div class="row">
					<div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Semester</th>
                    @foreach($period->toArray() as $i => $time_slot)
                        <th>{{$time_slot}}</th>
                        @if($i==3)
                            <th>Break</th>
                        @endif
                    @endforeach
                </tr>
            </thead>            
            <tbody>
                @foreach($routines as $routine)
                    <tr>
                        <td>{{$routine->semesters->semester}}</td>
                        <td>{{ $routine->semesters->semester }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
Chat Conversation End
Type a message...


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