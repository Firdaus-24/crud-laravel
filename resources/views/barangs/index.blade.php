@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-lg-12 mt-3 text-center">
            <h3>BARANGS</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 mb-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalkategoris"
                onclick="return tambahBarangs('{{ route('barangsAdd') }}')">
                Tambah
            </button>
        </div>
    </div>
    @error('txtnama')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ $message }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @enderror
    @if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong> {{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-12 mb-3">
            <table class="table table-bordered">
                <thead class="bg-primary">
                    <tr>
                        <th scope="col" class="bg-primary text-light">No</th>
                        <th scope="col" class="bg-primary text-light">Nama</th>
                        <th scope="col" class="bg-primary text-light">Kategori</th>
                        <th scope="col" class="bg-primary text-light">Jenis</th>
                        <th scope="col" class="bg-primary text-light text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $p)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->kategoris->nama }}</td>
                            <td>{{ $p->jenis->nama }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="{{ route('barangsDelete', ['id' => $p->id]) }}" method="POST"
                                        onsubmit="return confirm('Apa anda yakin untuk menghapus?')">
                                        <button type="button" class="btn p-0"
                                            onclick="return updateBarangs('{{ route('barangsUpdate', ['id' => $p->id]) }}', '{{ $p->id }}')"
                                            data-bs-toggle="modal" data-bs-target="#modalkategoris">
                                            <span class="badge text-bg-primary"> Update
                                            </span>
                                        </button>

                                        @csrf

                                        <button type="submit" class="btn p-0">
                                            <span class="badge text-bg-danger">
                                                Delete
                                            </span>
                                        </button>

                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalkategoris" tabindex="-1" aria-labelledby="modalkategorisLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalkategorisLabel">Form Barangs</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('barangsAdd') }}" method="post" onsubmit="return confirm('apa anda yakin?')"
                    id="formKategori">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="txtnama" class="form-label">Nama</label>
                            <input type="hidden" class="form-control" id="txtid" name="txtid" autocomplete="off"
                                required>
                            <input type="text" class="form-control" id="txtnama" name="txtnama" autocomplete="off"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="txtkategori" class="form-label">Kategori</label>
                            <select class="form-select" aria-label="Default select example" id="txtkategori"
                                name="txtkategori" required>
                                <option value="">Pilih</option>
                                @foreach ($kategoris as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="txtjenis" class="form-label">Jenis</label>
                            <select class="form-select" aria-label="Default select example" id="txtjenis" name="txtjenis"
                                required>
                                <option value="">Pilih</option>
                                @foreach ($jeniss as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
