<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\LessonSubscribe;
use App\Models\Post;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function lessons()
    {
        return view('student.lessons');
    }

    public function lesson($id)
    {
        $lesson = LessonSubscribe::all()->where('subscribe_id', '=', $id)->first();
        $posts = $lesson->lesson->posts;
        return view('student.lesson', [
            'lesson' => $lesson,
            'posts' => $posts
        ]);
    }

    public function submissions()
    {
        $user = Auth::user();

        // Mendapatkan semua submissions yang sudah dilakukan oleh user
        $taskCompleted = $user->submissions->pluck('post_id')->toArray();

        $taskUncompleted = $user->lessonSubscribe;

        $taskUncomplete = [];

        // Memfilter lesson yang belum selesai berdasarkan submissions yang sudah dilakukan
        foreach ($taskUncompleted as $task) {
            $uncompletedLessons = $task->lesson->posts->reject(function ($post) use ($taskCompleted) {
                return in_array($post->id, $taskCompleted);
            });

            $taskUncomplete[] = $uncompletedLessons;
        }

        // Menghapus duplikasi data dari $taskUncomplete
        $taskUncomplete = collect($taskUncomplete)->unique()->values()->all();

        $taskCompleted = Submission::whereIn('post_id', $taskCompleted)->where('user_id', Auth::user()->id)->get();
        return view('student.submissions', [
            'taskUncompleted' => $taskUncomplete,
            'taskCompleted' => $taskCompleted
        ]);
    }


    public function submitSubmission($id, Request $request)
    {
        $credentials = $request->validate([
            'link_file' => 'required'
        ]);
        $submission = new Submission();
        $submission->post_id = $id;
        $submission->user_id = Auth::user()->id;
        $submission->link_file = $credentials['link_file'];
        $submission->save();
        return redirect()->back();
    }

    public function joinLesson(Request $request)
    {
        if (Auth::user()->role === 'murid') {
            $lesson = Lesson::all()->where('code', '=', $request->code_lesson)->first();
            if ($lesson) {
                $newSubscribe = new LessonSubscribe();
                $newSubscribe->user_id = Auth::user()->id;
                $newSubscribe->lesson_id = $lesson->id;
                $newSubscribe->save();
                return redirect()->back()->with('join-lesson-success', 'Yee, kamu berhasil gabung kelas!');
            }
        }
        
        return redirect()->back()->with('join-lesson-failed', 'Yah, kode kelas tidak ditemukan!');
    }
}
