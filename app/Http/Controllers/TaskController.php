<?php

namespace App\Http\Controllers;

use App\Models\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\TaskMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function Index(){
        $tasks = TaskModel::get();
        return view('task.index',compact('tasks'));
    }

    public function Form($id=0){

        if ($id != 0){
            $tasks=TaskModel::where('id', $id)->first();
        }else{
            $tasks = new TaskModel();
        }

        return view('task.form', compact('tasks'));

    }

    public function Delete($id) {
        $task = TaskModel::find($id);

        if (!$task) {
            return redirect()->route('task')->with('error', 'Kayıt bulunamadı');
        }

        if (!Auth::user()->Admin()) {
            return "sadece admin silebilir.";
        }

        $task->delete();

        return redirect()->route('task')->with('success', 'Kayıt başarıyla silindi');
    }

    public function Save(Request $request, $id = 0) {

        if (Auth::user()->Admin()) {
            $data = request()->only(
                'title',
                'email',
                'subject',
                'time',
                'status'
            );

            if ($id > 0) {
                $task = TaskModel::find($id);
                $task->update($data);
            } else {
                $task = TaskModel::create($data);
            }


            if ($id == 0) {
                Mail::to($data['email'])->send(new TaskMail($data));
            }

            return redirect()->route('task');
        } else {
            if ($id == 0) {
                return 'admin olmanız gerekmekte';
            } else {
                $data = $request->only('status');
                $task = TaskModel::find($id);
                $task->update($data);

                return redirect()->route('task')->with('status', 'Durum güncellendi');
            }
        }
    }

    public function apiIndex(){
        $tasks = TaskModel::get();
        return response()->json($tasks);
    }

    public function apiForm($id){
        $tasks=TaskModel::find($id);
        return response()->json($tasks);
    }

    public function apiSave(Request $request) {


            $user = $request->token;


            if ($user == "admin"){
                if ($request->id > 0) {
                    $task = TaskModel::find($request->id);
                    $task->status = $request->s ?? $task->status;
                    $task->title = $request->t ?? $task->title;
                    $task->email = $request->e ?? $task->email;
                    $task->subject = $request->sb ?? $task->subject;
                    $task->time = $request->tm ?? $task->time;
                    $task->update();
                } else {
                    $task = new TaskModel();
                    $task->status = $request->s ?? $task->status;
                    $task->title = $request->t ?? $task->title;
                    $task->email = $request->e ?? $task->email;
                    $task->subject = $request->sb ?? $task->subject;
                    $task->time = $request->tm ?? $task->time;
                    $task->save();
                    $maildata = [
                        'title' => $request->t,
                        'status' => $request->s,
                        'subject' => $request->sb,
                        'time' => $request->tm,
                    ];
                    Mail::to($request->e)->send(new TaskMail($maildata));
                }
            }else{
                $task = TaskModel::find($request->id);
                $task->status = $request->s ?? 0;
                $task->update();
            }
            return response()->json($task);

    }
    public function apiDelete(Request $request) {

        $user = $request->token;

        if ($user == "admin"){
            $task = TaskModel::find($request->id);
            if (!$task) {
                return response()->json(['status' => false,'message' => 'Bulunamadı']);
            }
            $task->delete();
            return response()->json(['status' => true,'message'=>'Silme işlemi başarılı']);
        }else{
            return response()->json(['status' => false,'message' => 'Yetkiniz Yok']);
        }

    }

}
