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
                    <button class="accordion-button collapsed bg-secondary bg-opacity-5" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse{{$post->id}}" aria-expanded="false" aria-controls="flush-collapse{{$post->id}}"
                        onclick="hideDescription()">
                        <div class="flex-col">
                            <div class="flex-row">
                                <h5>{{$post->title}}  <span class="badge mx-4 {{($post->category == 'materi') ? 'text-bg-primary' : 'text-bg-success'}}">{{Str::upper($post->category)}}</span></h5>
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapse{{$post->id}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample"
                    onshow="hideDescription()">
                    <div class="accordion-body">
                        <p>
                            {{$post->description}}
                        </p>
                    </div>
                    @if ($post->category === 'task')
                    <hr>
                    <div class="m-6">
                        <form method="POST" action="{{route('student.submit-submission',[$post->id])}}">
                            @csrf
                            <div class="mb-3">
                                <label for="link_file" class="form-label">Link Drive File Pengerjaan</label>
                                <input type="text" class="form-control" name="link_file" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Selesaikan Tugas</button>
                        </form>
                    </div>
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
@endsection
