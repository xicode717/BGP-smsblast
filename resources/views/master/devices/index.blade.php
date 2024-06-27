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
              <a type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-lg">Tambah</a>
              <!-- <a type="button" class="btn btn-block btn-secondary">Unggah Excel</a> -->
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
                <h3 class="card-title">Master User Devices</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatables" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Phone</th>
                    <th>Token</th>
                    <th>Opsi</th>
                  </tr>
                  </thead>
                  <tbody>
                 
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
            <h4 class="modal-title">Tambah Device</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{ url('/userdevices') }}">
        @csrf
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="phone" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Token</label>
                    <input type="text" name="token" class="form-control" id="token" placeholder="token" required>
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
    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["csv", "excel", "pdf",]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#datatables").DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      buttons: ["csv", "excel", "pdf",],
      ajax: 'datatables/userdevices',
      columns: [
        {data: 'id', name: 'id'},
        {data: 'name', name: 'name'},
        {data: 'phone', name: 'phone'},
        {data: 'token', name: 'token'},
        {data: 'aksi', name: 'aksi'},
      ]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    // $(".edit").on('click','.edit', function(){
    //     let id = $(this).attr('id')
    //     console.log(id)
    // })

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

  // pindah ke halaman edit
  $(document).on('click','.edit', function(){
        let id = $(this).attr('id')
        console.log(id)
        let url = 'userdevices/' + id + '/edit'
        window.location.href = url;
  });

  $(document).on('click','.hapus', function(){
        // variable toast
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
        // end
        let id = $(this).attr('id')
        console.log(id)
        $.ajax({
          url: "{{ route('hapus') }}",
          type: 'post',
          data: {
            id: id,
            "_token": "{{csrf_token()}}",
          },
          success: function(params){
            if(params.status == true){
              Toast.fire({
                icon: 'success',
                title: params.message
              });
              $("#datatables").DataTable().ajax.reload();
            }else{
              Toast.fire({
                icon: 'error',
                title: params.message
              });
              $("#datatables").DataTable().ajax.reload();
            }
            
          }
        })
  });


</script>
  @endsection