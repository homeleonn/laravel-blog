@extends('layout')

@section('content')
	<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">

                <div class="leave-comment mr0"><!--leave comment-->
                    
                    <h3 class="text-uppercase">My profile</h3>
                    <br>
                    <img src="{{$user->getImage()}}" alt="" class="profile-image">
                    <form class="form-horizontal contact-form" role="form" method="post" action="{{route('profile.update')}}" enctype="multipart/form-data">
                    	@csrf @method('put')
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="name" name="name"
                                       placeholder="Name" required value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Email" required value="{{$user->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="password" name="password"
                                       placeholder="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
								<input type="file" class="form-control" id="image" name="image">	
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
								<textarea name="description" id="description" class="col-md-12" rows="10">{{$user->description}}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn send-btn">Update</button>

                    </form>
                </div><!--end leave comment-->
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>
<!-- end main content-->
@endsection