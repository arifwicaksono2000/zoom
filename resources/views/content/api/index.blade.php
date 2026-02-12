@extends('pages.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Master API</h4>
                        <p class="card-title-desc">Berikut merupakan list data master jenis API.</p>
                    </div>
                </div>

                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>URL</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                     
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
<!-- DataTables -->
<link href="{{ url('assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<script src="{{ url('assets') }}/js/pages/datatables.init.js"></script>
<script src="{{ url('assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<script>
    function deleteRow(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan hilang dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url('api/destroy') }}" + "/" + id;
            }
        })
    }
</script>
@endsection