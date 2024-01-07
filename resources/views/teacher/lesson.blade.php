@extends('layouts.index')
@section('container')
    @if (session()->has('upload-image-success'))
        <div class="alert alert-success" style="color: rgb(53, 197, 0)" role="alert">
            {{ session()->get('upload-image-success') }}
        </div>
    @elseif (session()->has('create-post-success'))
        <div class="alert alert-success" style="color: rgb(53, 197, 0)" role="alert">
            {{ session()->get('create-post-success') }}
        </div>
    @endif

    <div class="card shadow border-0 my-7 mx-3">
        <div class="card-header bg-warning bg-opacity-50">
            <h3 class="mb-0 fw-bold">{{ $lesson->title }}</h3>
            <p class="mb-0 text-sm">{{ $lesson->description }}</p>
        </div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <span class=" pe-2">
                <i class="bi bi-plus"></i>
            </span>
            <span>Buat Postingan</span>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('teacher.create-post', [$lesson->id]) }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" name="name_lesson" value="{{ $lesson->title }}"
                                    required readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Judul Postingan</label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Kategori</label>
                                <select class="form-select form-select-sm" name="category" required>
                                    <option selected>Open this select menu</option>
                                    <option value="task">Tugas</option>
                                    <option value="materi">Materi</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="description" required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Posting</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion accordion-flush" id="accordionFlushExample">

            @if (count($lesson->posts) > 0)
                @foreach ($lesson->posts as $post)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-secondary bg-opacity-5" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $post->id }}"
                                aria-expanded="false" aria-controls="flush-collapse{{ $post->id }}"
                                onclick="hideDescription()">
                                <div class="flex-col">
                                    <div class="flex-row">
                                        <h5>{{ $post->title }} <span
                                                class="badge px-4 {{ $post->category == 'materi' ? 'text-bg-primary' : 'text-bg-success' }}">{{ Str::upper($post->category) }}</span>
                                        </h5>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="flush-collapse{{ $post->id }}" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample" onshow="hideDescription()">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col col-md-8">
                                        <p>
                                            {{ $post->description }}
                                        </p>
                                    </div>
                                    <div class="col col-md-4">
                                        @if ($post->category === 'task')
                                            <a type="button" class="btn btn-sm btn-primary"
                                                href="{{ route('teacher.show-submission', [$post->id]) }}">
                                                <span class=" pe-2">
                                                    <i class="bi bi-eye"></i>
                                                </span>
                                                <span>Lihat Pekerjaan Murid</span>
                                            </a>
                                        @endif
                                        @if ($post->category === 'materi')
                                            <h5 class="mb-3">Galeri Foto</h5>
                                            <div>
                                                @if (count($post->images) > 0)
                                                    @foreach ($post->images as $img)
                                                        <img src="{{ asset('storage/' . $img->path) }}"
                                                            class="btn p-0" style="margin-right: 10px; margin-bottom: 10px"
                                                            width="75px" data-bs-toggle="modal"
                                                            data-bs-target="#image{{ $img->id }}Modal" alt="...">
                                                        <div class="modal fade" id="image{{ $img->id }}Modal"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true" data-backdrop="false">
                                                            <div class="modal-dialog modal-xl">
                                                                <div class="modal-content">
                                                                    <div class="modal-body p-0">
                                                                        <img src="{{ asset('storage/' . $img->path) }}"
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
                                            </div>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-primary mt-3 btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#imageForm{{$post->id}}Modal">
                                                Tambahkan foto
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="imageForm{{$post->id}}Modal" tabindex="-1"
                                                aria-labelledby="imageForm{{$post->id}}ModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('teacher.upload.image.activity', [$post->id]) }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="imageForm{{$post->id}}ModalLabel">
                                                                    Unggah Foto Kegiatan</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="formFileMultiple"
                                                                        class="form-label">Unggah file foto</label>
                                                                    <input class="form-control" type="file"
                                                                        id="formFileMultiple" name="files[]" multiple
                                                                        required>
                                                                    <span class="text-danger"
                                                                        style="font-size: 12px">Keterangan foto disesuaikan
                                                                        dengan nama file *</span>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan foto</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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

    <script>
        function hideDescription() {
            const description = document.getElementById('description');
            if (description.style.display !== 'none') {
                description.style.display = 'none';
            } else {
                description.style.display = 'block';
            }
        }
    </script>
@endsection
