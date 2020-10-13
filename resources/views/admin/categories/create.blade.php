@extends('admin.layouts.layout')

@section('content')
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Добавить категорию
				<small>приятные слова..</small>
			</h1>
		</section>
	
		<!-- Main content -->
		<section class="content">
			<form action="{{ route('categories.store') }}" method="POST">
				@csrf
				<!-- Default box -->
				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Добавляем категорию</h3>
					</div>
					<div class="box-body">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Название</label>
								<input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title">
							</div>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
	         			<a href="{{route('categories.index')}}">Назад</a>
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