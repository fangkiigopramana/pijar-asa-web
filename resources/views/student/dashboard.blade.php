@extends('layouts.index')
@section('container')
    <!-- Header -->
    <header class="bg-surface-primary border-bottom pt-6">
        <div class="container-fluid">
            <div class="mb-npx">
                <div class="row align-items-center">
                    <div class="col-sm-6 col-12 mb-4 mb-sm-0">
                        <!-- Title -->
                        <h1 class="h2 mb-0 ls-tight py-3">Hello <span class="text-primary">{{Auth::user()->name}}</span>.</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main -->
    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <!-- Card stats -->
            <div class="row g-6 mb-6">
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="h6 font-semibold text-sm d-block mb-2">{{Auth::user()->name}}</span>
                                    <span class="h6 font-semibold text-sm d-block mb-2">{{Auth::user()->email}}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-primary text-white text-lg rounded-circle">
                                        <i class="bi bi-info"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 mb-0 text-sm">
                                <span class="badge badge-pill bg-soft-success text-black me-2 fw-bold">
                                    {{Str::upper(Auth::user()->role)}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-12">
                    <div class="card shadow border-0">
                        <div class="card-body">
                            <div class="row" style="padding-bottom: 30px">
                                <div class="col">
                                    <span class="h6 font-semibold text-muted text-sm d-block mb-2">Total Kelas</span>
                                    <span class="h3 font-bold mb-0">{{count(Auth::user()->lessonSubscribe)}} Kelas</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white text-lg rounded-circle">
                                        <i class="bi bi-people"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow border-0 mb-7">
                <div class="card-header">
                    <h5 class="mb-0">Applications</h5>
                </div>
                <div class="card-footer border-0 py-5">
                    <span class="text-muted text-sm">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sint necessitatibus dignissimos deleniti hic quia culpa provident illum corrupti, eveniet quod nihil sapiente? Laborum tenetur consequuntur delectus excepturi rem, quasi voluptatem id officia asperiores pariatur, necessitatibus quas minus cum! Hic nesciunt velit inventore veniam totam, architecto molestiae voluptate voluptates expedita corrupti magnam perspiciatis, quisquam, exercitationem voluptatibus commodi nisi est nemo. Consequatur, harum placeat eum quos quasi aperiam doloribus sunt ipsa, ullam facere rerum corporis ipsum quam enim fugit omnis voluptatem molestias voluptate velit ratione sequi quae non accusamus praesentium. Repellat veritatis molestias sunt recusandae vitae mollitia quis? Eius fuga ratione atque?</span>
                </div>
            </div>
        </div>
    </main>
@endsection
