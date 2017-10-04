@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Index</div>
                    <div class="panel-body">
                        <div class="col-md-12">
                            @if($products)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Images</th>
                                        <th>Description</th>
                                        <th>actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                @if($product->photo)
                                                    <img class="src-photo" src="{!! $product->getPhoto() !!}"  style="width:100px;"/>
                                                @endif

                                            </td>
                                            <td>
                                                id: {!! $product->id !!}
                                                <br/>
                                                Название: {!! $product->name !!}
                                                <br/>
                                                Описание: {!! $product->description !!}
                                                <br/>
                                                Описание короткое: {!! $product->short_description !!}
                                                <br/>

                                            </td>
                                            <td>
                                                @can('edit', $product)
                                                    <a href="{!! route('products.edit', $product->id) !!}" class="btn btn-info">Редактировать</a>
                                                    {{ Form::open(['route' => ['products.delete', $product->id], 'method' => 'delete']) }}
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    {{ Form::close() }}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif


                            @if($categories)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>description</th>
                                        <th>actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{!! $category->id !!}</td>
                                            <td>
                                                Название: {!! $category->name !!}
                                                <br/>
                                                Описание: {!! $category->description !!}
                                                <br/>
                                            </td>
                                            <td>
                                                @can('edit', $category)
                                                    <a href="{!! route('categories.edit', $category->id) !!}" class="btn btn-info">Редактировать</a>
                                                    {{ Form::open(['route' => ['categories.delete', $category->id], 'method' => 'delete']) }}
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    {{ Form::close() }}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                            @if(\Auth::user())
                                <a href="{!! route('categories.create') !!}" class="btn btn-default">Добавить категорию</a>
                                <a href="{!! route('products.create') !!}" class="btn btn-default">Добавить товар</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection