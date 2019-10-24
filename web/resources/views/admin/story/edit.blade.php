@extends('index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/story.css') }}">
</style>
@endsection

@section('content')
<div class="animated fadeIn">
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<strong class="card-title">Edit Story</strong>
					</div>
				</div>
				<div class="card-body">
					<form accept-charset="utf-8" action="{{ route('story.update',$record->id) }}" method="post" id= "formEdit">
						@csrf

						<div class="row form-group">
							<label class="col-2" for="post">Name</label>
							<input class="form-control col-8" type="text" name="name" value="{{$record->name}}" id="name" placeholder="Name">
						</div>
						<div class="row form-group">
							<label class="col-2" for="post">Photo</label>
							<div class="col-8">
								<img class="row" src="{{$record->photo}}" alt="thumbnail" id="thumbnail" style="width:100px;height:120px;" >
								<input type="file" name="photo" value="" id="photo" style="margin-top: 10px;">
								<input type="text" name="photo" value="" id="photo_link" style="display: none;">
							</div>
						</div>

						<div class="row form-group">
							<label class="col-2" for="post">Description</label>
							<textarea class="form-control col-8" name= "description" id="description">{{$record->description}}</textarea>
						</div>
						<div class="row form-group">
							<label class="col-2" for="category">Category</label>
							<select class="form-control col-8" id="category" name= "category">
								@if ($list_category)
								@foreach ($list_category as $element)
								<option value="{{$element->id}}" @if ($element->id == $record->category_id)
									selected
									@endif>{{$element->name}}</option>
									@endforeach
									@endif
								</select>
							</div>
							<div class="row form-group">
								<label class="col-2" for="post">Video</label>
								<div class="col-8">
									<div class="row" id="form_video">
										@if ($video)
										@foreach ($video as $key => $element)
										<div class="image-area col-4" id="video_{{$key}}">
											<iframe width="100%" height="150" src="{{$element->path}}" frameborder="0" allow="autoplay;picture-in-picture" allowfullscreen id="id_video_{{$key}}"></iframe>
											<a class="remove-image" href="javascript:void(0)" style="display: inline;" id="{{$key}}" onclick="return deleteElement({{ $key }})">&#215;</a>
											<div class="row">
												<input type="text" name="title[]" value="{{$element->title}}">
											</div>
										</div>
										<input type="hidden" class="video_exists" name="video_exists[{{$element->id}}]" id="video_exists_{{ $key }}" value="{{$element->path}}" />
										
										@endforeach
										@endif
									</div>
									<div class="row" id="form_addLink" style= "margin-top: 20px;">
										<div class="col-12" style="display: flex;padding-left: 0px;" id= "link">
											<input class="form-control" type="text" value="" id="input_add_link" placeholder="Link" style="margin-right: 20px;">
											<button type="button" class="btn btn-info row" id= "add_link">Add</button>
										</div>
									</div>

								</div>
							</div>
							<div class="row form-group">
								<label class="col-2" for="age">Age</label>
								<select multiple  class="form-control col-8" id="age" name= "age[]">
									@if ($list_age)
									@foreach ($list_age as $key => $element)
									@if (array_key_exists($key,$array_age))
									<option value="{{$element->id}}" selected>{{$element->age}}</option>
									@else
									<option value="{{$element->id}}">{{$element->age}}</option>
									@endif
									@endforeach
									@endif

								</select>
							</div>
							<div class="row form-group">
								<label class="col-2" for="post">Views</label>
								<input class="form-control col-3" type="text" name="views" value="{{$record->views}}" id="views">
							</div>
							<div class="row form-group">
								<label class="col-2" for="question">Question</label>
								<div class="col-8">
									<div>
										@if ($question)
										@foreach ($question as $key => $value)
										<div style="margin-bottom: 20px;">
											<div>
												<div class="row form-group">
													<label class="col-2" for="post">Question {{$key +1}}</label>
													<textarea class="form-control col-10" id="question" placeholder="Question" name= "list_question_update[{{$key}}][]">{{$value->question}}</textarea>
												</div>
												<div class="row form-group">
													<label class="col-2" for="post">A: </label>
													<textarea class="form-control col-10" id="answer1" placeholder="Answer 1" name= "list_question_update[{{$key}}][]">{{$value->answer_true}}</textarea>
												</div>
												<div class="row form-group">
													<label class="col-2" for="post">B: </label>
													<textarea class="form-control col-10" id="answer2" placeholder="Answer 2" name= "list_question_update[{{$key}}][]">{{$value->answer_false_1}}</textarea>
												</div>
												<div class="row form-group">
													<label class="col-2" for="post">C: </label>
													<textarea class="form-control col-10" id="answer3" placeholder="Answer 3" name= "list_question_update[{{$key}}][]">{{$value->answer_false_2}}</textarea>
												</div>
												<div class="row form-group">
													<label class="col-2" for="post">D: </label>
													<textarea class="form-control col-10" id="answer4" placeholder="Answer 4" name= "list_question_update[{{$key}}][]">{{$value->answer_false_3}}</textarea>
												</div>
											</div>
											<div style="text-align: center;">
												<button type="button" class="btn btn-info" id="btnDel">Delete
												</button>
												<button type="button" class="btn btn-secondary" id="btnCancel">Cancel
												</button>
											</div>
										</div>
										<input type="hidden" value="{{$value->id}}" name="list_question_update[{{$key}}][]">
										@endforeach
										@endif
									</div>

									<div id= "question_added" style="margin-bottom: 20px;">

									</div>

									<div id= "form_add" name= 'list[]'>
										<h3 style="margin-bottom: 20px;text-align: center;">Add question</h3>
										<div>
											<div>
												<div class="row form-group">
													<label class="col-2" for="post">Question</label>
													<textarea class="form-control col-10" id="question_new" placeholder="Question"></textarea>
												</div>
												<div class="row form-group">
													<label class="col-2" for="post">Answer 1</label>
													<textarea class="form-control col-10" id="answer1_new" placeholder="Answer 1"></textarea>
												</div>
												<div class="row form-group">
													<label class="col-2" for="post">Answer 2</label>
													<textarea class="form-control col-10" id="answer2_new" placeholder="Answer 2"></textarea>
												</div>
												<div class="row form-group">
													<label class="col-2" for="post">Answer 3</label>
													<textarea class="form-control col-10" id="answer3_new" placeholder="Answer 3"></textarea>
												</div>
												<div class="row form-group">
													<label class="col-2" for="post">Answer 4</label>
													<textarea class="form-control col-10" id="answer4_new" placeholder="Answer 4"></textarea>
												</div>
											</div>
											<div style="text-align: center;">
												<button type="button" class="btn btn-info" id="btnPush">Add
												</button>
												<button type="button" class="btn btn-secondary" id="btnCancel">Cancel
												</button>
											</div>
										</div>
									</div>
								</div>

							</div>


							<div class="modal-footer">
								<a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
								<button type="button" class="btn btn-success" id="btnEdit">Edit
								</button>
							</div>
						</form>





					</div>
				</div>
			</div>


		</div>
	</div><!-- .animated -->
	@section('js')
	<script src="{{ asset('js/upload.js') }}"></script>
	@endsection

	<script type="text/javascript">
	//remove video
	function deleteElement(id){
		$("#video_"+id).remove();
		$("#video_exists_"+id).remove();
	}
	$(document).ready(function(){
		var count_link_video = $('.image-area').length;
		//change thumbnail story
		$("#photo").change(function() {
			avatar= $('#thumbnail');
			readURL(this,avatar);
		});
		//them link video
		$('#add_link').click(function(){
			var link_add= $('#input_add_link').val();
			$('#form_video').append('<div class="image-area col-4" id="video_'+count_link_video+'">'+
				'<iframe width="100%" height="150" src="'+link_add+'" frameborder="0" allow="autoplay;picture-in-picture" allowfullscreen id="id_video_'+count_link_video+'"></iframe>'+
				'<a class="remove-image" href="javascript:void(0)" style="display: inline;" id="'+count_link_video+'" onclick="return deleteElement('+count_link_video+')">&#215;</a>'+
				'</div>'+
				'<input type="hidden" class="video_exists" name="video_exists[]" id="video_exists_'+count_link_video+'" value="'+link_add+'" />')
			count_link_video = count_link_video+1;
		});
		var dem = 0;
		//them question
		$('#btnPush').click(function(){
			add();
			$('.btn-delete').click(function(event) {
				let id = $(this)[0].id;
				$("#"+id).remove();
				$("."+id).remove();
			});
		});
		function add(){
			var question= $('#question_new').val();
			var answer1= $('#answer1_new').val();
			var answer2= $('#answer2_new').val();
			var answer3= $('#answer3_new').val();
			var answer4= $('#answer4_new').val();
			var qs1 = "<input type='hidden' class="+dem+" name='list_question_new["+ dem +"][]' value='"+question+"'/>";
			var as1 = "<input type='hidden' class="+dem+" name='list_question_new["+ dem +"][]' value='"+answer1+"'/>";
			var as2 = "<input type='hidden' class="+dem+" name='list_question_new["+ dem +"][]' value='"+answer2+"'/>";
			var as3 = "<input type='hidden' class="+dem+" name='list_question_new["+ dem +"][]' value='"+answer3+"'/>";
			var as4 = "<input type='hidden' class="+dem+" name='list_question_new["+ dem +"][]' value='"+answer4+"'/>";

			if(question != '' && answer1 != '' && answer2 != '' && answer3 != '' && answer4 != ''){
				$("#question_added").after(qs1,as1,as2,as3,as4);
				$('#question_added').append('<div id="'+dem+'">'+
					'<div>'+
					'<div class="row form-group">'+
					'<label class="col-2" for="post">Question</label>'+
					'<textarea class="form-control col-10" id="question">'+question+'</textarea>'+
					'</div>'+
					'<div class="row form-group">'+
					'<label class="col-2" for="post">Answer 1</label>'+
					'<textarea class="form-control col-10" id="answer1">'+answer1+'</textarea>'+
					'</div>'+
					'<div class="row form-group">'+
					'<label class="col-2" for="post">Answer 2</label>'+
					'<textarea class="form-control col-10" id="answer2">'+answer2+'</textarea>'+
					'</div>'+
					'<div class="row form-group">'+
					'<label class="col-2" for="post">Answer 3</label>'+
					'<textarea class="form-control col-10" id="answer3">'+answer3+'</textarea>'+
					'</div>'+
					'<div class="row form-group">'+
					'<label class="col-2" for="post">Answer 4</label>'+
					'<textarea class="form-control col-10" id="answer4">'+answer4+'</textarea>'+
					'</div>'+
					'</div>'+
					'<div style="text-align: center;">'+
					'<button type="button" class="btn btn-info btn-delete" style= "margin-right:5px;"id="'+dem+'">Delete'+
					'</button>'+
					'<button type="button" class="btn btn-secondary" id="btnCancel">Cancel'+
					'</button>'+
					'</div>'+
					'</div>')
			}else{
				console.log('không có giá trị');
			}
			$('#question_new').val('');
			$('#answer1_new').val('');
			$('#answer2_new').val('');
			$('#answer3_new').val('');
			$('#answer4_new').val('');

			dem=dem+1;
		}
	});
</script>
<script>
	//upload va submit form
	var button = document.getElementById("btnEdit");
	button.onclick =  function(){
    //upload file
    // var files = document.getElementById("photo").files;
    // for (var i = 0; i < files.length; i++) {
    //   var file = document.getElementById("photo").files[i];
    // }
    // var folder= 'photo';
    // var img= document.getElementById('photo_link');
    var form= document.getElementById("formEdit");
    form.submit();
    // upload(file, folder, img, form);
    //  var $this = $(this);
    // loading($this);
};
</script>
@endsection