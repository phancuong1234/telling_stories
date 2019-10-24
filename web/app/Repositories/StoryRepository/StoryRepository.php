<?php

namespace App\Repositories\StoryRepository;
use App\Model\Story;
use App\Model\Question;
use App\Model\StoryAge;
use App\Model\Video;
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


	public function getTopSlide()
	{
		$topSlide= Story::select('id','photo','name','views')->orderBy('views','desc')->take(5)->get();
		return $topSlide;
	}
	public function getStoryNew()
	{
		$dataStoryNew= Story::select('id', 'name', 'photo', 'description')
		->orderBy('created_at', 'desc')
		->take(10)
		->get();
		return $dataStoryNew;
	}

	public function getStoryRecommend()
	{
		
		$dataStoryRecommend= Story::select('id', 'name', 'photo', 'description')
		->orderBy('created_at', 'desc')
		->take(10)
		->get();
		return $dataStoryNew;
	}

	public function getStoryPopularity()
	{
		$dataStoryPopularity= Story::orderBy('views', 'desc')
		->take(10)
		->get();
		return $dataStoryPopularity;
	}

	public function getStoryNewAll()
	{
		$dataStoryNewAll= Story::select('id', 'name', 'photo', 'description')
		->orderBy('created_at', 'desc')
		->get();
		return $dataStoryNewAll;
	}

	public function getStoryPopularityAll()
	{
		$dataStoryPopularityAll= Story::orderBy('views', 'desc')
		->get();
		return $dataStoryPopularityAll;
	}
	public function getStoryDetail($id)
	{
		$dataStoryDetail= Story::where('id','=',$id)
		->get();
		return $dataStoryDetail;
	}
}