@extends('admin.layouts.layout')

@section('content')
	 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавить тег
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<form action="{{ route('tags.update', $tag->id) }}" method="POST">
			@csrf
			@method('put')
	      <!-- Default box -->
	      <div class="box">
	        <div class="box-header with-border">
	          <h3 class="box-title">Меняем тег</h3>
	        </div>
	        <div class="box-body">
	          <div class="col-md-6">
	            <div class="form-group">
	              <label for="exampleInputEmail1">Название</label>
	              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title" value="{{ $tag->title }}">
	            </div>
	        </div>
	      </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	          <a href="{{route('tags.index')}}"><button class="btn btn-default">Назад</button></a>
	          <button class="btn btn-warning pull-right">Изменить</button>
	        </div>
	        <!-- /.box-footer-->
	      </div>
	      <!-- /.box -->
		</form>
    </section>
    <!-- /.content -->
  </div>
@endsection