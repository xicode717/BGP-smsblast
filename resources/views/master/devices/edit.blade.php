@extends('layouts.master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Devices Gateway</h1>
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
              <form method="post" action="{{ url('userdevices', $edit->id) }}" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control" id="name" value="{{ $edit['name'] }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="number" name="phone" class="form-control" id="phone" value="{{ $edit['phone'] }}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Token</label>
                        <input type="text" name="token" class="form-control" id="token" value="{{ $edit['token'] }}">
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