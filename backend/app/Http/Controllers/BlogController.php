<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    //show blog list

    //@return view
    public function showList()
    {
        $blogs = Blog::all();
        return view('blog.list', ['blogs' => $blogs]);

    }


        //show blog detail

    //@param int $id
    //@return view
    public function showDetail($id)
    {
        $blog = Blog::find($id);

        if(is_null($blog)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('blogs'));

        }


        return view('blog.detail', ['blog' => $blog]);

    }

    //show register 
    //
    public function showCreate(){

        return view('blog.form');

    }
    
    //register blog
    //
    public function exeStore(BlogRequest $request){
        //get all blog data
        $inputs = $request->all();

        \DB::beginTransaction();
        try{
            //register blog
            Blog::create($inputs);
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg','ブログを登録しました');
        return redirect(route('blogs'));

    }

    //blog edit form
    //@param int $id
    //@return view
    public function showEdit($id)
    {
        $blog = Blog::find($id);

        if(is_null($blog)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('blogs'));

        }


        return view('blog.edit', ['blog' => $blog]);

    }
    //Update blog
    //
    public function exeUpdate(BlogRequest $request){
        //get all blog data
        $inputs = $request->all();
        \DB::beginTransaction();
        try{
            //update blog
            $blog = Blog::find($inputs['id']);
            $blog->fill([
                'title' => $inputs['title'],
                'content' => $inputs['content'],
            ]);
            $blog->save();
            \DB::commit();
        }catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
        \Session::flash('err_msg','ブログを更新しました');
        return redirect(route('blogs'));

    }

    //Delete blog
    //
    public function exeDelete($id)
    {
        if(empty($id)){
            \Session::flash('err_msg','データがありません。');
            return redirect(route('blogs'));
        }
        try{
            Blog::destroy($id);
        }catch(\Throwable $e){

            abort(500);
        }
        \Session::flash('err_msg','削除しました。');
        return redirect(route('blogs'));

    }



}
