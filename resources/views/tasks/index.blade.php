@extends('layouts/app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            New tasks
        </div>
        <div class="panel-body">
            @include('common.errors')
            <form action="{{ url('task') }}" method="post" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Task</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-plus-sign"></span>
                            Add task
                        </button>
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    @if ($tasks->count())
        <div class="panel panel-default">
            <div class="panel-heading">
                Current tasks [{{count($tasks)}}]
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <th>Task</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        @if(!$task->done)
                            <tr>
                                <td>{{$task->name}}</td>
                                <td class="col-md-3">
                                    <form action="{{ url('task/' . $task->id) }}" method="post">
                                        <button type="submit" class="btn btn-danger"><span
                                                    class="glyphicon glyphicon-trash"></span></button>
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                    </form>
                                    <br>
                                    <form action="{{ url('task/' . $task->id) }}" method="post">
                                        <button type="submit" class="btn btn-success">
                                            <span class="glyphicon glyphicon-ok"></span></button>
                                        {{ method_field('PATCH') }}
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if ($tasks->count())
        <div class="panel panel-default">
            <div class="panel-heading">
                Done tasks
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <th>Task</th>
                    <th>&nbsp;</th>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        @if($task->done)
                            <tr>
                                <td>{{$task->name}}</td>
                                <td class="col-md-3">
                                    <form action="{{ url('task/' . $task->id) }}" method="post">
                                        <button type="submit" class="btn btn-danger"><span
                                                    class="glyphicon glyphicon-trash"></span></button>
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                    </form>
                                    <br>
                                    <form action="{{ url('task/undo/' . $task->id) }}" method="post">
                                        <button type="submit" class="btn btn-success"><span
                                                    class="glyphicon glyphicon-sort"></span></button>
                                        {{ method_field('PATCH') }}
                                        {{ csrf_field() }}
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection