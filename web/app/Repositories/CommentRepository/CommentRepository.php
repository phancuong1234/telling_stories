<?php

namespace App\Repositories\CommentRepository;
use App\Model\Comment;
use App\Repositories\CommentRepository\CommentRepositoryInterface;
use DB;
class CommentRepository implements CommentRepositoryInterface
{
	public function createComment($data, $user_id)
	{
		Comment::create([
			'comment' => $data['comment'],
			'user_id' => $user_id,
			'story_id' => $data['story_id']
		]);
		$comment= Comment::join('users','users.id','comments.user_id')
		->select('comments.id as comment_id','comment','comments.created_at' ,'users.id as user_id','users.avatar')
		->where('story_id',$data['story_id'])
		->where('comments.delete_flg',DELETE_FALSE)
		->where('users.delete_flg',DELETE_FALSE)
		->orderBy('created_at','DESC')
		->get()->toArray();

		return $comment;
	}
}