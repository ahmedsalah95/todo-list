@extends('layouts.app')
@section('content')







        <div class="col-lg-6 col-md-6 col-sm-12">



            {!! Form::open(['url'=>'/submitAlt','method'=>'post','enctype'=>'multipart/form-data']) !!}
            {{csrf_field()}}
            <div class="form-group">
                <label for="note_id">note id</label>
                <input type="hidden" class="form-control" id="note_id"  name="note_id" value="{{$id}}">

            </div>


            <div class="form-group">
                <label for="status"> image status </label>
                <input type="text" class="form-control" id="status"  name="status" value="0">

            </div>

            <div class="form-group">

                <input type="file" name="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

            {!! Form::close() !!}




        </div>



        <div class="content-box-large col-lg-6 col-md-6 col-sm-12">
            <h2 class="text-center">note images</h2>
            <div class="table table-responsive">
                <table class=" table table-bordered">

                    <?php

                    $images = \App\Image::where('note_id',$id)->get();
                    ?>

                    <tr>
                        <td>id</td>
                        <td>status</td>
                        <td>img</td>

                    </tr>

                        @if(count($images)!=0)
                            @foreach($images as $image)

                                <tr>
                                    <td>{{$image->id}}</td>
                                    <td>{{$image->status}}</td>
                                    <td><img src="{{\Illuminate\Support\Facades\Config::get('app.url')}}/list/public/img/alt_images/{{$image->img}} " alt="test" width="100" height="100"></td>

                                </tr>

                            @endforeach
                        @endif



                </table>

            </div>

        </div>






@endsection