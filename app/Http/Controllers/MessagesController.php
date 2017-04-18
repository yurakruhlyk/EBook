<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use Session;

class MessagesController extends Controller
{
	//Output of messages to home page
	public function index()
	{
		$messages = Message::orderBy('id', 'desc')->paginate(5);
		return view('dashboard.messages', ['messages' => $messages]);
	}

	public function create()
	{
		return view('feedback');
	}

	//Add message to database
	public function store(Request $request)
	{
		//validate data
		$this->validate($request, [
			'name' => 'required|max:15',
			'email' => 'required|max:30',
			'message' => 'required|max:255',
			]);

		$message = new Message;

		//save message data
		$message->name = $request->input('name');
		$message->email = $request->input('email');
		$message->message  = $request->input('message');

		$message->save();
		//alert nice add .......

		Session::flash('success','Ваше повідомлення відпревлено!');

		return redirect('feedback');
	}

	public function destroy($id)
	{
		$message->delete();
		
		return redirect('');
	}
}