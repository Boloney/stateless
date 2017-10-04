@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">

                    @if(isset($oProduct))
                        {!! Form::model($oProduct,['route' => ['products.update', $oProduct->id], 'method' => 'PUT', "files" => true]) !!}
                    @else
                        {!! Form::open(['route' => ['products.store'], "files" => true ]) !!}
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
                        <p>
                            @if(isset($oProduct) && $oProduct->photo)
                                <img class="src-photo" src="{!! $oProduct->getPhoto() !!}"  style="width:100px;"/>
                            @endif
                        </p>
                        {!! Form::file("photo", ["accept" => ".jpg,.png"]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('photo_description', 'Описание фотографии') !!}
                        {!! Form::textarea('photo_description', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <label for="tags">Тэги</label>
                        {!! Form::select('tags[]', $aTags, isset($oProduct) ? $oProduct->tags->pluck('id')->all() : null, ['multiple' => 'multiple', 'id'=>'tags']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('category_id', 'Категория') !!}
                        {!! Form::select('category_id', $aCategories, null) !!}
                    </div>

                        <input type="submit" class="btn btn-primary" style="margin:10px 12px 30px" value="Сохранить">
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection



