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
