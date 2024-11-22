<script>
    function SelectFileFrontCkFinder(){
        CKFinder.popup({
            chooseFiles: true,
            onInit: function(finder) {
                finder.on('files:choose', function(evt) {
                    var file = evt.data.files.first();
                    var output = document.getElementById('cccdFrontPreview');
                    var hiddenInput = document.getElementById('cccdFrontInput');
                    
                  
                    output.src = file.getUrl();
                    hiddenInput.value = file.getUrl();  
                });

                finder.on('file:choose:resizedImage', function(evt) {
                    var output = document.getElementById('cccdFrontPreview');
                    var hiddenInput = document.getElementById('cccdFrontInput');


                    output.src = evt.data.resizedUrl;
                    hiddenInput.value = evt.data.resizedUrl;  
                });
            }
        });
    }
      function selectFileWithCKFinder() {
        CKFinder.popup({
            chooseFiles: true,
            onInit: function(finder) {
                finder.on('files:choose', function(evt) {
                    var file = evt.data.files.first();
                    var output = document.getElementById('cccdBackPreview');
                    var hiddenInput = document.getElementById('cccdBackInput');
                    
                    // Set selected file's URL to image preview and hidden input
                    output.src = file.getUrl();
                    hiddenInput.value = file.getUrl();  // Save URL to hidden input
                });

                finder.on('file:choose:resizedImage', function(evt) {
                    var output = document.getElementById('cccdBackPreview');
                    var hiddenInput = document.getElementById('cccdBackInput');

                    // Set resized image's URL to image preview and hidden input
                    output.src = evt.data.resizedUrl;
                    hiddenInput.value = evt.data.resizedUrl;  // Save URL to hidden input
                });
            }
        });
    }
</script>