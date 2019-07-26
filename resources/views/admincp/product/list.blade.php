
@extends('admincp.layout.index')

@section('content')
 <!-- Main content -->
 <body>
    <div class="col-md-8 col-md-offset-2">
    <h2 class="text-center">Manage Posts</h2>
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <ul>
                <li><i class="fa fa-file-text-o"></i> All the current Posts</li>
                <button class="btn btn-success add-modal"><li>Add a Post</li></button>
            </ul>
        </div>

        <div class="panel-body">
                <table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
                    <thead>
                        <tr>
                            <th valign="middle">ID</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Đánh giá</th>
                            <th>Giá</th>
                            <!-- <th>Actions</th> -->
                        </tr>
                        {{ csrf_field() }}
                    </thead>
                    <tbody>
                        @foreach($sanpham as $post)
                            <tr class="item{{$post->id}} @if($post->is_published) warning @endif">
                                <td>{{$post->id}}</td>
                                <td>{{$post->name}}</td>
                                <td>
                                    <img width="180px" height="180px" src="{{asset('images').'/'.$post->anh}}">
                                </td>
                                <td class="text-center">{{ $post->danhgia}}</td>
                                <td>{{ $post->gia }}</td>
                                <td>
                                    <button class="show-modal btn btn-success" data-id="{{$post->id}}" data-title="{{$post->name}}">
                                    <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                                    <button class="edit-modal btn btn-info" data-id="{{$post->id}}" data-title="{{$post->name}}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                    <button class="delete-modal btn btn-danger" data-id="{{$post->id}}" data-title="{{$post->name}}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div><!-- /.panel-body -->
    </div><!-- /.panel panel-default -->
</div><!-- /.col-md-8 -->

<!-- Modal form to add a post -->
<div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Title:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title_add" autofocus>
                            <small>Min: 2, Max: 32, only text</small>
                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="content">Content:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="content_add" cols="40" rows="5"></textarea>
                            <small>Min: 2, Max: 128, only text</small>
                            <p class="errorContent text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success add" data-dismiss="modal">
                        <span id="" class='glyphicon glyphicon-check'></span> Add
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to show a post -->
<div id="showModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_show" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Tên:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="title_show" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="anh">Ảnh:</label>
                        <div class="col-sm-10">
                            <input type="anh" class="form-control" id="img_show" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Đánh gía:</label>
                        <div class="col-sm-10">
                            <input type="danhgia" class="form-control" id="danhgia_show" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="content">Content:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="content_show" cols="40" rows="5" disabled></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to edit a form -->
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_edit" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Title:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="title_edit" autofocus>
                            <p class="errorTitle text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="content">Content:</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="content_edit" cols="40" rows="5"></textarea>
                            <p class="errorContent text-center alert alert-danger hidden"></p>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                        <span class='glyphicon glyphicon-check'></span> Edit
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal form to delete a form -->
<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <h3 class="text-center">Are you sure you want to delete the following post?</h3>
                <br />
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="id">ID:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_delete" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="title">Title:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="title_delete" disabled>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                        <span id="" class='glyphicon glyphicon-trash'></span> Delete
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<!-- Bootstrap JavaScript -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

<!-- toastr notifications -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- icheck checkboxes -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

<!-- Delay table load until everything else is loaded -->
<script>
    $(window).load(function(){
        $('#postTable').removeAttr('style');
    })
</script>

<script>
    $(document).ready(function(){
        $('.published').iCheck({
            checkboxClass: 'icheckbox_square-yellow',
            radioClass: 'iradio_square-yellow',
            increaseArea: '20%'
        });
        $('.published').on('ifClicked', function(event){
            id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: "{{ URL::route('changeStatus') }}",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': id
                },
                success: function(data) {
                    // empty
                },
            });
        });
        $('.published').on('ifToggled', function(event) {
            $(this).closest('tr').toggleClass('warning');
        });
    });

</script>

