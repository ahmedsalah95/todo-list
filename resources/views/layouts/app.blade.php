<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <div class="container">

        @yield('content')

    </div>


    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

{{-- ajax code to run modal --}}

    <script type="text/javascript">
        $(document).on('click','.create-modal',function(){
            $('#create').modal('show');
            $('.form-horizontal').show();
            $('.modal-name').text('add note');
        });

        ///

        $('#add').click(function(){

            $.ajax({

                type : 'POST',
                url  : 'addNote',
                data : {

                    '_token':$('input[name=_token]').val(),
                    'name':$('input[name=name]').val(),
                    'description':$('input[name=description]').val(),
                    'dueDate':$('input[name=dueDate]').val(),
                },
                success : function(data)
                {
                    if((data.errors)){
                        $('.error').removeClass('hidden');
                        $('.error').text(data.errors.name);
                        $('.error').text(data.errors.description);

                    }else
                    {
                        $('.error').remove();
                        $('#table').append("<tr class='post"+data.id + "'>"+
                                "<td>"+data.id+"</td>"+
                                "<td>"+data.name+"</td>"+
                                "<td>"+data.description+"</td>"+
                                "<td>"+data.dueDate+"</td>"+
                                "<td>"+data.created_at+"</td>"+
                                "<td>" +

                                "<a class='show-modal btn btn-info btn-sm' data-id='"+ data.id + "' data-name='"+data.name+"' data-description='"+data.description+"'>"+
                                "<i class='fa fa-eye'></i></a>"+

                                "<a class='edit-modal btn btn-warning btn-sm' data-id='"+ data.id + "' data-name='"+data.name+"' data-description='"+data.description+"'>"+
                                "<i class='fa fa-edit'></i></a>"+

                                "<a class='delete-modal btn btn-danger btn-sm' data-id='"+ data.id + "' data-name='"+data.name+"' data-description='"+data.description+"'>"+
                                "<i class='fa fa-trash'></i></a>"+

                                +"</td>"


                                +"</tr>");
                    }
                }

            });
            $('#name').val('');
            $('#description').val('');


        });

        // show function


        $(document).on('click', '.show-modal', function() {
            $('#show').modal('show');
            $('#i').text($(this).data('id'));
            $('#ti').text($(this).data('name'));
            $('#by').text($(this).data('description'));
            $('.modal-title').text('Show Post');
        });


        // edit function


        $(document).on('click', '.edit-modal', function() {
            $('#footer_action_button').text(" Update Post");
            $('#footer_action_button').addClass('glyphicon-check');
            $('#footer_action_button').removeClass('glyphicon-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('edit');
            $('.modal-title').text('Post Edit');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('#fid').val($(this).data('id'));
            $('#t').val($(this).data('name'));
            $('#b').val($(this).data('description'));
            $('#myModal').modal('show');
        });

        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'POST',
                url: 'editNote',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#fid").val(),
                    'name': $('#t').val(),
                    'description': $('#b').val()
                },
                success: function(data) {
                    $('.post' + data.id).replaceWith(" "+
                        "<tr class='post" + data.id + "'>"+
                        "<td>" + data.id + "</td>"+
                        "<td>" + data.name + "</td>"+
                        "<td>" + data.description + "</td>"+
                        "<td>" + data.created_at + "</td>"+
                        "<td><button class='show-modal btn btn-info btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-description='" + data.description + "'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-description='" + data.description + "'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id='" + data.id + "' data-name='" + data.name + "' data-description='" + data.description + "'><span class='glyphicon glyphicon-trash'></span></button></td>"+
                        "</tr>");
                }
            });
        });


        // delete function


        $(document).on('click', '.delete-modal', function() {
            $('#footer_action_button').text(" Delete");
            $('#footer_action_button').removeClass('glyphicon-check');
            $('#footer_action_button').addClass('glyphicon-trash');
            $('.actionBtn').removeClass('btn-success');
            $('.actionBtn').addClass('btn-danger');
            $('.actionBtn').addClass('delete');
            $('.modal-title').text('Delete Post');
            $('.id').text($(this).data('id'));
            $('.deleteContent').show();
            $('.form-horizontal').hide();
            $('.name').html($(this).data('name'));
            $('#myModal').modal('show');
        });

        $('.modal-footer').on('click', '.delete', function(){
            $.ajax({
                type: 'POST',
                url: 'deleteNote',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $('.id').text()
                },
                success: function(data){
                    $('.post' + $('.id').text()).remove();
                }
            });
        });



    </script>
</body>
</html>
