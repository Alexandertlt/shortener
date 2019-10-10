@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.result_messages')
        <form method="POST" action="{{ route('urls.store') }}">
            @csrf
            <div class="row justify-content-center">



                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="origin">Длинный URL</label>
                                <input type="text" id="origin" name = "origin" class="form-control">
                            </div>

                            <label for="path">Сокращенный URL</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="url-domain">{{ $urlDomain }}</span>
                                </div>
                                <input type="text" value="{{ $urlPath }}" class="form-control" id="path" name="path" aria-describedby="url-domain">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Добавить</button>
                                <a type="button" href="{{ route('urls.index') }}" class="btn btn-light">Назад</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection