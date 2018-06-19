@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <h2 class="text-center"><i class="btn btn btn-success"><a href="{{url('notes')}}" style="color: white;">go to notes</a></i></h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
