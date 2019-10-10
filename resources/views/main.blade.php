@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.result_messages')
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <a class="btn btn-success" href="{{ route('urls.create') }}">Добавить новый URL</a>
                    </div>
                </div>

                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover" >
                            <thead>
                            <tr>
                                <th width="30%">Длинный URL</th>
                                <th>Сокращенный URL</th>
                                <th>Дата создания</th>
                                <th>Кол-во переходов</th>
                                <th>Изменить</th>
                                <th>Удалить</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->origin }}</td>
                                    <td><a href="{{ $item->shortened }}">{{ $item->shortened }}</a></td>
                                    <td>{{ $item->created_at->format('d.m.Y') }}</td>
                                    <td>{{ $item->counter }}</td>
                                    <td>
                                        <form action="{{ route('urls.edit', $item->id) }}" method="get">
                                            <input class="btn btn-info" type="submit" value="Изменить" />
                                            @csrf
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('urls.destroy', $item->id) }}" method="post">
                                            <input class="btn btn-danger" type="submit" value="Удалить" />
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection