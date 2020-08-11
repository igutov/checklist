@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Категории') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{ Form::open(['route' => ['list.store']]) }}
                        <div class="input-group mb-3">
                            <input type="text" name="name" class="form-control"
                                placeholder="Поле ввода текста новой категории">
                            <button type="submit" class="btn btn-primary">Создать новую категорию</button>
                        </div>
                        {{ Form::close() }}

                        <div class="list-group">
                            @forelse ($lists as $list)

                                <div class="list-group">
                                    <div class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ $list->name }}</h5>
                                        </div>
                                        <div class="row">

                                            <div class="col">
                                                <form method="POST" action="{{ route('list.show', $list->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('GET') }}
                                                    <input type="submit" class="btn btn-outline-info" value="Показать задачи">
                                                </form>
                                            </div>

                                            <div class="col">
                                                <form method="POST" action="{{ route('list.destroy', $list->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <input type="submit" class="btn btn-outline-danger" value="Удалить список">
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Списков нет</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
