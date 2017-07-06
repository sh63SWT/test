<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\AnswerRequest;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    //找回密码1
    public function getPass($id){
        $uid = $id;
        $result = DB::table('answers')->limit(1)->get();
        $problem = DB::table('problems')->where('uid',$uid)->limit(1)->get();
        if(empty($problem)){
            $problem = '';
        }
        return view('home.answerList',compact('result','problem','uid'));
    }

    public function answerAdd(){
        return view('admin.user.answerAdd');
    }

    public function answertoAdd(AnswerRequest $request){
        $result = $request->answer;
        if(empty($result)){
            return back();
        }else{
            $res = Answer::create($request->all());
            return redirect('/answer-list');
        }
    }

    public function answerUpd($id){
        $answerUpd = DB::table('answers')->where('id',$id)->get();
        $result_sta = Auth::guard('admin')->user()->status;
        return view('admin.user.answerUpd',compact('answerUpd','result_sta'));
    }

    public function answertoUpd(AnswerRequest $request) {
        $result =Answer::find($request->id)->update($request->all());
        if(empty($result)){
            return back();
        }else{
            return redirect('/answer-list');
        }
    }

    public function answerDel(Request $request,$id){
        $result = DB::table('answers')->where('id',$id)->delete();
        return back();
    }
}
