@extends('layouts.index')
@section('container')
    <div class="card shadow border-0 mb-7">
        <div class="card-header">
            <h5 class="mb-0">{{$post_title}} | Data Pengerjaan Siswa</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-nowrap">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama Murid</th>
                        <th scope="col">Link Pengerjaan</th>
                        <th scope="col">Action</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($submissions as $sub)
                        <tr>
                            <td>
                                <p>{{ $loop->iteration }}.</p>
                            </td>
                            <td>
                                <p class="text-heading font-semibold">
                                    {{ $sub->user->name }}
                                </p>
                            </td>
                            <td>
                                {{ $sub->link_file }}
                            </td>
                            <td>
                                <a href="{{$sub->link_file}}" target="_blank" class="btn btn-sm btn-primary">Lihat File</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="card-footer border-0 py-5">
            <span class="text-muted text-sm">Showing {{count($submissions)}} items found</span>
        </div>
    </div>
@endsection
