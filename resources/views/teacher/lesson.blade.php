@extends('layouts.index')
@section('container')
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
                        <form method="POST" action="{{route('teacher.create-post',[$lesson->id])}}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control" name="name_lesson" value="{{$lesson->title}}" required readonly>
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
                                <p>
                                    {{$post->description}}
                                </p>
                            </div>
                            @if ($post->category === 'task')
                            <a type="button" class="btn btn-sm btn-primary" href="{{route('teacher.show-submission',[$post->id])}}">
                                <span class=" pe-2">
                                    <i class="bi bi-eye"></i>
                                </span>
                                <span>Lihat Pekerjaan Murid</span>
                            </a>
                            @endif
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
