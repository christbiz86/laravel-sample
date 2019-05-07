@extends('layout.layout')

@section('content')
    <h1>Edit Task</h1>
    <hr>
     <form action="{{url('tasks', [$task->id])}}" method="POST">
     <input type="hidden" name="_method" value="PUT">
     {{ csrf_field() }}
      <div class="form-group">
        <label for="title">Task Title</label>
        <input type="text" value="{{$task->title}}" class="form-control" id="taskTitle"  name="title" >
      </div>
      <div class="form-group">
        <label for="description">Task Description</label>
        <input type="text" value="{{$task->description}}" class="form-control" id="taskDescription" name="description" >
      </div>
     <div class="form-group">
        <label for="gender">Gender</label>
        <input type="radio" value="male" {{if($task->gender == 'male') }}selected{{/endif}}   class="form-control" id="taskGender" name="gender">Male&nbsp;&nbsp;&nbsp;
        <input type="radio" value="female" {{if($task->gender == 'female') }}selected{{/endif}} class="form-control" id="taskGender" name="gender">Female
      </div>
     <div class="form-group">
        <label for="gender">Education</label>
        <select name="education">
            <option value="{{$task->education}}">{{$task->education}}</option>
            <option value="S1">S1</option>
            <option value="S2">S2</option>
            <option value="S3">S3</option>
        </select>
      </div>
     <div class="form-group">
         <label for="tentacles">Favorite Number(1-100):</label>
         <input type="number" id="favoriteNumber" value="{{$task->favorite}}" name="favorite" min="1" max="100">
     </div>
     <div>
         <label for='dateRange'>Date Range</label>
        <input type="text" name="daterange" value="{{$task->daterange}}" />

        <script>
        $(function() {
          $('input[name="daterange"]').daterangepicker({
            opens: 'left'
          }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
          });
        });
        </script>
     </div>
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection