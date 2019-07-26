@extends('admincp.layout.index')

@section('content')
  <body>
    <div class="container" style="margin-top:20px">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Sửa sản phẩm</h3>
        </div>
        <div class="panel-body">
          <!-- <div class="alert alert-danger" role="alert">
            <ul>
              <li>Enter a valid email address</li>
              <li>Enter a valid email address</li>
              <li>Enter a valid email address</li>
              <li>Enter a valid email address</li>
            </ul>
          </div> -->
          @if(session('success'))
          <script>
              alert('{{ session('success') }}');

          </script>
          @endif
          <form method="POST" action="{{url('admincp/sanpham/sua').'/'.$sanpham->id}}" name="frmAdd">
            <input type="hidden" name="_token" value="{!! csrf_token() !!}"/> 
            <div class="form-group">
              <label for="lblTen">Tên sản phẩm</label>
              <input type="text" class="form-control" name="name" value="{!! old('name', isset($sanpham) ? $sanpham['name'] : null ) !!}"/>
            </div>
            <div class="form-group">
              <label for="lblToan">Ảnh</label>
              <input name="anh" id="image" class="form-control" type="file">
            </div>
            <div class="form-group">
              <label for="lblLy">Đánh giá</label>
              <input type="text" class="form-control" name="danhgia" />
            </div>
            <div class="form-group">
              <label for="lblHoa">Giá</label>
              <input type="text" class="form-control" name="gia" />
            </div>
            <button type="submit" class="btn btn-default">Sửa</button>
          </form>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
@endsection