<!-- AJAX CRUD operations -->
<script type="text/javascript">
    // add a new post
    $(document).on('click', '.add-modal', function() {
        $('.modal-title').text('Add');
        $('#addModal').modal('show');
    });
    $('.modal-footer').on('click', '.add', function() {
        $.ajax({
            type: 'POST',
            url: 'posts',
            data: {
                '_token': $('input[name=_token]').val(),
                'title': $('#title_add').val(),
                'content': $('#content_add').val()
                'anh': $('#content_add').val()
            },
            success: function(data) {
                $('.errorTitle').addClass('hidden');
                $('.errorContent').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#addModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                    }, 500);

                    if (data.errors.title) {
                        $('.errorTitle').removeClass('hidden');
                        $('.errorTitle').text(data.errors.title);
                    }
                    if (data.errors.content) {
                        $('.errorContent').removeClass('hidden');
                        $('.errorContent').text(data.errors.content);
                    }
                } else {
                    toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                    $('#postTable').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title + "</td><td>" + data.content + "</td><td class='text-center'><input type='checkbox' class='new_published' data-id='" + data.id + " '></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    $('.new_published').iCheck({
                        checkboxClass: 'icheckbox_square-yellow',
                        radioClass: 'iradio_square-yellow',
                        increaseArea: '20%'
                    });
                    $('.new_published').on('ifToggled', function(event){
                        $(this).closest('tr').toggleClass('warning');
                    });
                    $('.new_published').on('ifChanged', function(event){
                        id = $(this).data('id');
                        $.ajax({
                            type: 'POST',
                            url: "{{ URL::route('changeStatus') }}",
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id': id
                            },
                            success: function(data) {
                                // empty
                            },
                        });
                    });
                }
            },
        });
    });

    // Show a post
    $(document).on('click', '.show-modal', function() {
        $('.modal-title').text('Show');
        $('#id_show').val($(this).data('id'));
        $('#title_show').val($(this).data('title'));
        $('#img_show').val($(this).data('anh'));
        $('#content_show').val($(this).data('content'));
        $('#showModal').modal('show');
    });


    // Edit a post
    $(document).on('click', '.edit-modal', function() {
        $('.modal-title').text('Edit');
        $('#id_edit').val($(this).data('id'));
        $('#title_edit').val($(this).data('title'));
        $('#content_edit').val($(this).data('content'));
        id = $('#id_edit').val();
        $('#editModal').modal('show');
    });
    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'PUT',
            url: 'posts/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id_edit").val(),
                'title': $('#title_edit').val(),
                'content': $('#content_edit').val()
            },
            success: function(data) {
                $('.errorTitle').addClass('hidden');
                $('.errorContent').addClass('hidden');

                if ((data.errors)) {
                    setTimeout(function () {
                        $('#editModal').modal('show');
                        toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                    }, 500);

                    if (data.errors.title) {
                        $('.errorTitle').removeClass('hidden');
                        $('.errorTitle').text(data.errors.title);
                    }
                    if (data.errors.content) {
                        $('.errorContent').removeClass('hidden');
                        $('.errorContent').text(data.errors.content);
                    }
                } else {
                    toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.title + "</td><td>" + data.content + "</td><td class='text-center'><input type='checkbox' class='edit_published' data-id='" + data.id + "'></td><td>Right now</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-title='" + data.title + "' data-content='" + data.content + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                    if (data.is_published) {
                        $('.edit_published').prop('checked', true);
                        $('.edit_published').closest('tr').addClass('warning');
                    }
                    $('.edit_published').iCheck({
                        checkboxClass: 'icheckbox_square-yellow',
                        radioClass: 'iradio_square-yellow',
                        increaseArea: '20%'
                    });
                    $('.edit_published').on('ifToggled', function(event) {
                        $(this).closest('tr').toggleClass('warning');
                    });
                    $('.edit_published').on('ifChanged', function(event){
                        id = $(this).data('id');
                        $.ajax({
                            type: 'POST',
                            url: "{{ URL::route('changeStatus') }}",
                            data: {
                                '_token': $('input[name=_token]').val(),
                                'id': id
                            },
                            success: function(data) {
                                // empty
                            },
                        });
                    });
                }
            }
        });
    });

    // delete a post
    // $(document).on('click', '.delete-modal', function() {
    //     $('.modal-title').text('Delete');
    //     $('#id_delete').val($(this).data('id'));
    //     $('#title_delete').val($(this).data('title'));
    //     $('#deleteModal').modal('show');
    //     id = $('#id_delete').val();
    // });
    $('.modal-footer').on('click', '.delete', function() {
        id = $(this).data('id');
        $.ajax({
            type: 'DELETE',
            url: 'posts/' + id,
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function(data) {
                toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
                $('.item' + data['id']).remove();
            }
        });
    });
</script>
@endsection

