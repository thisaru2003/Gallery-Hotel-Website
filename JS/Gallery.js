function openModal(element) {
    // Create a new Image object
    var img = new Image();

    // Set the src to the same as the clicked element
    img.src = element.src;

    // Once the image is loaded, display the modal and set the dimensions
    img.onload = function() {
        // Get original dimensions
        var originalWidth = img.naturalWidth;
        var originalHeight = img.naturalHeight;

        // Set the modal content
        document.getElementById("modal").style.display = "block";
        document.getElementById("modal-image").src = element.src;
        document.getElementById("caption").innerHTML = 
            "Original Dimensions: " + originalWidth + " x " + originalHeight;

        // Optional: You can also set the modal image dimensions if desired
        document.getElementById("modal-image").style.width = originalWidth + 'px';
        document.getElementById("modal-image").style.height = originalHeight + 'px';
    }
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}
