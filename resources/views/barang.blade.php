<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Data Tables</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/_all-skins.min.css')}}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<script type="text/javascript">
  function hanyaAngka(evt) {
    var charCode = (evt.which)?evt.which:event.keyCode
     if (charCode>31&&(charCode<48||charCode>57))

      return false;
    return true;
  }
</script>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
  </header>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
     <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="{{route('logout')}}"  onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
             <span>Logout</span>
            
          </a>
        </li>
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Barang
      </h1>
      <ol class="breadcrumb">
        <li><a href="#">3 Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data Barang</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Barang</h3>
              <div class="pull-right">
                  <button class="btn btn-success" id="btn-tambah"> Tambah data</button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                
                <thead>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Stok</th>
                  @if($part==='owner'||$part==='admin')
                  <th>Harga Jual</th>
                  @endif
                  @if($part==='owner')
                  <th>Harga Beli</th>
                  @endif
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $barang)
                    <tr>
                        <td>{{$barang->kode_barang}}</td>
                        <td>{{$barang->nama_barang}}</td>
                        <td>{{$barang->stok}}</td>
                        @if($part==='owner'||$part==='admin')
                        <td>{{$barang->harga_jual}}</td>
                        @endif
                         @if($part==='owner')
                        <td>{{$barang->harga_beli}}</td>
                        @endif
                        <td>
                          <button class="btn btn-warning btn-sm btnedit"  onclick="edit_barang({{$barang->id}}) ">Edit</button>
                          <a href='{{url("$part/barang/hapus/$barang->id")}}' onclick="return confirm('yakin ingin menghapus data ini')" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Kode Barang</th>
                  <th>Nama Barang</th>
                  <th>Stok</th>
                   @if($part==='owner'||$part==='admin')
                  <th>Harga Jual</th>
                  @endif
                  @if($part==='owner')
                  <th>Harga Beli</th>
                  @endif
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <div class="text-center">
            {{ $barangs->links() }}   
          </div>
           
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

    <div class="control-sidebar-bg"></div>
</div>
<div class="modal fade" id="tambah">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Barang</h4>
              </div>
          <form action='{{url("$part/barang/proses")}}' method="post" id="form">
              <div class="modal-body">
                <div class="form-group">
                  <label for="nama_barang">Nama Barang</label>
                  <input type="hidden" name="idbarang" id="idbarang">
                   @csrf
                  <input type="text" required="" name="nama_barang" id="nama_barang" class="form-control" >
                </div>
                <div class="form-group">
                  <label for="stok">Stok</label>
                  <input type="text" required="" name="stok" id="stok" class="form-control"  onkeypress="return hanyaAngka(event)" >
                </div>
                <div class="form-group">
                  <label for="harga_jual">Harga Jual</label>
                  <input type="text" required="" name="harga_jual" id="harga_jual" class="form-control"  onkeypress="return hanyaAngka(event)" >
                </div>
                <div class="form-group">
                  <label for="harga_beli">Harga Beli</label>
                  <input type="text" required="" name="harga_beli" id="harga_beli" class="form-control"  onkeypress="return hanyaAngka(event)" >
                </div>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="simpan" name="simpan" class="btn btn-primary">Simpan</button>
                <button type="submit" id="proses" style="display: none;"></button>
              </div>
              </form>
            </div>
          </div>
  </div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
    @if(Session::has('sukses'))
    toastr.success("{{Session::get('sukses')}}", "sukses ")
    @endif
     function edit_barang(id)
      {
         $('#form')[0].reset();
            $.ajax({
                url: `{{url("$part/barang")}}/` + id,
                type: 'GET',
                dataType: "JSON",
                success: function(data) {
                    $('#idbarang').val(id);
                    $('#nama_barang').val(data.nama_barang);
                    $('#stok').val(data.stok);
                    $('#harga_jual').val(data.harga_jual);
                    $('#harga_beli').val(data.harga_beli);
                    $('#tambah').modal('show');
                    $('.modal-title').text('Edit Barang');
                }
            });
      }
    $(document).ready(function(){
     $('#simpan').on('click',function(e){
        let harga_jual=$('#harga_jual').val();
        let harga_beli=$('#harga_beli').val();
        if (harga_jual<=harga_beli) {
          Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Mohon Harga Jual Tidak Boleh kurang dari Harga Beli !',
                  });
        }
        else{
         $('#proses').trigger('click');
        }
     });

      $('#btn-tambah').on('click',function(){
        $('#form')[0].reset();
        $('.modal-title').text('tambah barang');
        $('#tambah').modal('show');
      });
    });
</script>
</body>
</html>

