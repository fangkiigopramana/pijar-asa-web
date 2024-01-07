@extends('layouts.index')
@section('container')
    
    @if (session()->has('create-lesson-success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session()->get('create-lesson-success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card shadow border-0 mb-7">
        <div class="card-header">
            <h5 class="mb-0">Data Kelas</h5>
        </div>
        <div class="col-sm-12 col-12 text-sm-start" style="margin: 20px">
            <div class="mx-n1">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class=" pe-2">
                        <i class="bi bi-plus"></i>
                    </span>
                    <span>Buat Kelas</span>
                </button>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Buat Kelas</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('teacher.create-lesson') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" name="title"
                                    placeholder="Misal: Matematika dasar" required autofocus>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi Singkat</label>
                                <textarea type="text" class="form-control" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hari Kelas</label>
                                <select class="form-select form-select-sm" aria-label="Small select example" name="day">
                                    <option selected disabled>Pilih hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jam Kelas</label>
                                <input type="time" class="form-control" name="time" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Buat Kelas</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kode Kelas</th>
                        <th scope="col">Waktu</th>
                        <th scope="col">Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($lessons as $lesson)
                        <tr>
                            <td>
                                <p>{{ $loop->iteration }}.</p>
                            </td>
                            <td>
                                <p class="text-heading font-semibold">
                                    {{ $lesson->title }}
                                </p>
                            </td>
                            <td>
                                {{ $lesson->code }}
                            </td>
                            <td>
                                <p class="text-heading font-semibold">
                                    {{ $lesson->day . ', ' . \Carbon\Carbon::createFromFormat('H:i:s', $lesson->time)->format('H:i') }}
                                </p>
                            </td>
                            <td>
                                <a href="{{ route('teacher.detail-lesson', [$lesson->id]) }}"
                                    class="btn btn-sm btn-primary">Detail</a>

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer border-0 py-5">
            <span class="text-muted text-sm">Showing {{ count($lessons) }} items found</span>
        </div>
    </div>
@endsection
