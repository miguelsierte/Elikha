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
          justify-content: flex-end; /* Align container to the right */
          align-items: flex-end; /* Align container to the bottom */

          position: relative;
        }
        
        .button {
          position: fixed;
          z-index: 999;
          width: 43px;
          height: 43px;
          background: #909090;
          border-radius: 100%;
          cursor: pointer;
          display: flex;
          justify-content: center;
          align-items: center;
          top: auto; 
          bottom: 20px; 
          right: 20px; 
          outline: none; 
        }
        
        .button:before,
        .button:after {
          position: absolute;
          content: "";
          width: 20px;
          height: 2px;
          background: #fff;
          transition: all 0.4s ease;
        }
        
        .button:before {
          transform: rotate(90deg);
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
      <i class="fa fa-plus"></i>
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
                        <label for="ticketName">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                    </div>
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
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>