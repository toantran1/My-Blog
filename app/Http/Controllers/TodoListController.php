<?php

namespace App\Http\Controllers;

use App\Models\todoList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class TodoListController extends Controller
{
    public function add_new_todo_page(){
        $showUser = User::all();
        return view('admin.add_new_todos')->with(compact('showUser'));
    }

    public function insert_task(){

        $permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code_task = substr(str_shuffle($permitted_chars), 0, 10);
        

        $data = request()->validate([
            'task_name'=>'required',
            // 'code_task'=>'required',
            'assign'=> 'required',
            'status'=>'required'
        ]);

        $todoList = new todoList();
        $todoList->task_name =$data['task_name'];
        $todoList->code_task = $code_task;
        $todoList->assign =$data['assign'];
        $todoList->status = $data['status'];
        
        $result= $todoList->save();

        if($result){
            Session::put('message','<span style="color:green">Insert task successfull!</span>');
            return redirect('todoList/add-new-todo');
        }else{
            Session::put('message','<span style="color:red">Insert task failed!</span>');
            return redirect('todoList/add-new-todo');
        }
        
    }
    public function show_todoList(){
        // $showToDoList = todoList::all();
        $showToDoList = DB::table('tbl_todolist')
                ->join('users','tbl_todolist.assign', "=",'users.id')
                ->get([ 'users.name',
                        'tbl_todolist.task_name',
                        'tbl_todolist.code_task',
                        'tbl_todolist.id']);

        if($showToDoList){
            return view('admin.all_todoList')->with(compact('showToDoList'));
        }else{
            return view('admin.all_todoList');
        }
        
    }

    public function delete_task($id){
        $listTask = todoList::find($id);
        $listTask->delete();
        return redirect('todoList/todo-list');
    }

    
}
