@extends('layout')

@section('content')
	<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <img src="{{$post->getImage()}}" alt="">
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            {!!$post->getCategoryLink()!!}
                            <h1 class="entry-title">{{$post->title}}</h1>
                        </header>
                        <div class="entry-content">
                            {!!$post->content!!}
                        </div>
                        <div class="decoration">
                        	@forelse ($post->tags as $tag)
                           	 <a href="{{route('tag.list', $tag->slug)}}" class="btn btn-default" style="width: inherit;padding: 5px; height: inherit;">{{$tag->title}}</a>
                            @empty
                            @endforelse
                        </div>

                        <div class="social-share">
							<span
                                    class="social-share-title pull-left text-capitalize">By {{$post->getAuthorName()}} On {{$post->getDate()}}</span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>

                @if ($post->author)
                <div class="top-comment">
                    <img src="{{$post->author->getImage()}}" style="width: 150px;" class="pull-left img-circle" alt="">
                    <h4>{{$post->getAuthorName()}}</h4>

                    <p>{{$post->author->description}}</p>
                </div>
                @endif
                
                <div class="row"><!--blog next previous-->

                    <div class="col-md-6">
                    	@if ($post->hasPrevious())
	                        <div class="single-blog-box">
	                            <a href="{{$post->previous()->getLink()}}">
	                                <img src="{{$post->previous()->getImage()}}" alt="">

	                                <div class="overlay">

	                                    <div class="promo-text">
	                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
	                                        <h5>{{$post->previous()->title}}</h5>
	                                    </div>
	                                </div>
	                            </a>
	                        </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                    	@if ($post->hasNext())
	                        <div class="single-blog-box">
	                            <a href="{{$post->next()->getLink()}}">
	                                <img src="{{$post->next()->getImage()}}" alt="">

	                                <div class="overlay">

	                                    <div class="promo-text">
	                                        <p><i class=" pull-right fa fa-angle-right"></i></p>
	                                        <h5>{{$post->next()->title}}</h5>
	                                    </div>
	                                </div>
	                            </a>
	                        </div>
                        @endif
                    </div>
                </div><!--blog next previous end-->
                <div class="related-post-carousel"><!--related post carousel-->
                    <div class="related-heading">
                        <h4>You might also like</h4>
                    </div>
                    <div class="items">
                    	@foreach ($post->related() as $item)
	                        <div class="single-item">
	                            <a href="{{$item->getLink()}}">
	                                <img src="{{$item->getImage()}}" alt="" style="padding: 2px;">

	                                <p>{{$item->title}}</p>
	                            </a>
	                        </div>
	                    @endforeach
                    </div>
                </div><!--related post carousel-->

                <h4>{{$post->comments->count()}} comment(s)</h4>
                 @foreach ($post->comments as $comment)
                    <div class="bottom-comment" style=" margin: 10px 0 10px;"><!--bottom comment-->
                        
                            <div class="comment-img" style="padding-bottom: 10px;">
                                <img class="img-circle" style="width: 100px;" src="{{$comment->author->getImage()}}" alt="">
                            </div>

                            <div class="comment-text">
                                <h5>{{$comment->author->name}}</h5>

                                <p class="comment-date">
                                    {{$comment->getDate()}}
                                </p>


                                <p class="para">{{$comment->text}}</p>
                            </div>
                    </div>
                @endforeach
                <!-- end bottom comment-->

                @auth
                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>

                    <form class="form-horizontal contact-form" role="form" method="post" action="/comment/{{$post->id}}">
                        @csrf
                        <div class="form-group">
                            <div class="col-md-12">
										<textarea class="form-control" rows="6" name="text"
                                                  placeholder="Writeright Massage"></textarea>
                            </div>
                        </div>
                        <button class="btn send-btn">Send</button>
                    </form>
                </div><!--end leave comment-->
                @endauth
            </div>
            @include('pages._sidebar')
        </div>
    </div>
</div>
<!-- end main content-->
@endsection