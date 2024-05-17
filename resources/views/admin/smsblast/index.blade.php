@extends('layouts.master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SMS BLAST</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li> -->
              <a href="{{ url('send/sendsmsview') }}" class="btn btn-block btn-primary">Send Sms</a>
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
                <h3 class="card-title">List Blast</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Phone</th>
                    <th>Pesan</th>
                    <th>Tgl Kirim</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @php 
                    $no=1;
                    @endphp
                    @foreach($list as $v)
                  <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $v->nama}}</td>
                    <td>{{$v->phone}}</td>
                    <td>{{$v->pesan}}</td>
                    <td>{{ $v->tgl_kirim }}</td>
                    <td>
                    <div class="btn-group-vertical">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                          </button>
                          <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="{{ url('smsblast/'.$v->id.'/edit') }}">Edit</a></li>

                            <form method="post" action="{{ url('smsblast', $v->id) }}">
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