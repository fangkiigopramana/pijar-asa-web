@extends('layouts.index')
@section('container')
    <div class="card shadow border-0 mb-7">
        <div class="card-header">
            <h5 class="mb-0">Data Murid</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">No Handphone</th>
                        <th scope="col">Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($murids as $murid)                        
                    <tr>
                        <td>
                            <p>{{$loop->iteration}}.</p>
                        </td>
                        <td>
                            <p class="text-heading font-semibold">
                                {{$murid->name}}
                            </p>
                        </td>
                        <td>
                            {{$murid->email}}
                        </td>
                        <td>
                            <p class="text-heading font-semibold">
                                {{($murid->gender == 'L' ? 'Laki-Laki' : 'Perempuan')}}
                            </p>
                        </td>
                        <td>
                            {{$murid->nomor_handphone}}
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Detail
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Murid</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="text-align: left">
                                            <div class="mb-3">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control form-control-sm" value="{{$murid->name}}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="text" class="form-control form-control-sm" value="{{$murid->email}}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Kelamin</label>
                                                <input type="text" class="form-control form-control-sm" value="{{($murid->gender == 'L' ? 'Laki-Laki' : 'Perempuan')}}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nomor Handphone</label>
                                                <input type="text" class="form-control form-control-sm" value="{{$murid->nomor_handphone}}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Alamat</label>
                                                <input type="text" class="form-control form-control-sm" value="{{$murid->alamat}}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Wali</label>
                                                <input type="text" class="form-control form-control-sm" value="{{$murid->nama_wali}}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Tempat tanggal lahir</label>
                                                <input type="text" class="form-control form-control-sm" value="{{$murid->tempat_lahir . ', ' . $murid->tanggal_lahir}}" readonly>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger bg-opacity-20"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="card-footer border-0 py-5">
            <span class="text-muted text-sm">Showing 10 items out of 250 results found</span>
        </div>
    </div>
@endsection
