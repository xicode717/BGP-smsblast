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
              <a type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-lg">Add</a>
              <a type="button" class="btn btn-block btn-secondary">Upload Excel</a>
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
                <h3 class="card-title">Master Client</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Tgl Lahir</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php 
                    $i=1;
                    @endphp
                    @foreach($client as $v)
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $v->nama}}</td>
                    <td>{{$v->email}}</td>
                    <td>{{$v->phone}}</td>
                    <td> {{$v->gender}} </td>
                    <td>{{$v->tgl_lahir}}</td>
                    <td>
                    <div class="btn-group-vertical">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          </button>
                          <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="{{ url('master-client/'.$v->id.'/edit') }}">Edit</a></li>

                            <form method="post" action="{{ url('master-client', $v->id) }}">
                                @csrf
                                @method('delete')
                                <li><button type="submit" class="dropdown-item">Hapus</button></li>
                            </form>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @php
                    $i++;
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
            <h4 class="modal-title">Tambah Client</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{ url('/master-client') }}">
        @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="phone" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Gender</label>
                    <select name="gender" class="form-control" id="gender">
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" id="tgl_lahir" placeholder="Tanggal Lahir" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Alamat</label>
                    <Textarea type="text" name="alamat" class="form-control" id="alamat" placeholder="Enter ..."> </textarea>
                </div>
            </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["csv", "excel", "pdf",]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
  @endsection