<!-- Vertical Navbar -->
<nav class="navbar show navbar-vertical h-lg-screen navbar-expand-lg px-0 py-3 navbar-light bg-white border-bottom border-bottom-lg-0 border-end-lg" id="navbarVertical">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler ms-n2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand py-lg-2 mb-lg-5 px-lg-6 me-0" href="#">
            <img src="{{asset('images/logo.png')}}" width="120px" height="150px" alt="...">
        </a>
        <!-- User menu (mobile) -->
        <div class="navbar-user d-lg-none">
            <!-- Dropdown -->
            <div class="dropdown">
                <!-- Toggle -->
                <a href="#" id="sidebarAvatar" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar-parent-child">
                        <img alt="Image Placeholder" src="https://images.unsplash.com/photo-1548142813-c348350df52b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=3&w=256&h=256&q=80" class="avatar avatar- rounded-circle">
                        <span class="avatar-child avatar-badge bg-success"></span>
                    </div>
                </a>
                <!-- Menu -->
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="sidebarAvatar">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Settings</a>
                    <a href="#" class="dropdown-item">Billing</a>
                    <hr class="dropdown-divider">
                    <a href="#" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidebarCollapse">
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{(Request::route()->getName() === 'teacher.dashboard' || Request::route()->getName() === 'student.dashboard') ? 'text-warning fw-bold' : '' }}" href="{{route((Auth::user()->role === 'pengajar') ? 'teacher.dashboard' : 'student.dashboard')}}">
                        <i class="bi bi-house"></i> Dashboard
                    </a>
                </li>
                @if (Auth::user()->role === 'pengajar')
                <li class="nav-item">
                    <a class="nav-link {{(Request::route()->getName() === 'teacher.data-students') ? 'text-warning fw-bold' : '' }}" href="{{route('teacher.data-students')}}">
                        <i class="bi bi-people"></i> Data Murid
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link {{(Request::route()->getName() === 'teacher.data-lessons') ? 'text-warning fw-bold' : '' }}" href="{{route('teacher.data-lessons')}}">
                        <i class="bi bi-bookmark"></i> Data Kelas
                        <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">{{count(Auth::user()->lessons)}}</span>
                    </a>
                </li>
                @endif
                @if (Auth::user()->role === 'murid')
                <li class="nav-item">
                    <a class="nav-link {{(Request::route()->getName() === 'student.lessons') ? 'text-warning fw-bold' : '' }}" href="{{route('student.lessons')}}">
                        <i class="bi bi-bookmark"></i> Data Kelas
                        <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">{{count(Auth::user()->lessonSubscribe)}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{(Request::route()->getName() === 'student.submission') ? 'text-warning fw-bold' : '' }}" href="{{route('student.submission')}}">
                        <i class="bi bi-bar-chart"></i> Data Submission
                    </a>
                </li>
                @endif
            </ul>
            <!-- Divider -->
            <hr class="navbar-divider opacity-20">
            <!-- Navigation -->
            <ul class="navbar-nav mb-md-4">
                <li>
                    <div class="nav-link text-xs font-semibold text-uppercase text-muted ls-wide" href="#">
                        Daftar Kelas
                        <span class="badge bg-soft-primary text-primary rounded-pill d-inline-flex align-items-center ms-auto">{{count((Auth::user()->role === 'pengajar') ? Auth::user()->lessons : Auth::user()->lessonSubscribe)}}</span>
                    </div>
                </li>

                @foreach ((Auth::user()->role === 'pengajar') ? Auth::user()->lessons : Auth::user()->lessonSubscribe as $lesson)
                    
                <li>
                    <a href="{{ (Auth::user()->role === 'pengajar') ? route('teacher.detail-lesson', [$lesson->id]) : route('student.lesson',[$lesson->subscribe_id]) }}" class="nav-link d-flex align-items-center">

                        <div class="me-4">
                            <div class="position-relative d-inline-block text-white">
                                <div alt="Image Placeholder" class="avatar rounded-circle bg-primary">{{(Auth::user()->role === 'pengajar') ? Str::upper(substr($lesson->title,0,3)) : Str::upper(substr($lesson->lesson->title,0,3))}}</div>
                            </div>
                        </div>
                        <div>
                            <span class="d-block text-sm font-semibold">
                                {{(Auth::user()->role === 'pengajar') ? $lesson->title : $lesson->lesson->title}}
                            </span>
                            <span class="d-block text-xs text-muted font-regular">
                                {{(Auth::user()->role === 'pengajar') ? $lesson->description : $lesson->lesson->description}}
                            </span>
                        </div>
                    </a>
                </li>
                @endforeach

            </ul>
            <!-- Push content down -->
            <div class="mt-auto"></div>
            <!-- User (md) -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('auth.logout')}}">
                        <i class="bi bi-box-arrow-left"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>