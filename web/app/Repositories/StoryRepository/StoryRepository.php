<?php

namespace App\Repositories\StoryRepository;
use App\Model\Story;
use App\Model\Question;
use App\Model\StoryAge;
use App\Model\Video;
use App\Model\History;
use App\Model\Download;
use App\Model\Favorite;
use App\Model\Comment;
use App\Model\VideoUser;
use App\Model\ResultTest;
use App\Repositories\StoryRepository\StoryRepositoryInterface;
use DB;
class StoryRepository implements StoryRepositoryInterface
{
	public function getAll()
	{
		$story= Story::all();
		return $story;
	}
	public function insert(array $data)
	{
		DB::beginTransaction();

		try {
			//store table questions
			
			$list_id_question=[];
			foreach ($data['list_question'] as $key => $value) {
				$question= new Question;
				$question->question= $value['0'];
				$question->answer_true= $value['1'];
				$question->answer_false_1= $value['2'];
				$question->answer_false_2= $value['3'];
				$question->answer_false_3= $value['4'];
				$question->save();
				$id= Question::select('id')->orderBy('id', 'DESC')->first();
				array_push($list_id_question,$id->id);
			}

			//store table stories
			$story = new Story;
			$story->name = $data['name'];
			$story->photo = $data['photo'];
			$story->description = $data['description'];
			$story->list_question = json_encode($list_id_question);
			$story->category_id = $data['category'];
			$story->views = $data['views'];
			$story->save();

			//store table stories_age
			$story_id= Story::select('id')->orderBy('id', 'DESC')->first();
			foreach ($data['age'] as $key => $value) {
				$storyAge= new StoryAge;
				$storyAge->age_id= $value;
				$storyAge->story_id= $story_id->id;
				$storyAge->save();
			}
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}

	public function checkExists($id)
	{
		$story= Story::find($id);
		if($story){
			return true;
		} else {
			return false;
		}
	}
	public function getStoryById($id)
	{
		$record= Story::join('categories', 'categories.id', '=', 'stories.category_id')
		->select('stories.id','stories.name','photo','description','list_question','category_id','views','categories.name as category')
		->where('stories.id','=',$id)
		->first();

		return $record;
	}
	public function updateStoryById($id,array $data)
	{
		
		DB::beginTransaction();
		try {
			$list_id_question=[];
			//update question
			foreach ($data['list_question_update'] as $key => $value) {
				$question= Question::find($value['5']);
				$question->question= $value['0'];
				$question->answer_true= $value['1'];
				$question->answer_false_1= $value['2'];
				$question->answer_false_2= $value['3'];
				$question->answer_false_3= $value['4'];
				$question->save();
				array_push($list_id_question,intval($value['5']));
			}

			//store table questions new
			if($data['list_question_new']){
				foreach ($data['list_question_new'] as $key => $value) {
					$question= new Question;
					$question->question= $value['0'];
					$question->answer_true= $value['1'];
					$question->answer_false_1= $value['2'];
					$question->answer_false_2= $value['3'];
					$question->answer_false_3= $value['4'];
					$question->save();
					$id_qs= Question::select('id')->orderBy('id', 'DESC')->first();
					array_push($list_id_question,$id_qs->id);
				}
			}

			//edit story
			$story= Story::find($id);
			$story->name = $data['name'];
			$story->photo = $data['photo'];
			$story->description = $data['description'];
			$story->list_question = json_encode($list_id_question);
			$story->category_id = $data['category'];
			$story->views = $data['views'];

			$story->save();

			//edit video
			$video= Video::where('story_id','=',$id)->get();
			dd($video);
			foreach ($data['video'] as $key => $value) {
				

			}
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function deleteStoryWithID($id)
	{
		DB::beginTransaction();
		try {
			$story = Story::find($id);
			if($story){
				$storyAge= StoryAge::where('story_id','=',$id)->get();
				//dd($storyAge);
				foreach ($storyAge as $key => $value) {
					$value->delete();
				}
				//delete video
				$video= Video::where('story_id','=',$id)->get();
				//dd($storyAge);
				foreach ($video as $key => $value) {
					$value->delete();
				}
				$story->delete();

				foreach (json_decode($story['list_question']) as $key => $value) {
					$question= Question::find($value);
					$question->delete();
				}
				DB::commit();
				return true;
			}

			
		} catch (\Exception $e) {
			DB::rollBack();
			return false;
		}
	}

//api
	public function getTopSlide()
	{
		$topSlide= Story::select('id','photo','name','views')
		->orderBy('views','desc')
		->where('delete_flg',DELETE_FALSE)
		->take(5)
		->get();
		return $topSlide;
	}
	public function getStoryNew()
	{
		$dataStoryNew= Story::select('id', 'name', 'photo', 'description')
		->where('delete_flg',DELETE_FALSE)
		->orderBy('created_at', 'ASC')
		->get();
		return $dataStoryNew;
	}

	public function getStoryRecommend()
	{
		
		$dataStoryRecommend= Story::join('favorites','favorites.story_id','=','stories.id')
		->select('stories.id', 'name', 'photo', 'description', DB::raw('count(*) as count_favorite, favorites.story_id'))
		->where('stories.delete_flg',DELETE_FALSE)
		->where('favorites.delete_flg',DELETE_FALSE)
		->orderBy('count_favorite', 'desc')
		->groupBy('favorites.story_id')
		->groupBy('stories.id')
		->groupBy('name')
		->groupBy('photo')
		->groupBy('description')
		->take(3)
		->get();

		return $dataStoryRecommend;
	}

	public function getStoryPopularity()
	{
		$dataStoryPopularity= Story::orderBy('views', 'desc')
		->where('delete_flg',DELETE_FALSE)
		->get();
		return $dataStoryPopularity;
	}

	public function getStoryDetail($id,$user_id)
	{
		$dataStoryDetail= [];

		//get info story
		$dataStory= Story::where('stories.id','=',$id)
		->where('stories.delete_flg',DELETE_FALSE)
		->first();

		$dataStoryDetail['id']= $dataStory->id;
		$dataStoryDetail['name']= $dataStory->name;
		$dataStoryDetail['photo']= $dataStory->photo;
		$dataStoryDetail['description']= $dataStory->description;
		$dataStoryDetail['views']= $dataStory->views;
		$dataStoryDetail['created_at']= $dataStory->created_at;

		//get comment
		$comment= Comment::join('users','users.id','favorites.user_id')
		->where('story_id',$id)
		->where('delete_flg',DELETE_FALSE)
		->where('users.delete_flg',DELETE_FALSE)
		->get()->toArray();

		$dataStoryDetail['comment']= $comment;
		//get favorite
		$favorite= Favorite::join('stories','stories.id','favorites.story_id')
		->join('users','users.id','favorites.user_id')
		->select(DB::raw('count(*) as favorite'))
		->where('story_id',$id)
		->where('stories.delete_flg',DELETE_FALSE)
		->where('favorites.delete_flg',DELETE_FALSE)
		->where('users.delete_flg',DELETE_FALSE)
		->groupBy('favorites.story_id')
		->get()->toArray();

		$dataStoryDetail['favorite']= $favorite;

		$videoUser= VideoUser::join('stories','stories.id','videos_user.story_id')
		->join('users','users.id','videos_user.user_id')
		->select('videos_user.id as videos_user_id','videos_user.path','videos_user.views','users.name as user','videos_user.point','videos_user.created_at as created_at_video')
		->where('stories.delete_flg',DELETE_FALSE)
		->where('users.delete_flg',DELETE_FALSE)
		->where('users.state',STATE_ACTIVE)
		->where('videos_user.delete_flg',DELETE_FALSE)
		->where('videos_user.display_flg',DISPLAY)
		->get()->toArray();

		$checkFavorite= Favorite::where('user_id',$user_id)
		->where('story_id',$id)->first();
		if(isset($checkFavorite) && $checkFavorite->delete_flg == 0){
			$dataStoryDetail['is_favorite']= 0;
		}else{
			$dataStoryDetail['is_favorite']= 1;
		}


		$dataStoryDetail['videoUser']= $videoUser;

		return $dataStoryDetail;
	}

	public function getStoryByCategory($id)
	{
		$dataStoryByCategory= Story::where('category_id','=',$id)
		->where('delete_flg',DELETE_FALSE)
		->get();
		return $dataStoryByCategory;
	}

	public function getStoryByAge($age_id)
	{
		$dataStoryByAge= StoryAge::join('stories','stories.id','stories_age.story_id')
		->select('stories.id','stories.photo','stories.name','stories.description','stories.created_at')
		->where('age_id',$age_id)
		->where('stories_age.delete_flg', DELETE_FALSE)
		->where('stories.delete_flg', DELETE_FALSE)
		->orderBy('stories.created_at', 'ASC')
		->get();


		return $dataStoryByAge;
	}

	public function getStoryDownload($id)
	{
		$dataStoryDownload= Download::join('videos','videos.id','=','downloads.video_id')
		->join('stories','videos.story_id','=','stories.id')
		->select('stories.id','stories.photo','stories.name','stories.description','videos.path')
		->where('user_id',$id)
		->where('downloads.delete_flg', DELETE_FALSE)
		->where('stories.delete_flg', DELETE_FALSE)
		->where('videos.delete_flg', DELETE_FALSE)
		->get();
		
		return $dataStoryDownload;
	}

	public function getStoryPopularityWeek()
	{
		$dataStoryPopularityWeek = Story::orderBy('views', 'desc')
		->where('delete_flg',DELETE_FALSE)
		->where('created_at', '>', now()->subWeek(0)->startOfWeek())
		->where('created_at', '<', now()->subWeek(0)->endOfWeek())
		->get()->toArray();

		return $dataStoryPopularityWeek;
	}

	public function getStoryPopularityMonth()
	{
		$dataStoryPopularityMonth = Story::orderBy('views', 'desc')
		->where('delete_flg',DELETE_FALSE)
		->where('created_at', '>', now()->subMonth(0)->startOfMonth())
		->where('created_at', '<', now()->subMonth(0)->endOfMonth())
		->get()->toArray();

		return $dataStoryPopularityMonth;
	}

	public function getQuestionByStory($story_id)
	{
		$story= Story::where('stories.id',$story_id)
		->where('stories.delete_flg',DELETE_FALSE)
		->first();
		$list_question_id= json_decode($story->list_question);
		if(count($list_question_id) < 11){
			$list_question= $list_question_id;
		}else{
			$list_key= array_rand($list_question_id,10);
			foreach ($list_key as $key => $value) {
				$list_question[]= $list_question_id[$value];
			}
		}
		
		$question= Question::select('id','question','answer_true','answer_false_1','answer_false_2','answer_false_3')
		->whereIn('id',$list_question)
		->where('delete_flg',DELETE_FALSE)
		->get()->toArray();
		
		
		return $question;
	}

	public function addStoryDownload($user_id, $video_id)
	{
		$checkVideo= Video::where('id',$video_id)
		->where('delete_flg', DELETE_FALSE)
		->first();
		if($checkVideo){
			$download = Download::where('video_id', $video_id)
			->where('delete_flg', DELETE_FALSE)
			->first();
			if (!$download) {
				Download::create([
					'video_id' => $video_id,
					'user_id' => $user_id
				]);
				
			}
			return true;
		}else{
			return false;
		}
		
		
	}

	public function submitTest($user_id, $story_id, $data)
	{
		$count= 0;
		foreach ($data as $key => $value) {
			$question= Question::where('id', $key)
			->where('delete_flg', DELETE_FALSE)
			->first();
			$true= $question->answer_true;
			if($value == $true){
				$count += 1;
			}
		}
		return ResultTest::create([
			'count_answer_true' => $count,
			'point' => $count * 10,
			'user_id' => $user_id,
			'story_id' => $story_id
		]);
		
		
	}

}