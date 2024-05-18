@extends('layouts.master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li> -->
              <!-- <a href="{{ url('') }}" class="btn btn-block btn-primary">Send Sms</a> -->
              <a type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-lg">Tambah</a>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Pengguna</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Akses</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php 
                    $no=1;
                    @endphp
                    @foreach($user as $v)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $v->name}}</td>
                    <td>{{$v->email}}</td>
                    <td>{{$v->akses == 1 ? 'Admin' : 'User'}}</td>
                    <td>
                    <div class="btn-group-vertical">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          </button>
                          <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="{{ url('users/'.$v->id.'/edit') }}">Edit</a></li>
                            <!-- <form method="post" action="{{ url('smsblast/resend', $v->id) }}">
                                @csrf
                                <li><button type="submit" class="dropdown-item">Resend</button></li>
                            </form> -->
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @php
                    $no++;
                    @endphp
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Form User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{ url('/users') }}">
        @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="password" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Akses</label>
                    <select name="akses" class="form-control" id="akses">
                        <option value="2">User</option>
                        <option value="1">Administrator </option>
                    </select>
                </div>
            </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        </div>
        </form>
        <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
   </div>
      <!-- /.modal -->

  @endsection

  @section('script')
  <script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf",]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
  @endsection