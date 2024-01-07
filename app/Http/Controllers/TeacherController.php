<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TeacherController extends Controller
{
    public function dashboard()
    {
        $students = User::all()->where('role', '=', 'murid');
        return view('teacher.dashboard', [
            'students' => $students
        ]);
    }
    public function dataStudents()
    {
        return view('teacher.students', [
            'murids' => User::all()->where('role', '=', 'murid')
        ]);
    }

    public function dataLessons()
    {
        $lessons = Auth::user()->lessons()
            ->orderByRaw("
        CASE 
            WHEN day = 'Senin' THEN 1
            WHEN day = 'Selasa' THEN 2
            WHEN day = 'Rabu' THEN 3
            WHEN day = 'Kamis' THEN 4
            WHEN day = 'Jumat' THEN 5
            WHEN day = 'Sabtu' THEN 6
            WHEN day = 'Minggu' THEN 7
            ELSE 8
        END, time")
            ->get();


        return view('teacher.lessons')->with('lessons', $lessons);
    }

    public function createLesson(Request $request)
    {
        $credentials = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'time' => 'required|date_format:H:i', // Menggunakan date_format untuk validasi waktu
        ]);

        $lesson = new Lesson();
        $lesson->title = $credentials['title'];
        $lesson->description = $credentials['description'];
        $lesson->day = $credentials['day'];
        $lesson->time = $credentials['time'];
        $lesson->code = substr(Str::random(5) . time(), 0, 5);
        $lesson->user_id = Auth::user()->id;
        $lesson->save();
        return redirect()->back()->with('create-lesson-success','Yee, berhasil menambahkan kelas!');
    }
    public function createPost($id, Request $request)
    {
        $credentials = $request->validate([
            'name_lesson' => 'required',
            'title' => 'required',
            'category' => 'required|in:materi,task',
            'description' => 'required', // Menggunakan date_format untuk validasi waktu
        ]);

        $post = new Post();
        $post->lesson_id = $id;
        $post->title = $credentials['title'];
        $post->description = $credentials['description'];
        $post->category = $credentials['category'];
        $post->save();
        return redirect()->back()->with('create-post-success','Yee, Postingan baru berhasil ditambahkan');
    }

    public function detailLesson($id)
    {
        $lesson = Lesson::all()->find($id);
        return view('teacher.lesson', [
            'lesson' => $lesson
        ]);
    }

    public function submissions($id)
    {
        $post_title = Post::all()->where('id', '=', $id)->first()->title;
        $submissions = Submission::all()->where('post_id', '=', $id);
        return view('teacher.show-submissions', [
            'submissions' => $submissions,
            'post_title' => $post_title
        ]);
    }

    public function uploadImages(Request $request, $id)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'image|mimes:jpeg,png,jpg,gif|max:10000'
        ]);

        if ($request->hasFile('files') && Post::find($id)) {
            foreach ($request->file('files') as $file) {
                $filePath = $file->store('post-images', 'public');
                $postImg = new PostImage();
                $postImg->post_id = $id;
                $postImg->path = $filePath;
                $postImg->save();
            }

            return redirect()->back()->with('upload-image-success', 'Yee, Foto berhasil ditambahkan!');
        }

        return redirect()->back();
    }
}
