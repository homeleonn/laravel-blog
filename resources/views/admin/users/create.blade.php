@extends('admin.layouts.layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Добавить пользователя
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
			@csrf
	      <!-- Default box -->
	      <div class="box">
	        <div class="box-header with-border">
	          <h3 class="box-title">Добавляем пользователя</h3>
	        </div>
	        <div class="box-body">
	          <div class="col-md-6">
	            <div class="form-group">
	              <label for="exampleInputEmail1">Имя</label>
	              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="name" value="{{ old('name') }}">
	            </div>
	            <div class="form-group">
	              <label for="exampleInputEmail1">E-mail</label>
	              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="email" value="{{ old('email') }}">
	            </div>
	            <div class="form-group">
	              <label for="exampleInputEmail1">Пароль</label>
	              <input type="password" class="form-control" id="exampleInputEmail1" placeholder="" name="password" value="{{ old('password') }}">
	            </div>
	            <div class="form-group">
	              <label for="exampleInputFile">Аватар</label>
	              <input type="file" id="exampleInputFile" name="image">

	              <p class="help-block">Какое-нибудь уведомление о форматах..</p>
	            </div>
	        </div>
	      </div>
	        <!-- /.box-body -->
	        <div class="box-footer">
	          <button class="btn btn-success pull-right">Добавить</button>
	        </div>
	        <!-- /.box-footer-->
	      </div>
	      <!-- /.box -->
		</form>
    </section>
    <!-- /.content -->
  </div>
@endsection