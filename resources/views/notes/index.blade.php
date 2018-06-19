@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12">

        <h1> CRUD</h1>
    </div>
</div>

<div class="row">

    <div class="table table-responsive">
        <table class="table table-bordered" id="table">

            <tr>
                <th width="150px">id</th>
                <th>name</th>
                <th>desciription</th>
                <th>due date</th>
                <th>created at</th>
                <th class="text-center" width="150px">
                    <a href="#" class="create-modal btn btn-sucess btn-sm">
                        <i class="fa fa-plus"></i>

                    </a>

                </th>
            </tr>
            {{csrf_field()}}

            @foreach($notes as $key=>$value)
                @if($value->dueDate <$today)


                <tr class="post{{$value->id}} border border-danger">

                    <td>{{$value->id}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->description}}</td>
                    <td>{{$value->dueDate}}</td>
                    <td>{{$value->created_at}}</td>
                    <td width="250px">

                        <a href="{{url('/')}}/addAlt/{{$value->id}}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>img</a>
                        <a href="{{url('/')}}/addFile/{{$value->id}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>file</a>
                        <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}"
                        data-description="{{$value->description}}" data-dueDate="{{$value->dueDate}}"
                        >
                            <i class="fa fa-eye"></i>
                        </a>

                        <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}"
                           data-description="{{$value->description}}" data-dueDate="{{$value->dueDate}}">
                            <i class="fa fa-edit"></i>
                        </a>


                        <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}"
                           data-description="{{$value->description}}" data-dueDate="{{$value->dueDate}}"
                        >
                            <i class="fa fa-trash"></i>
                        </a>

                        <a href="#"><i class="fa fa-warning"></i></a>

                    </td>

                </tr>
                @endif
                    @if($value->dueDate >$today)
                        <tr class="post{{$value->id}} border border-primary">

                            <td>{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td>{{$value->description}}</td>
                            <td>{{$value->dueDate}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>

                                <a href="#" class="btn btn-success btn-sm"><i class="fa fa-plus"></i>img</a>
                                <a href="{{url('/')}}/addFile/{{$value->id}}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>file</a>
                                <a href="#" class="show-modal btn btn-info btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}"
                                   data-description="{{$value->description}}" data-dueDate="{{$value->dueDate}}"
                                >
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="#" class="edit-modal btn btn-warning btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}"
                                   data-description="{{$value->description}}" data-dueDate="{{$value->dueDate}}">
                                    <i class="fa fa-edit"></i>
                                </a>


                                <a href="#" class="delete-modal btn btn-danger btn-sm" data-id="{{$value->id}}" data-name="{{$value->name}}"
                                   data-description="{{$value->description}}" data-dueDate="{{$value->dueDate}}"
                                >
                                    <i class="fa fa-trash"></i>
                                </a>

                                <a href="#"><i class="fa fa-check fa-x"></i></a>

                            </td>

                        </tr>
                    @endif

            @endforeach


        </table>
    </div>
</div>

    {{-- start create post --}}
    <div id="create" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="name" class="control-label col-sm-2">name:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="name here..." required>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="description" class="control-label col-sm-2">description:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="description" name="description" placeholder="description here..." required>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="dueDate" class="control-label col-sm-2">dueDate:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="dueDate" name="dueDate"  required>
                                <p class="error text-center alert alert-danger hidden"></p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" id="add" name="button" class="btn btn-success">add note</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

{{-- end create post --}}


{{-- start show post --}}

<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">ID :</label>
                    <b id="i"/>
                </div>
                <div class="form-group">
                    <label for="">name :</label>
                    <b id="ti"/>
                </div>
                <div class="form-group">
                    <label for="">description :</label>
                    <b id="by"/>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- end show note --}}

<div id="myModal"class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="title">Title</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="t">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"for="body">Body</label>
                        <div class="col-sm-10">
                            <textarea type="name" class="form-control" id="b"></textarea>
                        </div>
                    </div>
                </form>
                {{-- Form Delete Post --}}
                <div class="deleteContent">
                    Are You sure want to delete <span class="title"></span>?
                    <span class="hidden id"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn actionBtn" data-dismiss="modal">
                    <span id="footer_action_button" class="glyphicon"></span>
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="glyphicon glyphicon"></span>close
                </button>
            </div>
        </div>
    </div>
</div>


@endsection