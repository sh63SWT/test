<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VerController extends Controller
{
    //显示粉丝列表
    public function userVer($id,$sta)
    {
        $result = DB::table('vers')
            ->select('users.id','vers.gid')
            ->join('users','users.id','vers.gid')
            ->where('vers.uid','=',$id)
            ->paginate(2);//获取当前用户的粉丝id
        //dd($result);
        foreach ($result as $value)
        {
            $care = DB::table('users')->find($value->gid);//查询当前粉丝
            $ver = DB::table('cares')->where('fid',$care->id)->get()->first();//查询当前粉丝我是否关注
            if($ver)
            {
                $care1 = ['sta'=>'1'];
                $cares[] = (object)array_merge((array)$care,$care1);
            }else{
                $care1 = ['sta'=>'0'];
                $cares[] = (object)array_merge((array)$care,$care1);
            }
        }
        if(empty($cares)){
            $cares = 0;
        }
        return view('admin.user.verList', compact('cares','result','sta'));
    }
    //添加关注
    public function addver($id) {
        $regtime = date('Y-m-d H:i:s',time());
        $result = DB::table('cares')
                    ->insert(
                        ['uid' =>'7',
                        'fid' => $id,
                        'regtime' => $regtime]
                    );
        return back();
    }
    //取消关注
    public function delVer($id)
    {
        //删除信息
        DB::table('vers')->where('gid',$id)->delete();
        return back();
    }
}
