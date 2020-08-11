@extends('checklist.lists.show')

@section('tasks_select')
    <div class="card-header">{{ __('Задачи') }}</div>
    <div class="list-group">
        @forelse ($tasks as $task)
            <div class="list-group">
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $task->task }}</h5>
                    </div>
                    <div class="row">

                        <div class="col">
                            <form method="POST" action="../task/{{ $task->id }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" class="btn btn-danger" value="Удалить">
                            </form>
                        </div>

                        <div class="col">
                            <form method="POST" action="../task/{{ $task->id }}">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <input type="submit" class="btn btn-danger" value="Выполнено">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="list-group">
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Список задач пуст</h5>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
@endsection
