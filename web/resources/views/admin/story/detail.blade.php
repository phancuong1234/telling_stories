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
							<input class="form-control col-8" type="text" name="name" value="{{$record->name}}">
						</div>
						<div class="row form-group">
							<label class="col-2" for="post">Photo</label>
							<img src="{{$record->photo}}" alt="avatar" class="user-avatar" id="avatar" style="width:100px;height:120px;" >
						</div>
						<div class="row form-group">
							<label class="col-2" for="post">Description</label>
							<textarea class="form-control col-8">{{$record->description}}</textarea>
						</div>
						<div class="row form-group">
							<label class="col-2" for="category">Category</label>
							<select class="form-control col-8" id="category" name= "category">
								<option value="{{$record_category->id}}">{{$record_category->name}}</option>
							</select>
						</div>
						<div class="row form-group">
							<label class="col-2" for="post">Video</label>
							@if ($video)
							@foreach ($video as $element)
							<iframe width="300" height="180" src="{{$element->path}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							@endforeach
							@endif

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
						<div class="row form-group">
							<label class="col-2" for="category">Question</label>
							<div class="col-10">
								@if ($question)
								@foreach ($question as $key => $value)
								<div>
									<p>Question {{$key + 1}}: {{$value->question}}</p>
									<p>A: {{$value->answer_true}}</p>
									<p>B: {{$value->answer_false_1}}</p>
									<p>C: {{$value->answer_false_2}}</p>
									<p>D: {{$value->answer_false_3}}</p>
								</div>
								@endforeach
								@endif
							</div>
						</div>

						<div class="modal-footer">
							<a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
							<a href="{{ route('story.edit',$record->id) }}" class="btn btn-danger">Edit</a>
						</div>
					</form>





				</div>
			</div>
		</div>


	</div>
</div><!-- .animated -->
@endsection