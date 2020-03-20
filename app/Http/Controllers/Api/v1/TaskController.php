<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\task;
use Illuminate\Support\Facades\Validator;
use Exception;

class TaskController extends Controller
{
    //
    public function index(){
        try{
            $task= task::all();
            if(!empty($task)){
                return response()->json([
                    'status'=>200,
                    'data'=>$task
                ]);
            }
            else{
                return response()->json([
                    'status'=>204,
                    'message'=>'You do not have Task Currently. PLease Create a Task'
                ]);
            }
        }catch(Exception $e){
            return rensponse()->json([
                'Error'=>$e->getMessage()
            ]);

        }
    }

    /*protected function validator(array $data){
        return  validator::make($data, [
            'title'=>['required', 'string'],
            'body'=>['required', 'string'],
            'start_date'=>['required','date'],
            'end_date'=>['required', 'date']
        ]);
    }*/

    public function post(Request $request){
        return Date-now();
        //$this->validator( [$request]);
        try{if(task::create([
            'title'=>$request['title'],
            'body'=>$request['body'],
            'start_date'=>$request['start_date'],
            'end_date'=>$request['end_date']
            ])){
                return response()->json([
                    'status'=>200,
                    'message'=> "Your task '{$request['title']}' was successfully created!"
                ]);}
        }catch(Exception $e){
            return response()->json([
                'status'=> 400,
                'Error'=>$e->getMessage(),
                'message'=> 'Sorry! something went wrong while creating your Task; PLEASE TRY AGAIN!'
            ]);
        }
    }

    public function update(Request $request, $id){
        //var_dump($request->all());
       $validate =validator::make($request->all(),[
            'title'=>'required|string',
            'body'=>'required|string',
            'start_date'=>'required|date|after:yesterday',
            'end_date'=>'required|date|after_or_equal:start_date'
        ]);//->validate(); 
        $validateErrors= $validate->errors();
        //return $validateErrors;
        //var_dump($validateErrors);
        
        if($validateErrors->count()>0){
            return response()->json([
                'validation_Error'=>$validateErrors
            ]);
        }
        else{

            $task= task::findOrFail($id);
            
            $task->title= $request->title;
            $task->body= $request->body;
            $task->start_date= $request->start_date;
            $task->end_date =$request->end_date;
            try{if($task->save()){
                return response()->json([
                    'status'=>200,
                    'message'=>'Your Task was successfully updated!'
                ]);}
            }catch(Exception $e){
                return response()->json([
                    'Error_message'=>$e->getMessage()
                ]);
            }

        }
        
       

    }

    public function delete($id){
        task::delete($id);

    }
}
