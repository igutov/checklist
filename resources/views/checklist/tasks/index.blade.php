@extends('layouts.app')
{{-- @extends('select') --}}

@section('content')
    {{-- @section('tasks_input') --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Создание новой задачи') }}</div>
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

                        {{ Form::open(['route' => ['task.store']]) }}
                        <div class="input-group mb-3">
                            <select class="custom-select col" id="inlineFormCustomSelectPref" name="list_id">
                                @forelse ($lists as $list)
                                    <option value="{{ $list->id }}">
                                        {{ $list->name }}
                                    </option>
                                @empty
                                    <option value="">
                                        Списков нет
                                    </option>
                                @endforelse
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" name="task" class="form-control"
                                placeholder="Поле ввода текста новой задачи">
                            <button type="submit" class="btn btn-primary">Сохранить задачу</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
