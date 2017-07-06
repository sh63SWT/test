<?php

namespace App\Http\Controllers\home;

use App\Models\Cat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CatController extends Controller
{
    //
    public function catList($id)
    {
        $uid = Auth::guard()->user()->id;//当前用户id
        //访问私聊表，条件是当前用户的id，和私聊用户的id
        $result = DB::table('cats')->where('uid',$uid)->where('sid',$id)->orwhere('sid',$uid)->where('uid',$id)->orderby('time','desc')->paginate(2);
        //$results = DB::table('cat')->where('uid',$id)->where('sid',$uid)->get();
        //dump(($result)->all());
        //dump($results);
        //$newresult[] = (object)array_merge((array)$result,(array)$results);
        foreach ($result as $value)
        {
            $res = DB::table('cats')
                ->select('users.id','cats.cat','cats.time','users.name','users.icon')
                ->join('users','users.id','cats.uid')
                ->where('cats.sid','=',$value->sid)
                ->where('cats.uid','=',$value->uid)
                ->where('cats.id','=',$value->id)
                ->orderby('cats.time','asc')
                ->get()
                ->first();//获取当前用户的粉丝id
            $ress[] = $res;

        }
        $name = DB::table('users')->select('name','id','icon','sex')->where('id',$id)->get()->first();
        if(empty($ress))
        {
            $ress = '';
        }
        return view('home.care.catList',compact('result','ress','name'));
    }

    //回复添加
    public function catAdd(Request $request){
        $regtime = date('Y-m-d H:i:s',time());
        $result = Cat::create(array_merge($request->all(),['time' => $regtime]));
        if($result)
        {
            return json_encode(array('status' => 0, 'mess' => '回复成功'));
        }else{
            return json_encode(array('status' => 1, 'mess' => '回复失败'));
        }
    }

    public function catDel($id){
        $uid = Auth::guard()->user()->id;;//当前用户id
        $result = DB::table('cats')
                    ->where('uid',$uid)
                    ->where('sid',$id)
                    ->orwhere('uid',$id)
                    ->where('sid',$uid)
                    ->delete();
        return back();
    }
}
