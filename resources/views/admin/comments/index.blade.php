@extends('admin.layouts.layout')

@section('content')
	  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Текст</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comments as $comment)
                	<tr>
	                  <td>{{$comment->id}}</td>
	                  <td>{{$comment->text}}</td>
	                  <td>
	                  	<form action="{{route('comments.togglestatus', $comment->id)}}" method="post" style=" display: inline;">
	                  		@csrf
	                  		<button class="fa fa-thumbs-o-up" style="background: transparent; border: 0; color:{{$comment->status ? ' lightgreen' : 'red'}};"></button> 
	                  	</form>

	                  	<form action="{{route('comments.destroy', $comment->id)}}" method="post" style=" display: inline;">
	                  		@csrf @method('delete')
	                  		<button class="fa fa-remove" style="background: transparent; border: 0;" onclick="return confirm('are you sure?')"></button>
	                  	</form>
	                  </td>
	                </tr>
                @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
@endsection