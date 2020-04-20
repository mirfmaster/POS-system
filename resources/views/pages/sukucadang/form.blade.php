@extends('layouts.app', [
'elementActive' => 'sukucadang'
])


@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ isset($data->id) ? 'Edit' : 'Tambah'}} Suku Cadang</h3>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <?php
                    $url = isset($data->id) ? route('sukucadang.update', $data->id) : route('sukucadang.store');
                    ?>
                    <form method="POST" action="{{ $url }}">
                        @csrf
                        @if(isset($data->id))
                        @method('patch')
                        @endif
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" value="{{ $data->nama }}">
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <input type="text" name="jenis" class="form-control" placeholder="Masukan Jenis Suku Cadang" value="{{ $data->jenis }}">
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" min="0" name="jumlah" class="form-control" placeholder="Masukan Jumlah" value="{{ $data->jumlah }}">
                        </div>
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" class="form-control" placeholder="Masukan Satuan" value="{{ $data->satuan }}">
                        </div>
                        <div class="form-group">
                            <label>Harga Jual</label>
                            <input type="number" name="harga_jual" class="form-control" placeholder="Masukan Harga Jual" value="{{ $data->harga_jual }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection