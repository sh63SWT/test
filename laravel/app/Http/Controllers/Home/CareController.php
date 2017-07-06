<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Care;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CareController extends Controller
{
    //显示关注列表
    public function careList()
    {
        $id = Auth::guard()->user()->id;
        //查询所有的用户
//        $result = DB::table('ver')->select('gid')->where('uid',$id)->paginate(1);//获取当前id为7和粉丝id为8的人
//        $results = DB::table('Ver')->select('gid')->where('uid',$id)->get();
//        dd($result);
        $result = DB::table('cares')
            ->select('users.id','cares.fid')
            ->join('users','users.id','cares.uid')
            ->where('cares.uid','=',$id)
            ->paginate(2);//获取当前用户的粉丝id
        $res = $result->all();//判断我的粉丝是否为空
        if ($res){//不为空执行
            foreach ($result as $value)//不为空就循环值
            {
                $care = DB::table('users')->find($value->fid);//查询当前关注id(防止已被删除)
                if(empty($care)){//如果没有在用户表查找到当前关注的值就删除
                    $a = DB::table('cares')->where('fid',$value->fid)->delete();
                }else{
                    $ver = DB::table('vers')->where('gid',$care->id)->where('uid',$id)->first();//查询当前关注是否关注我
                    if($ver)
                    {
                        $care1 = ['sta'=>'1'];//相互关注1
                        $cares[] = (object)array_merge((array)$care,$care1);
                    }else{
                        $care1 = ['sta'=>'0'];//纯关注0
                        $cares[] = (object)array_merge((array)$care,$care1);
                    }
                    //最后返回值[粉丝状态]，[返回结果]
                }

            }
        }else{//为空就给空值
            $cares = '';
            $result = '';
        }
        return view('home.care.careList', compact('cares','result'));

    }

   //添加关注
    public function addcare($id) {
        $uid = Auth::guard()->user()->id;
        $regtime = date('Y-m-d H:i:s',time());
        $result = DB::table('vers')
            ->insert(
                ['uid' =>$uid,
                    'gid' => $id,
                    'regtime' => $regtime]
            );
        return back();
    }

    //取消关注
    public function delcare($id)
    {
        $uid = Auth::guard()->user()->id;
        //删除信息
        DB::table('cares')->where('fid',$id)->where('uid',$uid)->delete();
        return back();
    }
}
