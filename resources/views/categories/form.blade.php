@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">

                    @if(isset($category))
                        {!! Form::model($category,['route' => ['categories.update', $category->id], 'method' => 'PUT', "files" => true]) !!}
                    @else
                        {!! Form::open(['route' => ['categories.store'], "files" => true ]) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('name', 'Название') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Название') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label for="category_id">Родительская категория</label>
                        {!! Form::label('parent_id', 'Категория') !!}
                        {!! Form::select('parent_id', [0 => 'нет'] + $aCategories, null) !!}
                    </div>


                    <input type="submit" class="btn btn-primary" style="margin:10px 12px 30px" value="Сохранить">
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



