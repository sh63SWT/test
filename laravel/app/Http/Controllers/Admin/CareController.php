<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Care;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CareController extends Controller
{
    //显示粉丝列表
    public function userCare($id,$sta)
    {
        $result = DB::table('cares')
            ->select('users.id','cares.fid')
            ->join('users','users.id','cares.fid')
            ->where('cares.uid','=',$id)
            ->paginate(2);//获取当前用户的粉丝id
        foreach ($result as $value)
        {
            $care = DB::table('users')->find($value->fid);//查询当前关注
            $ver = DB::table('vers')->where('gid',$care->id)->get()->first();//查询当前关注是否关注我
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
        return view('admin.user.careList', compact('cares','result','sta'));
    }
//    //添加关注
//    public function addcare($id) {
//        $regtime = date('Y-m-d H:i:s',time());
//        $result = DB::table('vers')
//            ->insert(
//                ['uid' =>'7',
//                    'gid' => $id,
//                    'regtime' => $regtime]
//            );
//        return back();
//    }
    //取消关注
    public function delcare($id)
    {
        //删除信息
        DB::table('cares')->where('fid',$id)->delete();
        return back();
    }
}
