<?php

namespace App\Http\Controllers;

use App\Events\TsAddStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'nim' => 'required|string|max:16',
            'department' => 'required|string|max:150'
        ]);

        $student = Student::create([
            'name' => $validated['name'],
            'nim' => $validated['nim'],
            'department' => $validated['department']
        ]);

        $receiverId = 1;

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true
            ]
        );

        // triger event
        // event(new TsAddStudent($student->name, $student->nim, $student->department));
        $pusher->trigger('private-add-student.' . $receiverId, 'add-student-event', [
            'name' => $student->name,
            'nim' => $student->nim,
            'department' => $student->department
        ]);


        return response()->json([
            'message' => 'add student success!'
        ]);
    }

    public function create()
    {
        return view('student_page.index');
    }

    public function pusherAuth(Request $request)
    {
        if(Auth::check()) {
            $pusher = new Pusher(
                env('PUSHER_APP_KEY'),
                env('PUSHER_APP_SECRET'),
                env('PUSHER_APP_ID'),
                [
                    'cluster' => env('PUSHER_APP_CLUSTER'),
                    'useTLS' => true
                ]
                );

                echo $pusher->socket_auth($request->channel_name, $request->socket_id);
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
    }
}
