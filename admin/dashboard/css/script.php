<script>
  function uploadFile(input) {
    var file = input.files[0];
    var progressbar = document.getElementById("progressbar");
    var progressLabel = document.getElementById("progress-label");

    var formData = new FormData();
    formData.append("photo", file);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "upload.php", true);

    xhr.upload.onprogress = function(e) {
      if (e.lengthComputable) {
        var progress = Math.round((e.loaded / e.total) * 100);
        progressbar.value = progress;
        progressLabel.innerHTML = progress + "%";
      }
    };

    xhr.onload = function() {
      // Proses selesai
      if (xhr.status === 200) {
        var response = xhr.responseText;
        // Tindakan setelah selesai mengunggah foto
      }
    };

    xhr.send(formData);
  }
</script>

<script>
  var fileInput = document.getElementById('photo');
  var progressBar = document.querySelector('.progress-bar');

  fileInput.addEventListener('change', function() {
    var file = this.files[0];
    var fileSize = file.size;

    var reader = new FileReader();

    reader.onloadend = function() {
      // Mengupdate nilai progress bar saat proses upload berlangsung
      var progress = Math.round((reader.loaded / fileSize) * 100);
      progressBar.style.width = progress + '%';
      progressBar.innerHTML = progress + '%';

      if (progress === 100) {
        progressBar.innerHTML = 'Upload Complete';
      }
    }

    reader.readAsDataURL(file);
  });
</script>

