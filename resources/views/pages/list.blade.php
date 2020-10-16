@extends('layout')

@section('content')
	<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
				<h1 style="text-align: center; margin: 5px 0px 50px;">{{$term->title}}</h1>
                <div class="row">
                	@foreach ($posts as $post)
                		<div class="col-md-6">
                        <article class="post post-grid">
                            <div class="post-thumb">
                                <a href="{{$post->getLink()}}"><img src="{{$post->getImage()}}" alt=""></a>

                                <a href="{{$post->getLink()}}" class="post-thumb-overlay text-center">
                                    <div class="text-uppercase text-center">View Post</div>
                                </a>
                            </div>
                            <div class="post-content">
                                <header class="entry-header text-center text-uppercase">
                                   {!!$post->getCategoryLink()!!}

                                    <h1 class="entry-title"><a href="{{$post->getLink()}}">{{$post->title}}</a></h1>


                                </header>
                                <div class="entry-content">
                                    {!!$post->description!!}

                                    <div class="social-share">
                                        <span class="social-share-title pull-left text-capitalize">By Rubel On {{$post->getDate()}}</span>
                                    </div>
                                </div>
                            </div>

                        </article>
                    </div>
                	@endforeach
                </div>
                {{$posts->links()}}
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>
<!-- end main content-->
@endsection