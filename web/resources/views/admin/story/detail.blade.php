@extends('index')

@section('content')
<div class="animated fadeIn">
	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<strong class="card-title">Detail Story</strong>
					</div>
				</div>
				<div class="card-body">
					<form accept-charset="utf-8">
						@csrf

						<div class="row form-group">
							<label class="col-2" for="post">Name</label>
							<input class="form-control col-8" type="text" name="name" value="{{$record->name}}" id="name" placeholder="Name">
						</div>
						<div class="row form-group">
							<label class="col-2" for="post">Photo</label>
							<input type="file" name="photo" value="" id="photo">
						</div>
						<div class="row form-group">
							<label class="col-2" for="post">Description</label>
							<input class="form-control col-8" type="text" name="description" value="{{$record->description}}" id="name" placeholder="description">
						</div>
						<div class="row form-group">
							<label class="col-2" for="category">Category</label>
							<select class="form-control col-8" id="category" name= "category">
								<option value="{{$record_category->id}}">{{$record_category->name}}</option>
							</select>
						</div>
						<div class="row form-group">
							<label class="col-2" for="post">Video</label>
							<input type="file" accept="video/*"/ name= "video">
							<video controls autoplay></video>
						</div>
						<div class="row form-group">
							<label class="col-2" for="age">Age</label>
							<select multiple  class="form-control col-8" id="age" name= "age[]">
								@if ($array_age)
								@foreach ($array_age as $element)
								<option value="{{$element->id}}">{{$element->age}}</option>
								@endforeach
								@endif

							</select>
						</div>
						<div>
							<div>
								<button type="button" class="btn btn-success" id="show_add">Create</button>
							</div>
							<div id= "question_added">

							</div>
							<div class="row form-group" style="display: none;" id= "form_add" name= 'list[]'>
								<label class="col-2" for="exampleFormControlSelect2">Question</label>
								<div class="col-10">
									<div>
										<label  for="exampleFormControlSelect2">Number 1:</label>
										<div>
											<div class="row form-group">
												<label class="col-2" for="post">Question</label>
												<textarea class="form-control col-7" id="question"></textarea>
											</div>
											<div class="row form-group">
												<label class="col-2" for="post">Answer 1</label>
												<input class="form-control col-7" type="text" value="" id="answer1" placeholder="Answer">
											</div>
											<div class="row form-group">
												<label class="col-2" for="post">Answer 2</label>
												<input class="form-control col-7" type="text" value="" id="answer2" placeholder="Answer">
											</div>
											<div class="row form-group">
												<label class="col-2" for="post">Answer 3</label>
												<input class="form-control col-7" type="text" value="" id="answer3" placeholder="Answer">
											</div>
											<div class="row form-group">
												<label class="col-2" for="post">Answer 4</label>
												<input class="form-control col-7" type="text" value="" id="answer4" placeholder="Answer">
											</div>
										</div>
									</div>
									<a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
									<button type="button" class="btn btn-success" id="btnPush">Add
									</button>
								</div>
							</div>
						</div>

						<div class="modal-footer">
							<a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
							<button type="button" class="btn btn-success" id="btnCreate">Create
							</button>
						</div>
					</form>





				</div>
			</div>
		</div>


	</div>
</div><!-- .animated -->
@endsection