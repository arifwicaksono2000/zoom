@extends('pages.template')

@section('content')
@if ($is_error == true)
<div class="mb-3">
    <div class="alert alert-danger" role="alert">
        Terdapat API yang galat saat mengambil data
        <ul class="mt-2">
            @forelse ($err_api as $err)
            <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<div class="row">
    <div class="mb-3">
        <h3>Laporan per <b>{{ date('d/m/Y H:i:s') }}</b></h3>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="avatar-sm font-size-20 me-3">
                        <span class="avatar-title bg-soft-primary text-primary rounded">
                            <i class="mdi mdi-tag-plus-outline"></i>
                        </span>
                    </div>
                    <div class="flex-1">
                        <div class="font-size-16 mt-2">Total Fail Insert Care</div>
                    </div>
                </div>
                <h3 class="mt-4">{{ $insertCare }}</h3>
                <div class="row">
                    <div class="col-7"></div>
                    <div class="col-5 align-self-center">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="avatar-sm font-size-20 me-3">
                        <span class="avatar-title bg-soft-primary text-primary rounded">
                            <i class="mdi mdi-tag-plus-outline"></i>
                        </span>
                    </div>
                    <div class="flex-1">
                        <div class="font-size-16 mt-2">Total Fail Create Sertifikat</div>
                    </div>
                </div>
                <h3 class="mt-4">{{ $createCertif }}</h3>
                <div class="row">
                    <div class="col-7"></div>
                    <div class="col-5 align-self-center">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start">
                    <div class="avatar-sm font-size-20 me-3">
                        <span class="avatar-title bg-soft-primary text-primary rounded">
                            <i class="mdi mdi-tag-plus-outline"></i>
                        </span>
                    </div>
                    <div class="flex-1">
                        <div class="font-size-16 mt-2">Total Fail Kirim Email</div>
                    </div>
                </div>
                <h3 class="mt-4">{{ $sendCertif }}</h3>
                <div class="row">
                    <div class="col-7"></div>
                    <div class="col-5 align-self-center">
                        <div class="progress progress-sm">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Error Report</h4>

                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th><b>Nama</b></th>
                            <th><b>Gagal Insert Care</b></th>
                            <th><b>Gagal Create Sertif</b></th>
                            <th><b>Gagal Kirim Email</b></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($apiList as $val)
                        <tr>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->insertCare }}</td>
                            <td>{{ $val->createCertif }}</td>
                            <td>{{ $val->sendCertif }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
@endsection

@section('style')
<link href="{{ url('assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="{{ url('assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('script')
<script src="{{ url('assets') }}/js/pages/datatables.init.js"></script>
<script src="{{ url('assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ url('assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        setInterval(function() {
            location.reload();
        }, 60000); // 300000 milliseconds = 5 minutes
        // 60000 miliseconds = 1 minute
    });
</script>
@endsection