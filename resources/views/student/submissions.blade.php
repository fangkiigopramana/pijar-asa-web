@extends('layouts.index')
@section('container')
    <div class="card shadow border-0 my-7 mx-3">
        <div class="card-header bg-warning bg-opacity-50">
            <h3 class="mb-0 fw-bold">Data Submission</h3>
        </div>
        <div class="accordion accordion-flush mx-3" id="accordionFlushExample">
            <h4>Uncompleted</h4>

            @foreach ($taskUncompleted as $task)
            @if ($task->first()->category === 'task')              
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-secondary bg-opacity-5" type="button"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $task->first()->id }}" aria-expanded="false"
                        aria-controls="flush-collapse{{ $task->first()->id }}" onclick="hideDescription()">
                        <div class="flex-col">
                            <div class="flex-row">
                                <span class="text-primary fw-bold" style="font-size: 13px">{{ $task->first()->lesson->title }} |
                                    <span
                                        class="text-success">{{ Str::upper($task->first()->category) }}</span></span>
                                <h5>{{ $task->first()->title }}</h5>
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapse{{ $task->first()->id }}" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample" onshow="hideDescription()">
                    <div class="accordion-body">
                        <p>
                            {{ $task->first()->description }}
                        </p>
                            <hr>
                            <div class="m-6">
                                <form>
                                    @csrf
                                    <div class="mb-3">
                                        <label for="link_file" class="form-label">Link Drive File Pengerjaan</label>
                                        <input type="text" class="form-control" name="link_file" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Selesaikan Tugas</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

            <hr>
            <h4>Completed</h4>
            @foreach ($taskCompleted as $task)   
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-secondary bg-opacity-5" type="button"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $task->submission_id }}" aria-expanded="false"
                        aria-controls="flush-collapse{{ $task->submission_id }}" onclick="hideDescription()">
                        <div class="flex-col">
                            <div class="flex-row">
                                <span class="text-primary fw-bold" style="font-size: 13px">{{ $task->post->lesson->title }} |
                                    <span
                                        class="text-success">{{ Str::upper($task->post->category) }}</span></span>
                                <h5>{{ $task->post->title }}</h5>
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="flush-collapse{{ $task->submission_id }}" class="accordion-collapse collapse"
                    data-bs-parent="#accordionFlushExample" onshow="hideDescription()">
                    <div class="accordion-body">
                        <p>
                            {{$task->post->description}}
                        </p>
                        @if ($task->post->category === 'task')
                            <hr>
                            <div class="m-6">
                                <form>
                                    @csrf
                                    <div class="mb-3">
                                        <label for="link_file" class="form-label">Link Drive File Pengerjaan</label>
                                        <input type="text" class="form-control" name="link_file" value="{{$task->link_file}}" required readonly>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                
            </div>
            @endforeach
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
