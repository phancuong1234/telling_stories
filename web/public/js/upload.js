$(document).ready(function(){
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

  });

function readURL(input,id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      id
      .attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function loading($this)
{
  var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
  if ($(this).html() !== loadingText) {
    $this.data('original-text', $(this).html());
    $this.html(loadingText);
    var div= document.createElement("div");
    div.className += "overlay";
    document.body.appendChild(div);
  }

  setTimeout(function() {
    $this.html($this.data('original-text'));
  }, 4000);
}
function upload(file, folder, img, form)
{
  var storage = firebase.storage();
    // Points to the root reference
    var storageRef = firebase.storage().ref();
// Create the file metadata
var metadata = {
  contentType: 'image/jpg'//video/mp4
};

// Upload file and metadata to the object 'images/mountains.jpg'
var uploadTask = storageRef.child(folder+'/' + file.name).put(file, metadata);
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
    img.value= downloadURL;
    form.submit();
  });

});
}