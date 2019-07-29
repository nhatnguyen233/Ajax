@extends('admincp.layout.index')

@section('content')

  <body>
  <div class="container" style="margin-top:20px; margin-left:-15px;">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title" style="position: relative;padding-top: 5px; font-size:30px;">Loại Sản Phẩm</h3>
      </div>
      <div class="panel-body">
        <table class="table table-bordered" id="postTable">
          <a type="submit" id="addType" class="btn btn-success"><span id="" class='glyphicon glyphicon-check'></span> Thêm loại sản phẩm </a>
          <thead>
          <tr>
            <th>Tên loại sp</th>
            <th>Nội dung</th>
            <th>Thương hiệu</th>
            <th>Chỉnh sửa</th>
          </tr>
          </thead>
          <tbody>
          @foreach($type as $loaisp)
          <tr class="item{{ $loaisp->id }}">
            <td>{{ $loaisp->loaisanpham }}</td>
            <td>{{ $loaisp->noidung }}</td>
            <td>{{ $loaisp->thuonghieu }}</td>
            <td>
                  <button data-id="{{ $loaisp->id }}" data-loaisp="{{ $loaisp->loaisanpham }}"  data-thuonghieu="{{ $loaisp->thuonghieu }}" data-noidung="{{ $loaisp->noidung }}" id="edit" class="btn btn-primary"><span class="glyphicon glyphicon-edit"> Sửa </button>
                  <button data-id="{{ $loaisp->id }}" data-loaisp="{{ $loaisp->loaisanpham }}" class="btn btn-danger delete"><span class="glyphicon glyphicon-trash"> Xóa </button>
              </td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div id="addModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Thêm loại sản phẩm</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label class="control-label col-sm-2" for="loaisanpham">Tên loại sp:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="loaisanpham" id="loaisanpham_add">
                <p class="errorName text-center alert alert-danger hidden"></p>
              </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-sm-2">Ảnh:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="anh" id="img_add">
                </div>
            </div> -->
            <div class="form-group">
              <label class="control-label col-sm-2" for="noidung">Nội dung:</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="noidung_add" name="noidung" cols="40" rows="5">{{ old('noidung') }}</textarea>
                <small>Min: 2, Max: 500, only text</small>
                <p class="errorNoidung text-center alert alert-danger hidden"></p>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="thuonghieu">Thương hiệu:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="thuonghieu" id="thuonghieu_add">
                <p class="errorThuonghieu text-center alert alert-danger hidden"></p>
              </div>
            </div>
          </form>
          <div id="validation-errors-create" class="error"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success addType" data-dismiss="modal">
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


  <!-- Edit -->


  <div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Sửa sản phẩm</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form">
            <div class="form-group">
              <label class="control-label col-sm-2" for="loaisanpham">Tên loại sp:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="loaisanpham" id="loaisp_edit">
                <p class="errorName text-center alert alert-danger hidden"></p>
              </div>
            </div>
            <!-- <div class="form-group">
                <label class="control-label col-sm-2">Ảnh:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="anh" id="img_edit">
                </div>
            </div> -->
            <div class="form-group">
              <label class="control-label col-sm-2" for="noidung">Nội dung:</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="noidung_edit" name="noidung" cols="40" rows="5"></textarea>
                <small>Min: 2, Max: 500, only text</small>
                <p class="errorNoidung text-center alert alert-danger hidden"></p>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="thuonghieu">Thương hiệu:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="thuonghieu" id="thuonghieu_edit" value="{{ old('thuonghieu') }}">
                <p class="errorThuonghieu text-center alert alert-danger hidden"></p>
              </div>
            </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary edit" data-dismiss="modal">
              <span id="" class='glyphicon glyphicon-check'></span> Edit
            </button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">
              <span class='glyphicon glyphicon-remove'></span> Close
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Delete -->

  <div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h4 class="modal-title">Xóa loại sản phẩm</h4>
        </div>
        <p>  Bạn có chắc chắn xóa?</p>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary xoa" data-dismiss="modal">
            <span id="" class='glyphicon glyphicon-check'></span> Có
          </button>
          <button type="button" class="btn btn-warning" data-dismiss="modal">
            <span class='glyphicon glyphicon-remove'></span> Không
          </button>
        </div>
      </div>
    </div>
  </div>
  </div>

</body>

@endsection

@section('script')

  <script type="text/javascript" src="{{asset('js/type.js')}}"></script>
  <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <script>
    $(window).load(function(){
      $('#postTable').removeAttr('style');
    })
  </script>

@endsection
