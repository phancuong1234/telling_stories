<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository\CommentRepositoryInterface;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Http\Response;

class CommentController extends Controller
{
	protected $comment;
	protected $user;

	public function __construct(CommentRepositoryInterface $comment, UserRepositoryInterface $user)
	{
		$this->comment = $comment;
		$this->user = $user;
	}

	public function createComment(Request $request)
	{
		$token= getallheaders()['token'];
		$user= $this->user->getUserByToken($token);
		$comment= $this->comment->createComment($request->all(), $user->id);
		return response()->json([
			'code'  => Response::HTTP_OK,
			'data' => $comment,
		]);
	}
}
