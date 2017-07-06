<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Ver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VerController extends Controller
{
    //显示粉丝列表
    public function VerList()
    {
        $id = Auth::guard()->user()->id;
        //查询所有的用户
//        $result = DB::table('ver')->select('gid')->where('uid',$id)->paginate(1);//获取当前id为7和粉丝id为8的人
//        $results = DB::table('Ver')->select('gid')->where('uid',$id)->get();
//        dd($result);
        $result = DB::table('vers')//查询粉丝表
            ->select('users.id','vers.gid')//查找用户id和粉丝id
            ->join('users','users.id','vers.uid')//通过用户id和粉丝id相同连接
            ->where('vers.uid','=',$id)//条件是查找粉丝表中的用户id等于当前获取到的用户
            ->paginate(2);//获取当前用户的粉丝id
        if($result->all()){
            foreach ($result as $value)
            {
                $care = DB::table('users')->find($value->gid);//查询当前粉丝(是否已经被用户表删除)
                if(empty($care)){//如果没有在用户表查找到当前粉丝的值就删除
                    $a = DB::table('vers')->where('gid',$value->gid)->delete();
                }else{
                    $ver = DB::table('cares')->where('fid',$care->id)->where('uid',$id)->get()->first();//查询当前粉丝我是否关注
                    if($ver)
                    {
                        $care1 = ['sta'=>'1'];//状态1表示相互关注
                        $cares[] = (object)array_merge((array)$care,$care1);//将状态传入
                    }else{
                        $care1 = ['sta'=>'0'];//状态0表示没有互相关注
                        //foreach ($care as $k => $v){
                        //$care1[$k] = $v;
                        //}
                        $cares[] = (object)array_merge((array)$care,$care1);
                    }
                }

            }
        }else{
            $cares = '';
            $result = '';
        }

        return view('home.care.verList', compact('cares','result'));
    }
    //添加关注
    public function addver($id) {
        $uid = Auth::guard()->user()->id;
        $regtime = date('Y-m-d H:i:s',time());
        $result = DB::table('cares')
                    ->insert(
                        ['uid' => $uid,
                        'fid' => $id,
                        'regtime' => $regtime]
                    );
        return back();
    }
    //取消关注
    public function delver($id)
    {
        $uid = Auth::guard()->user()->id;//获取当前用户
        //删除信息
        DB::table('cares')->where('fid',$id)->where('uid',$uid)->delete();//条件要当前用户下的粉丝id
        return back();
    }
}
