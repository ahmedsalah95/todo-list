@extends('layouts.app')
@section('content')


    <div class="col-lg-6 col-md-6 col-sm-12">



        {!! Form::open(['url'=>'/submitFile','method'=>'post','enctype'=>'multipart/form-data']) !!}
        {{csrf_field()}}
        <div class="form-group">
            <label for="note_id">note id</label>
            <input type="hidden" class="form-control" id="note_id"  name="note_id" value="{{$id}}">

        </div>


        <div class="form-group">
            <label for="status"> file status </label>
            <input type="text" class="form-control" id="status"  name="status" value="0">

        </div>

        <div class="form-group">

            <input type="file" name="file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

        {!! Form::close() !!}




    </div>


    <div class="content-box-large col-lg-6 col-md-6 col-sm-12">

        <h2 class="text-center">note files</h2>

        <div class="table table-responsive">
            <table class=" table table-bordered">

                <?php

                    $files = \App\File::where('note_id',$id)->get();

                ?>
                <tr>
                    <td>id</td>
                    <td>status</td>
                    <td>file</td>

                </tr>

                    @if(count($files)!=0)
                        @foreach($files as $file)
                        <tr>
                            <td>{{$file->id}}</td>
                            <td>{{$file->status}}</td>
                            <td>{{$file->file}}</td>

                        </tr>
                        @endforeach
                    @endif



            </table>
        </div>
    </div>



@endsection