@extends('admin.layouts.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Изменить статью
        <small>приятные слова..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
		<form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
			@csrf @method('PUT')
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Обновляем статью</h3>
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Название</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title" value="{{ $post->title }}">
            </div>
            
            <div class="form-group">
              <img src="{{ $post->getImage() }}" alt="" class="img-responsive" width="200">
              <label for="exampleInputFile">Лицевая картинка</label>
              <input type="file" id="exampleInputFile" name="image">

              <p class="help-block">Какое-нибудь уведомление о форматах..</p>
            </div>
            <div class="form-group">
              <label>Категория</label>
              <select class="form-control select2" name="category_id" style="width: 100%;">
                <option value="0">Выберите категорию</option>
				  @foreach ($categories as $category)
					<option value="{{$category->id}}" <?=($post->category_id == $category->id)?'selected':''?>>{{$category->title}}</option>
				  @endforeach
              </select>
            </div>
            <div class="form-group">
              <label>Теги</label>
              <select class="form-control select2" name="tags[]" multiple="multiple" data-placeholder="Выберите теги" style="width: 100%;">
			  @foreach ($tags as $tag)
				<option value="{{$tag->id}}" <?=isset($post->tags->pluck('title', 'id')[$tag->id])?'selected="selected"':''?>>{{$tag->title}}</option>
			  @endforeach
              </select>
            </div>
            <!-- Date -->
            <div class="form-group">
              <label>Дата:</label>

              <div class="input-group date">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control pull-right" id="datepicker" name="date" value="{{ $post->created_at->format('d/m/y') }}">
              </div>
              <!-- /.input group -->
            </div>

            <!-- checkbox -->
            <div class="form-group">
              <label>
                <input id="featured" type="checkbox" class="minimal" name="is_featured" {{$post->is_featured ? 'checked' : ''}}>
                Рекомендовать
              </label>
            </div>
            <!-- checkbox -->
            <div class="form-group">
              <label>
                <input id="status" type="checkbox" class="minimal" name="status" {{$post->status ? 'checked' : ''}}>
                Черновик
              </label>
            </div>
          </div>

        <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Краткое описание</label>
              <textarea id="" cols="30" rows="10" class="form-control" name="description">{{ $post->description }}</textarea>
          </div>
        </div>

          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputEmail1">Полный текст</label>
              <textarea id="" cols="30" rows="10" class="form-control" name="content">{{ $post->content }}</textarea>
          </div>
        </div>
      </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-warning pull-right">Изменить</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
	</form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection