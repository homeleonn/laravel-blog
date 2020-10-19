@extends('admin.layouts.layout')

@section('content')
	  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Листинг сущности</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{route('subscribers.create')}}" class="btn btn-success">Добавить</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Email</th>
                  <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($subs as $sub)
	            	<tr>
	                  <td>{{$sub->id}}</td>
	                  <td>{{$sub->email}}</td>
	                  <td>
	                  	<form action="{{route('subscribers.destroy', $sub->id)}}" method="post" style=" display: inline;">
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
  <!-- /.content-wrapper -->

@endsection