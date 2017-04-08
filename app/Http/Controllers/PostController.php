<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPostRequest;
use App\Post;
use Auth;

use Illuminate\Http\Request;

class PostController extends Controller {

	public function getaddPost()
	{
		return view('giaovu.addpost');
	}

	public function postaddPost(AddPostRequest $request)
	{
		$post = new Post();
		$post->title = $request->title;
		$post->content = $request->content;
		$post->save();
		return redirect()->route('giaovu.listpost')->with(['flash_message'=>'Thêm thông báo thành công']);
	}

	public function listPost()
	{
		$data = Post::all();
		if(Auth::user()->type == 3){
			return view('giaovu.listpost', compact('data'));
		} else if (Auth::user()->type == 2) {
			return view('sinhvien.listpost', compact('data'));
		} else {
			return view('giaovien.listpost', compact('data'));
		}
		
	}

	public function infoPost(Request $request)
	{
		$data = Post::find($request->id);
		if(Auth::user()->type == 3){
			return view('giaovu.infopost', compact('data'));
		} else if (Auth::user()->type == 2) {
			return view('sinhvien.infopost', compact('data'));
		} else {
			return view('giaovien.infopost', compact('data'));
		}
	}

	public function geteditPost(Request $request)
	{
		$data = Post::find($request->id);
		return view('giaovu.editpost', compact('data'));
	}

	public function posteditPost(AddPostRequest $request)
	{
		$post = Post::find($request->id);
		$post->title = $request->title;
		$post->content = $request->content;
		$post->save();
		return redirect()->route('giaovu.listpost')->with(['flash_message'=>'Sửa thông báo thành công']);
	}

	public function deletePost(Request $request)
	{
		$post = Post::find($request->id);
		$post->delete();
		return redirect()->route('giaovu.listpost')->with(['flash_message'=>'Xóa thông báo thành công']);
	}

}
