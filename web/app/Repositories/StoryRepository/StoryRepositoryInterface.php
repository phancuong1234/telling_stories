<?php

namespace App\Repositories\StoryRepository;

interface StoryRepositoryInterface
{
	public function getAll();

	public function insert(array $data);

	public function checkExists($id);

	public function getStoryById($id);
	
	public function updateStoryById($id, array $data);
	
	public function deleteStoryWithID($id);

	public function getTopSlide();
	
	public function getStoryNew();

	public function getStoryRecommend();

	public function getStoryPopularity();
	
	public function getStoryDetail($id, $user_id);

	public function getStoryByCategory($id);

	public function getStoryByAge($age_id);

	public function getStoryDownload($id);

	public function getStoryPopularityWeek();

	public function getStoryPopularityMonth();

	public function getQuestionByStory($story_id);

	public function addStoryDownload($user_id, $video_id);

	public function submitTest($user_id, $story_id, array $data);
}