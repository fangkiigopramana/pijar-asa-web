@extends('layouts.index')
@section('container')
    <div class="card shadow border-0 my-7 mx-3">
        <div class="card-header bg-warning bg-opacity-50">
            <h3 class="mb-0 fw-bold">{{ $lesson->lesson->title }}</h3>
            <p class="mb-0 text-sm">{{ $lesson->lesson->description }}</p>
        </div>
        <div class="accordion accordion-flush" id="accordionFlushExample">

            @if (count($posts) > 0)
                @foreach ($posts as $post)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-secondary bg-opacity-5" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $post->id }}"
                                aria-expanded="false" aria-controls="flush-collapse{{ $post->id }}"
                                onclick="hideDescription()">
                                <div class="flex-col">
                                    <div class="flex-row">
                                        <h5>{{ $post->title }} <span
                                                class="badge mx-4 {{ $post->category == 'materi' ? 'text-bg-primary' : 'text-bg-success' }}">{{ Str::upper($post->category) }}</span>
                                        </h5>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $post->id }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample" onshow="hideDescription()">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p>
                                            {{ $post->description }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        @if ($post->category === 'materi')
                                            <h5 class="mb-3">Galeri Foto</h5>
                                            @if (count($post->images) > 0)
                                                @foreach ($post->images as $img)
                                                    <img src="{{ asset('storage/' . $img->image_name) }}" class="btn p-0"
                                                        style="margin-right: 10px; margin-bottom: 10px" width="75px"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#image{{ $img->id }}Modal" alt="...">
                                                    <div class="modal fade" id="image{{ $img->id }}Modal"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true" data-backdrop="false">
                                                        <div class="modal-dialog modal-xl">
                                                            <div class="modal-content">
                                                                <div class="modal-body p-0">
                                                                    <img src="{{ asset('storage/' . $img->image_name) }}"
                                                                        class="mx-auto d-block w-100" alt="..."
                                                                        style="border: none;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-danger">Foto tidak tersedia</p>
                                            @endif
                                        @endif
                                        @if ($post->category === 'task')
                                            <hr>
                                            <div class="m-6">
                                                <form method="POST"
                                                    action="{{ route('student.submit-submission', [$post->id]) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="link_file" class="form-label">Link Drive File
                                                            Pengerjaan</label>
                                                        <input type="text" class="form-control" name="link_file"
                                                            required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Selesaikan Tugas</button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center py-lg-4">
                    Belum tersedia post pada kelas ini.
                </p>
            @endif


        </div>
    </div>
@endsection
