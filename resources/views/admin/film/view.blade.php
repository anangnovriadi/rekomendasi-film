@extends('admin.layout.app')

@section('pageTitle', 'Film')

@section('content')

<div id="main-wrapper">
    @include('admin.layout.header')
    @include('admin.layout.sidebar')
    <div class="page-wrapper">
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">Data Film</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Data Film</li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Film</h4>
                            <div class="pt-2">
                                <a href="{{ route('add.film') }}">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data Film</button>
                                </a>
                            </div>
                            <div class="table-responsive m-t-10">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Nama Film</th>
                                            <th>Genre</th>
                                            <th>Aktor/Aktris</th>
                                            <th>Tahun</th>
                                            <th>Produksi</th>
                                            <th>Negara</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($film as $films)
                                        <tr>
                                            <td>{{ $films->nama_film }}</td>
                                            <td>{{ $films->genre }}</td>
                                            <td>{{ $films->aktor_aktris }}</td>
                                            <td>{{ $films->tahun }}</td>
                                            <td>{{ $films->produksi }}</td>
                                            <td>{{ $films->negara }}</td>
                                            <td>{{ $films->deskripsi_film }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.footer')
    </div>
</div>

@section('add_js')

<script src="{{ asset('admin/plugins/html5-editor/wysihtml5-0.3.0.js') }}"></script>
<script src="{{ asset('admin/plugins/html5-editor/bootstrap-wysihtml5.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
        });
    });
</script>
@endsection

@endsection