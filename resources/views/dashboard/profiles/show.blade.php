



@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
			<div class="panel-heading">
				{{ $user->name }}
			</div>	
			<div class="panel-body">
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<div class="thumbnail">
					<h3 align="center">{{ $user->name }}</h3>
					  <img src="{{URL::to('/')}}/img/{{Auth::user()->pic}}" alt="profile pic not loading for now" width="120px" height="120px" class="img-circle"/>
                           
						
					</div>
					<div class="caption">
                      <p align="center">{{ $user->profile->city}} - {{ $user->profile->country }}</p>
                          @if ($user->profile->user_id == Auth::user()->id)
                    <p align="center">
                     <a href="{{route('edit.dashboard.profile', $user->id)}}" class="btn btn-primary" role="button">
                         Edit Profile
                     </a>
                   </p>
                                      @endif
                   </div>

			 		
			    </div> 
			     <div class="col-sm-6 col-md-4">
			     	<h4 class=""><span class="label label-default">About</span></h4>
			         <p> {{ $user->profile->about}} </p>
                    </div>

			</div>
			</div>				
			</div>
		</div>		
	 </div>
</div>
@endsection