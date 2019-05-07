@extends('layout.layout')

@section('content')
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        
        <button id="reload">Reload Data</button>
        <br>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>

        <div id="container"></div>
        <br>
        
        
        <table class="table" id="table">
          <thead class="thead-dark">
            <tr>
              <th class="text-center" scope="col">#</th>
              <th class="text-center" scope="col">Task Title</th>
              <th class="text-center" scope="col">Task Description</th>
              <th class="text-center" scope="col">Gender</th>
              <th class="text-center" scope="col">Education</th>
              <th class="text-center" scope="col">Date Range</th>
              <th class="text-center" scope="col">Created At</th>
              <th class="text-center" scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tasks as $task)
            <tr>
              <th scope="row">{{$task->id}}</th>
              <td><a href="/tasks/{{$task->id}}">{{$task->title}}</a></td>
              <td>{{$task->description}}</td>
              <td>{{$task->gender}}</td>
              <td>{{$task->education}}</td>
              <td>{{$task->daterange}}</td>
              <td>{{$task->created_at->toFormattedDateString()}}</td>
              <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <a href="{{ URL::to('tasks/' . $task->id . '/edit') }}">
                  	<button type="button" class="btn btn-warning">Edit</button>
                  </a>&nbsp;
                  <form action="{{url('tasks', [$task->id])}}" method="POST">
    					<input type="hidden" name="_method" value="DELETE">
   						<input type="hidden" name="_token" value="{{ csrf_token() }}">
   						<input type="submit" class="btn btn-danger" value="Delete"/>
   				  </form>
              </div>
			</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <script>
            $(document).ready(function() {
              $('#table').DataTable();
          } );
        </script>
@endsection