@extends('index')

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
         <form action="{{ route('story.store') }}" method="post" accept-charset="utf-8">
          @csrf

          <div class="row form-group">
           <label class="col-2" for="post">Name</label>
           <input class="form-control col-8" type="text" name="name" value="" id="name" placeholder="Name">
         </div>
         <div class="row form-group">
           <label class="col-2" for="post">Photo</label>
           <input type="file" name="photo" value="" id="photo">
           <img src="" alt="avatar" class="user-avatar" id="avatar" style="width:80px;height:100px;display: none;" >
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
          <input type="file" accept="video/*"/ name= "video" id="video">
          <video width="250" height="200" controls id="show_video" style="display: none;">
            <source src="" type="video/mp4">
            </video>

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
<script type="text/javascript">
  $(document).ready(function(){
    function readURL(input) {
      if (input.files && input.files[0]) {
        $('#avatar').show();
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#avatar')
          .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#photo").change(function() {

      readURL(this);
    });

  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    function readURL(input) {
      if (input.files && input.files[0]) {
        $('#show_video').show();
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#show_video')
          .attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
    $("#video").change(function() {

      readURL(this);
    });

  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    var array= [];
    var dem = 0;
    $('#show_add').click(function(){
      $('#form_add').show();
      $('#show_add').hide();

    });
    $('#btnPush').click(function(){
     add();

   })
    function add(){
      var question= $('#question').val();
      var answer1= $('#answer1').val();
      var answer2= $('#answer2').val();
      var answer3= $('#answer3').val();
      var answer4= $('#answer4').val();

      var qs1 = "<input type='hidden' name='list_question["+ dem +"][]' value='"+question+"'/>";
      var as1 = "<input type='hidden' name='list_question["+ dem +"][]' value='"+answer1+"'/>";
      var as2 = "<input type='hidden' name='list_question["+ dem +"][]' value='"+answer2+"'/>";
      var as3 = "<input type='hidden' name='list_question["+ dem +"][]' value='"+answer3+"'/>";
      var as4 = "<input type='hidden' name='list_question["+ dem +"][]' value='"+answer4+"'/>";           // Create element with HTML
      // var txt2 = $("<i></i>").text("love ");  // Create with jQuery

      $("#show_add").after(qs1,as1,as2,as3,as4);
      // element.attr({
      //   type: 'hidden',
      //   name: 'list_question'+'['+dem+']'+'[]'
      // });
      // document.createElement("input").attr({
      //   type: 'hidden',
      //   name: 'list_question'+'['+dem+']'+'[]'
      // });
      // var a = [question, answer1,answer2,answer3,answer4];
      // array.push(a);
      // console.log(element);
      $('#list_question').val(array);
      $('#question_added').append('<div class="row"><input class="form-control col-7" type="text" value="'+question+'" id= "">'+'<button type="button" class="btn btn-success">'+'Delete'
        +'</button></div>')
      $('#question').val('');
      $('#answer1').val('');
      $('#answer2').val('');
      $('#answer3').val('');
      $('#answer4').val('');
      dem=dem+1;
    }
    $('#btnCreate').click(function(){
      $(this).parents('form:first').submit();
    });
  });
</script>
{{--  <script type="text/javascript">
	$(document).ready(function(){
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();

				reader.onload = function (e) {
					$('#photo')
					.attr('src', e.target.result);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
		$("#fileButton").change(function() {

			readURL(this);
		});

	});
</script> --}}



{{-- <script>
	(function() {
		console.log('connect to firebase');

    // Initialize Firebase
    var firebaseConfig = {
    	apiKey: "AIzaSyDXyVsElWy9tutAqe9IDYVqmctDcdYC7g",
    	authDomain: "story-255509.firebaseapp.com",
    	databaseURL: "https://story-255509.firebaseio.com",
    	storageBucket: "story-255509.appspot.com",
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);
    var database = firebase.database();


    /**
     * Initializes the app.
     */
     var initApp = function() {

     	const fileButton = document.getElementById('fileButton');

     	if (!!fileButton) {

     		fileButton.addEventListener('change', function(e) {

     			uploadFile(e.target.files[0])

     		});
     	}


     };

     function uploadFile(file) {

        // var newMetadata = {
        //   cacheControl: 'public,max-age=300',
        //   contentType: 'image/jpeg',
        //   contentLanguage: null,
        //   customMetadata: {
        //     whatever: 'we feel like',
        //   },
        // };

        // Create the file metadata
        var metadata = {
        	contentType: 'image/jpeg',
        };
        var uploadTask = firebase.storage().ref('avatar/' + Date.now()).put(file, metadata);

        // Listen for state changes, errors, and completion of the upload.
        uploadTask.on(
            firebase.storage.TaskEvent.STATE_CHANGED, // or 'state_changed'
            function(snapshot) {
                // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                var progress = snapshot.bytesTransferred / snapshot.totalBytes * 100;
                progressBar.value = progress;
                console.log('Upload is ' + progress + '% done');
                switch (snapshot.state) {
                    case firebase.storage.TaskState.PAUSED: // or 'paused'
                    console.log('Upload is paused');
                    break;
                    case firebase.storage.TaskState.RUNNING: // or 'running'
                    console.log('Upload is running');
                    break;
                  }
                },
                function(error) {
                // Errors list: https://firebase.google.com/docs/storage/web/handle-errors
                switch (error.code) {
                	case 'storage/unauthorized':
                        // User doesn't have permission to access the object
                        break;

                        case 'storage/canceled':
                        // User canceled the upload
                        break;

                        case 'storage/unknown':
                        // Unknown error occurred, inspect error.serverResponse
                        break;
                      }
                    },
                    function() {
                // Upload completed successfully, now we can get the download URL

                uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
                	console.log('File available at', downloadURL);
                	var _img = document.getElementById('photo');
                	var newImg = new Image;
                	newImg.onload = function() {
                		_img.src = this.src;
                	}
                	newImg.src = downloadURL;
                	document.getElementById('avatar').value= downloadURL;
                });

              }
              );
      }


      window.addEventListener('load', initApp);

    }())
  </script> --}}
  @endsection