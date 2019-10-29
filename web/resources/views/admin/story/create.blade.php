@extends('index')

@section('css')
<link rel="stylesheet" href="{{ asset('css/upload.css') }}">
</style>
@endsection

@section('content')
<div class="animated fadeIn">
	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
            <strong class="card-title">Create Story</strong>
          </div>
        </div>
        <div class="card-body">
         @if($errors)
         @foreach($errors->all() as $message)
         <div class="alert alert-danger">{{ $message }}</div>
         @endforeach
         @endif
         <form action="{{ route('story.store') }}" method="post" accept-charset="utf-8" id= "formCreate">
          @csrf

          <div class="row form-group">
           <label class="col-2" for="post">Name</label>
           <input class="form-control col-8" type="text" name="name" value="" id="name" placeholder="Name">
         </div>
         <div class="row form-group">
           <label class="col-2" for="post">Photo</label>
           <input type="file" name="photo" value="" id="photo">
           <img src="" alt="avatar" class="user-avatar" id="avatar" style="width:80px;height:100px;display: none;" >
           <input type="text" name="photo" value="" id="photo_link" style="display: none;">
         </div>
         <div class="row form-group">
           <label class="col-2" for="post">Description</label>
           <input class="form-control col-8" type="text" name="description" value="" id="name" placeholder="description">
         </div>
         <div class="row form-group">
           <label class="col-2" for="category">Category</label>
           <select class="form-control col-8" id="category" name= "category">
            @if ($list_category)
            @foreach ($list_category as $element)
            <option value="{{$element->id}}">{{$element->name}}</option>
            @endforeach
            @endif
          </select>
        </div>
        <div class="row form-group">
          <label class="col-2" for="post">Video</label>
          <input class="form-control col-8" type="text" name="video" value="" id="video" placeholder="Link Video">
        </div>
        <div class="row form-group">
          <label class="col-2" for="age">Age</label>
          <select multiple  class="form-control col-8" id="age" name= "age[]">
           @if ($ages)
           @foreach ($ages as $element)
           <option value="{{$element->id}}">{{$element->age}}</option>
           @endforeach
           @endif
         </select>
       </div>
       <div class="row form-group">
        <label class="col-2" for="post">Views</label>
        <input class="form-control col-3" type="text" name="views" value="" id="views" placeholder="Count views">
      </div>
      <div class="row form-group">
        <label class="col-2" for="question">Question</label>
        <div class="col-8">
          <div id= "question_added" style="margin-bottom: 20px;">

          </div>
          <div id= "form_add" name= 'list[]'>
            <div>
              <div>
               <div class="row form-group">
                <label class="col-2" for="post">Question</label>
                <textarea class="form-control col-10" id="question" placeholder="Question"></textarea>
              </div>
              <div class="row form-group">
                <label class="col-2" for="post">Answer 1</label>
                <textarea class="form-control col-10" id="answer1" placeholder="Answer 1"></textarea>
              </div>
              <div class="row form-group">
                <label class="col-2" for="post">Answer 2</label>
                <textarea class="form-control col-10" id="answer2" placeholder="Answer 2"></textarea>
              </div>
              <div class="row form-group">
                <label class="col-2" for="post">Answer 3</label>
                <textarea class="form-control col-10" id="answer3" placeholder="Answer 3"></textarea>
              </div>
              <div class="row form-group">
                <label class="col-2" for="post">Answer 4</label>
                <textarea class="form-control col-10" id="answer4" placeholder="Answer 4"></textarea>
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
     <button type="button" class="btn btn-success" id="btnCreate">Create
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
<script type="text/javascript">

</script>
@endsection
<script type="text/javascript">
  $(document).ready(function(){
    $("#photo").change(function() {
      $('#avatar').show();
      avatar= $('#avatar');
      readURL(this,avatar);
    });
    $("#video").change(function() {
      $('#show_video').show();
      show_video= $('#show_video');
      readURL(this, show_video);
    });

  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var dem = 0;
    $('#btnPush').click(function(){
     add();
     $('.btn-delete').click(function(event) {
      let id = $(this)[0].id;
      $("#"+id).remove();
      $("."+id).remove();
    });
   });
    $('#btnCancel').click(function(){
      $('#question').val('');
      $('#answer1').val('');
      $('#answer2').val('');
      $('#answer3').val('');
      $('#answer4').val('');
    });
    function add(){
      var question= $('#question').val();
      var answer1= $('#answer1').val();
      var answer2= $('#answer2').val();
      var answer3= $('#answer3').val();
      var answer4= $('#answer4').val();

      var qs1 = "<input type='hidden' class="+dem+" name='list_question["+ dem +"][]' value='"+question+"'/>";
      var as1 = "<input type='hidden' class="+dem+" name='list_question["+ dem +"][]' value='"+answer1+"'/>";
      var as2 = "<input type='hidden' class="+dem+" name='list_question["+ dem +"][]' value='"+answer2+"'/>";
      var as3 = "<input type='hidden' class="+dem+" name='list_question["+ dem +"][]' value='"+answer3+"'/>";
      var as4 = "<input type='hidden' class="+dem+" name='list_question["+ dem +"][]' value='"+answer4+"'/>";

      if(question != '' && answer1 != '' && answer2 != '' && answer3 != '' && answer4 != ''){
       $("#question_added").after(qs1,as1,as2,as3,as4);
       $('#question_added').append('<div class="row" id= "'+dem+'"><input class="form-control" type="text" value="'+question+'" >'+'<button type="button" class="btn btn-success btn-delete" style= "margin-top:10px;margin-bottom:10px;" id="'+dem+'">'+'Delete'
        +'</button></div>')
     }else{
      console.log('không có giá trị');
    }
    $('#question').val('');
    $('#answer1').val('');
    $('#answer2').val('');
    $('#answer3').val('');
    $('#answer4').val('');

    dem=dem+1;
  }
});
</script>

<script>
  var button = document.getElementById("btnCreate");
  button.onclick =  function(){
    // //upload file
    var files = document.getElementById("photo").files;
    for (var i = 0; i < files.length; i++) {
      var file = document.getElementById("photo").files[i];
    }
    var folder= 'photo';
    var img= document.getElementById('photo_link');
    var form= document.getElementById("formCreate");
    upload(file, folder, img, form);
    var $this = $(this);
    //form.submit();
    loading($this);
  };
</script>

@endsection