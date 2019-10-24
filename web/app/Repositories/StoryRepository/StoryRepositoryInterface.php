<?php

namespace App\Repositories\StoryRepository;

interface StoryRepositoryInterface
{
	public function getAll();

	public function insert(array $data);

	public function getStoryById($id);
	
	public function updateStoryById($id, array $data);
	
	public function deleteStoryWithID($id);

	public function getTopSlide();
	
	public function getStoryNew();

	public function getStoryRecommend();

	public function getStoryPopularity();

	public function getStoryNewAll();
	
	public function getStoryPopularityAll();
	
	public function getStoryDetail($id);
}