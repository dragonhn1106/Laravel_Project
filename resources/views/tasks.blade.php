{{--Thừa kế app.blade template --}}
@extends('layouts.app')
{{--Nội dung của trang content--}}
@section('content')
    <div class="panel-body">
        <form action="{{url('tasks')}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>
                <div class="scol-ms-6">
                    <input type="text" name="title" id="task-name" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">Save</button>
                </div>
            </div>
        </form>
        @if(count($tasks)>0)
            <div>
                <table class="panel-body">
                    <thead>
                    <td>&nbsp;</td>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                <div>

                                    <form action="/tasks/{{$task->id}}" method="post">
                                        <input type="text" name="title" value="{{$task->title}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <button>Update</button>
                                        <input type="hidden" name="_method" value="PUT">
                                    </form>
                                </div>
                            </td>
                            <td>
                                <form action="/tasks/{{$task->id}}" method="post">
                                    {{ csrf_field() }}
                                    {{ csrf_field('DELETE') }}
                                    <button>Xóa Task</button>
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection