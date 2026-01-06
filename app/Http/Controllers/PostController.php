<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;
use Throwable;

class PostController extends Controller
{
    public function home(){
        return view('home');
    }

    public function store(){
        $post=Post::orderBy('id','desc')->first();//データベースに何もないときはnullが代入される
        $time=Carbon::now();
        if($post==null){//新規作成
            $post=Post::create([//レコードを作成
                'startWork'=>$time//作成したレコードのstartWorkフィールドに値を挿入
            ]);
            return back()->with('workState','勤務中');//home.blade.phpにセッションを渡し、戻る
        }
        elseif($post->endWork!=null){//退勤したとき
             $post=Post::create([//レコードを作成
                'startWork'=>$time//作成したレコードのstartWorkフィールドに値を挿入
             ]);
             return back()->with('workState','勤務中');//home.blade.phpにセッションを渡し、戻る
        }
        else{//出勤中のとき
            return back()->with('alertMessage','出勤は打刻できません。');
        }
    }

    public function secondStore(){
        $time=Carbon::now();
        $post=Post::orderBy('id','desc')->first();//最新のレコードを取得
        // if(1){
        //     return back()->with('modalContent','modal');
        // }
        // if((date("d",strtotime($time))!=date("d",strtotime($post->startWork))||){
        //     return back()->with('modalContent','modal');
        // }
        try{//エラーハンドリング
           if($post->startBreak!=null){
            return back()->with('alertMessage','休憩開始は打刻できません。');
           }
           $post->update([
            'startBreak'=>$time//最新のstartBreakのフィールドを更新
           ]);
            return back()->with('workState','休憩中');
        } catch (Throwable $e){
            return back()->with('alertMessage','休憩開始は打刻できません。');
        }
    }

    public function thirdStore(){
        $time=Carbon::now();
        try{
            $post=Post::orderBy('id','desc')->first();//最新のレコードを取得
            if($post->endBreak!=null){
                return back()->with('alertMessage','休憩終了は打刻できません。');
            }
            if($post->startBreak==null){//エラーハンドリング
                return back()->with('alertMessage','休憩終了は打刻できません。');
            }
           $post->update([
            'endBreak'=>$time//最新のレコードのendBreakのフィールドを更新
           ]);
            return back()->with('workState','勤務中');
        } catch(Throwable $e){
            return back()->with('alertMessage','休憩終了は打刻できません。');
        }
    }

    public function fourthStore(){
        $time=Carbon::now();
        try{
            $post=Post::orderBy('id','desc')->first();//最新のレコードを取得
            if($post->endWork!=null){
                return back()->with('alertMessage','退勤は打刻できません。');
            }
            if(($post->startBreak==null)||($post->endBreak==null)){
                return back()->with('alertMessage','退勤は打刻できません。');

            }
           $post->update([
            'endWork'=>$time//最新のレコードのendWorkのフィールドを更新
           ]);
            return back();//戻る
        } catch(Throwable $e){
            return back()->with('alertMessage','退勤は打刻できません。');
        }
    }
}
