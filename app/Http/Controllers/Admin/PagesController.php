<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Page;

class PagesController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	public function create()
	{
		return view('admin.pages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|unique:pages|max:255',
			'body' => 'required',
		]);

		$page = new Page;
		$page->title = $request->input('title');
		//$page->title = Input::get('title');
		//$page->body =Input::get('body');
		$request->input('body');
		$page->user_id = 1;//Auth::user()->id;

		if ($page->save()) {
			return redirect("admin");
		} else {
			return redirect()->back()->withInput()->withErrors('SAVE FAILED！');
		}

		/*if ($page->save()) {
			return Redirect::to('admin');
		} else {
			return Redirect::back()->withInput()->withErrors('save failed！');
		}*/

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return view('admin.pages.edit')->withPage(Page::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$this->validate($request, [
			'title' => 'required|unique:pages,title,'.$id.'|max:255',
			'body' => 'required',
		]);

		$page = Page::find($id);
		$page->title = $request->input('title');
		$page->body = $request->input('body');
		$page->user_id = 1;//Auth::user()->id;

		if ($page->save()) {
			return redirect("admin");
		} else {
			return redirect()->back()->withInput()->withErrors('SAVE FAILED！');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$page = Page::find($id);
		$page->delete();

		return redirect("admin");
	}

}