@extends('layouts.master')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>SEND SMS</h1>
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
          <div class="col-12">
            <!-- /.card -->

                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">Pilih Nomor</h3>

                        <div class="card-tools">
                        
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <form method="post" action="{{ url('/smsblast') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                            <label>Multiple</label>
                            <select class="duallistbox" multiple="multiple" name="id[]">
                                @foreach($list as $v)
                                <option value="{{ $v->id }}">{{$v->phone}} - {{$v->nama}}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="form-group">
                                <label>Pesan</label>
                                <textarea class="form-control" name="pesan" rows="3" placeholder="Tulis Pesan ..."></textarea>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{url('smsblast')}}" class="btn btn-default" data-dismiss="modal">Kembali</a>
                        <button type="submit" class="btn btn-primary float-right">Kirim</button>
                    </div>
                    </form>
                </div>
    
          </div>
        </div>
       </div>
    </section>

</div>

@endsection

  @section('script')
    <script>
        $(function () {
            //Bootstrap Duallistbox
            $('.duallistbox').bootstrapDualListbox()
        })
    </script>
  @endsection