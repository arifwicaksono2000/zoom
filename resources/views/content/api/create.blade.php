@extends('pages.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Api</h4>
                <br>
                <form id="form-validation" action="{{ route('api.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="name">Nama Proyek :</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" maxlength="255" required>
                        @error('name')
                        <div class="text-danger">
                            {{ $message }}.
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="url">URL :</label>
                        <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}" required>
                        @error('url')
                        <div class="text-danger">
                            {{ $message }}.
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="secret_key">Secret Key :</label>
                        <input type="text" class="form-control @error('secret_key') is-invalid @enderror" id="secret_key" name="secret_key" value="{{ old('secret_key') }}" required>
                        @error('secret_key')
                        <div class="text-danger">
                            {{ $message }}.
                        </div>
                        @enderror
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('style')
@endsection

@section('script')
@endsection