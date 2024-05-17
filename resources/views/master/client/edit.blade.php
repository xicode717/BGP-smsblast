@extends('layouts.master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Client</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
            <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ url('master-client', $edit->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="nama" class="form-control" id="nama" value="{{ $edit['nama'] }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{ $edit['email'] }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="number" name="phone" class="form-control" id="phone" value="{{ $edit['phone'] }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" value="{{ $edit['tgl_lahir'] }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Gender</label>
                        <select name="gender" class="form-control" id="gender">
                            <option value="{{ $edit['gender']}}"> {{ $edit['gender']}}</option>
                            <option value="laki-laki">Laki-Laki</option>
                            <option value="perempuan">Perempuan </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Alamat</label>
                        <Textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Enter ..."> {{$edit['alamat']}} </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="{{ $edit['status'] }}"> {{ $edit['status'] == 1 ? 'Aktif' : 'Tidak Aktif'}}</option>
                            <option value="1">Aktif</option>
                            <option value="0"> Tidak Aktif </option>
                        </select>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="modal-footer justify-content-between">
                    <a href="{{ url('/master-client') }}" class="btn btn-default" data-dismiss="modal">Back</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            </div>
        </div>
       </div>
    </section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection

  @section('script')
  <script>
  
</script>
  @endsection