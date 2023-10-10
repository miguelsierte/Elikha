<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
      @import url("https://fonts.googleapis.com/css?family=Roboto");
      
      .item-container {
        width: 20%;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
        position: relative;
      }
      
      .button {
        position: fixed;
        z-index: 999;
        width: 43px;
        height: 43px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        top: auto; 
        bottom: 20px; 
        right: 20px; 
        outline: none;
        background: none; /* Remove background color */
        border: none; /* Remove border */
        padding: 0; /* Remove padding */
      }
      
      .button img {
        max-width: 100%; /* Ensure the image doesn't exceed the button's size */
      }
      
      @media (max-width: 640px) {
        .container {
          width: 100%;
        }
      }
  </style>
</head>
<body class="item-body">
    <button data-toggle="modal" data-target="#ticketModal" class="button">
   <img src="{{ asset('images\technical-support-icon-png-27_1_1_10.png') }}" alt="Logo">
    </button>
    
<!--ticekmodal-->

<div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="ticketModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ticketModalLabel">Ticket Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('popup') }}" method="POST" enctype="multipart/form-data">
                @csrf
            <div class="modal-body">

                    <div class="form-group">
                        <label for="ticketName">Subject</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                    <div class="form-group">
                        <label for="ticketDescription">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
