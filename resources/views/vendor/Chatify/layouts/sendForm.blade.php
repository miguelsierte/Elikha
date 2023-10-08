<div class="messenger-sendCard">
    <form id="message-form" method="POST" action="{{ route('send.message') }}" enctype="multipart/form-data">
        @csrf
        <label><span class="fas fa-plus-circle"></span><input disabled='disabled' type="file" class="upload-attachment" name="file" accept=".{{implode(', .',config('chatify.attachments.allowed_images'))}}, .{{implode(', .',config('chatify.attachments.allowed_files'))}}" /></label>
        <button class="emoji-button"></span><span class="fas fa-smile"></button>
        <textarea readonly='readonly' name="message" class="m-send app-scroll" placeholder="Type a message.."></textarea>
         <!-- Button to send GCash QR Code -->
    @if (auth()->user()->role == 'Artist')
  
    <<button
    id="sendGCashQRButton"
    type="button"
    class="send-button btn btn-outline-success btn-sm"
    data-gcash-image="{{ asset($verifies->gcash) }}"
    onclick="attachGCashQRCode()"
>
    Send GCash QR Code
</button>
    <input type="hidden" id="gcashImageInput" name="gcash_image" value="">
@endif
        <button disabled='disabled' class="send-button"><span class="fas fa-paper-plane"></span></button>
    </form>

    <script>
        // Function to populate the textarea with the message
        function populateTextareaWithMessage() {
            const messageTextarea = document.querySelector('textarea[name="message"]');
            // Compose the message
            const message = "Good Day! Please send the amount to my GCash Account. Below is my QR Code:\n\n";
            // Set the message in the textarea
            messageTextarea.value = message;

            function attachGCashQRCode() {
    // Retrieve the GCash image URL from the data attribute
    const gcashImageSrc = document.getElementById('sendGCashQRButton').getAttribute('data-gcash-image');

    // Set the value of a hidden input element in the form
    document.getElementById('gcashImageInput').value = gcashImageSrc;

    // Submit the form
    document.getElementById('message-form').submit();
}
        }
    
        // Add a click event listener to the "Send GCash QR Code" button
        document.getElementById('sendGCashQRButton').addEventListener('click', populateTextareaWithMessage);
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</div>
