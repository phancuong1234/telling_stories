@extends('index')

@section('content')
<div id="container">
	<h3>Upload file</h3>
	{{-- <input type="file" id="fileButton" name=""> --}}
	
	{{-- <form  method="post" enctype="multipart/form-data" id="hh">
		{{csrf_field()}} --}}
		<div class="image-upload">
			<label for="fileButton">
				<img src="{{ asset('/images/admin.jpg') }}" alt="avatar" class="user-avatar" id="photo">
			</label>

			<input id="fileButton" type="file"  name="avatar" style="display: none;" {{-- onchange="readURL(this);" --}} />

		</div>
		<progress id="progressBar" value="0" max="100" style="width:170px;"></progress>
		<button  class="btn-sm btn btn-primary" id="change_avatar">Update</button>

	{{-- </form> --}}
{{-- 	<div id="loaded">
		<div id="main">
			<div id="user-signed-in">
				<div id="user-info">
					<div id="photo-container">
						<img id="photo">
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div> --}}

</div>
<script type="text/javascript">
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
</script>
<script>
	var button = document.getElementById("change_avatar");
	button.onclick =  function(){

		var firebaseConfig = {
			apiKey: "AIzaSyDXyVsElWy9tutAqe9IDYVqmctDcdYC7g",
			authDomain: "story-255509.firebaseapp.com",
			databaseURL: "https://story-255509.firebaseio.com",
			storageBucket: "story-255509.appspot.com",
		};
		//firebase.initializeApp(firebaseConfig);
		if (!firebase.apps.length) {
			firebase.initializeApp(firebaseConfig);
		}
  // Get a reference to the storage service, which is used to create references in your storage bucket
  var storage = firebase.storage();
  var files = document.getElementById("fileButton").files;
  for (var i = 0; i < files.length; i++) {
  	var file = document.getElementById("fileButton").files[i];
  }
  
  console.log(file);

//console.log(file);
// Points to the root reference
var storageRef = firebase.storage().ref();
// Create the file metadata
var metadata = {
	contentType: 'image/jpg'
};

// Upload file and metadata to the object 'images/mountains.jpg'
var uploadTask = storageRef.child('avatar/' + file.name).put(file, metadata);
console.log('Upload');
// Listen for state changes, errors, and completion of the upload.
uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED, // or 'state_changed'
	function(snapshot) {
    // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
    var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
    console.log('Upload is ' + progress + '% done');
    switch (snapshot.state) {
      case firebase.storage.TaskState.PAUSED: // or 'paused'
      console.log('Upload is paused');
      break;
      case firebase.storage.TaskState.RUNNING: // or 'running'
      console.log('Upload is running');
      break;
  }
}, function(error) {

  // A full list of error codes is available at
  // https://firebase.google.com/docs/storage/web/handle-errors
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
}, function() {
  // Upload completed successfully, now we can get the download URL
  uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
  	console.log('File available at', downloadURL);
  });
});

};
</script>
@endsection