@extends('index')

@section('content')
<div class="animated fadeIn">
	<div class="row">

		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong class="card-title">Create User</strong>
				</div>
				<div class="card-body">
					@if($errors)
					@foreach($errors->all() as $message)
					<div class="alert alert-danger">{{ $message }}</div>
					@endforeach
					@endif
					<form action="{{ route('user.update',$record->id) }}" method="post" accept-charset="utf-8">
						@csrf
						<div class="row">
							<div class="image-upload col-3" style="margin-bottom: 50px;">
								<label for="fileButton">
									<img @if(!empty($record->avatar)) src="{{$record->avatar}}" @else src="/images/admin.jpg" @endif alt="avatar" class="user-avatar" id="photo" style="border-radius: 50%;width: 150%;height: 150%;">
								</label>
								<input id="fileButton" type="file" style="display: none;"/>
								<input class="form-control col-8" type="text" name="avatar" value="{{$record->avatar}}" id="avatar" style="display: none;">
							</div>
							<div class="col-9 ">
								<div class="row form-group">
									<label class="col-2" for="post">Name</label>
									<input class="form-control col-8" type="text" name="name" value="{{$record->name}}" id="name" placeholder="Name">
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Email</label>
									<input class="form-control col-8" type="email" name="email" value="{{$record->email}}" id="name">
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Gender</label>
									<div class="col-8 form-group">
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="male" name="gender" value="1" @if ($record->gender == 1)? checked :0
											@endif>
											<label class="custom-control-label" for="male">Male</label>
										</div>

										<!-- Default inline 2-->
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" class="custom-control-input" id="female" name="gender" value="2" @if ($record->gender == 2)? checked : 0
											@endif>
											<label class="custom-control-label" for="female">Female</label>
										</div>
									</div>
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Birthday</label>
									<input class="form-control col-8" type="date" name="birthday" value="{{$record->birthday}}" id="name">
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Address</label>
									<input class="form-control col-8" type="text" name="address" value="{{$record->address}}" id="name">
								</div>
								<div class="row form-group">
									<label class="col-2" for="post">Role</label>
									<!-- Group of default radios - option 1 -->
									<div class="col-10">
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="defaultGroupExample1" name="role" value="1" @if ($record->role_id == 1)? checked :0 @endif>
											<label class="custom-control-label" for="defaultGroupExample1">Admin</label>
										</div>

										<!-- Group of default radios - option 2 -->
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="defaultGroupExample2" name="role" value="2" @if ($record->role_id == 2)? checked :0 @endif>
											<label class="custom-control-label" for="defaultGroupExample2">Mod</label>
										</div>

										<!-- Group of default radios - option 3 -->
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="defaultGroupExample3" name="role" value="3" @if ($record->role_id == 3)? checked :0 @endif>
											<label class="custom-control-label" for="defaultGroupExample3">User</label>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer" style="justify-content: 
            center;">
							<a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
							<button type="submit" class="btn btn-info" id="submit">Edit
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>


	</div>
</div><!-- .animated -->
{{-- ss --}}
{{-- <script>
	var button = document.getElementById("submit");
	(function(){
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




  var file = 

// Create the file metadata
var metadata = {
	contentType: 'image/jpeg'
};

// Upload file and metadata to the object 'images/mountains.jpg'
var uploadTask = storageRef.child('images/' + file.name).put(file, metadata);

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
</script> --}}



<script>
	(function() {
		// var myFile = document.getElementById('photo').src;
		// console.log(myFile);
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
        var uploadTask = firebase.storage().ref('avatar/' + Date.now()+'_'+file.name).put(file, metadata);

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
  </script>
  @endsection