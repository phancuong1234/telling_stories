<?php

namespace App\Repositories\QuestionRepository;
use App\Model\Question;
use App\Repositories\QuestionRepository\QuestionRepositoryInterface;
use DB;
class QuestionRepository implements QuestionRepositoryInterface
{
	public function insert(array $data)
	{
		//dd($data['question']);
		DB::beginTransaction();
		try {
			$record = new Question;
			$record->question = $data['question'];
			$record->answer_true = $data['answer_true'];
			$record->answer_false_1 = $data['answer_false_1'];
			$record->answer_false_2 = $data['answer_false_2'];
			$record->answer_false_3 = $data['answer_false_3'];
			$record->save();
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollBack();
			return false;
		}
	}
	public function getID()
	{
		$id= Question::select('id')->orderBy('id', 'DESC')->first();
		return $id;
	}
	public function getQuestionById($id)
	{
		$question= [];
		foreach ($id as $key => $value) {
			$qs= Question::where('id','=',$value)->first();
			array_push($question,$qs);
		}
		return $question;
	}
}