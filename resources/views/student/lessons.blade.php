@extends('layouts.index')
@section('container')
    <div class="card shadow border-0 mb-7">
        <div class="card-header">
            <h5 class="mb-0">Data Kelas</h5>
        </div>
        <!-- Actions -->
        <div class="col-sm-12 col-12 text-sm-start" style="margin: 20px">
            <div class="mx-n1">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class=" pe-2">
                        <i class="bi bi-plus"></i>
                    </span>
                    <span>Gabung Kelas</span>
                </button>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Kode Kelas</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('student.join-lesson')}}">
                        @csrf
                        <div class="mb-3">
                          <label class="form-label">Masukan Kode Kelas</label>
                          <input type="text" class="form-control" name="code_lesson" placeholder="Misal: ABDFHR">
                        </div>
                        <button type="submit" class="btn btn-primary">Cari Kelas</button>
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

                    @foreach (Auth::user()->lessonSubscribe as $lesson)
                        <tr>
                            <td>
                                <p>{{ $loop->iteration }}.</p>
                            </td>
                            <td>
                                <p class="text-heading font-semibold">
                                    {{ $lesson->lesson->title }}
                                </p>
                            </td>
                            <td>
                                {{ $lesson->lesson->code }}
                            </td>
                            <td>
                                <p class="text-heading font-semibold">
                                    {{$lesson->lesson->day . ', ' . \Carbon\Carbon::createFromFormat('H:i:s', $lesson->lesson->time)->format('H:i')}}

                                </p>
                            </td>
                            <td>
                                <a href="{{route('student.lesson',[$lesson->subscribe_id])}}" class="btn btn-sm btn-primary">Detail</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer border-0 py-5">
            <span class="text-muted text-sm">Showing {{count(Auth::user()->lessonSubscribe)}} items found</span>
        </div>
    </div>
@endsection
