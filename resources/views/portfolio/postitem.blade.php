@extends('layout.master')
@section('Header')
        
@include('artistinc.navbar')
@include('artistinc.popup')
@endsection

@section('Body')
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container container-fluid text-align:center  " style="padding-left:100px; padding-right:100px ;" >
    <a href="javascript:history.back()">
        <img src="images/back.png" alt="Image" style="width: 40px; height: 25px;"/></a>
<br><br>
    <h2>Create Auction</h2><br>
    <form action="{{ route('postitem') }}" method="POST" enctype="multipart/form-data">
<div class="row">
  <div class="col">
    <h6>Upload Photo</h6>
    <input class="form-control" type="file" id="image" name="image" onchange="displayImage()">
    <img id="uploadedImage" style="max-width: 100%" class="img-fluid" style="max-width: 500px; max-height: 500px">
  </div>
  
  <script>
    function displayImage() {
      const fileInput = document.getElementById('image');
      const uploadedImage = document.getElementById('uploadedImage');
      const file = fileInput.files[0];
      const reader = new FileReader();
  
      reader.onload = function (e) {
        uploadedImage.src = e.target.result;
      };
  
      reader.readAsDataURL(file);
    }
  </script>

  @csrf
 <div class="col">
    <h6>Title</h6>
    <input required type="text" name="title" id="title" class="form-control" placeholder="Title" ><br>
    <h6>Dimension</h6>
    <input required type="text" name="dimension" id="dimension" class="form-control" placeholder="Height x Width in cm" ><br>
    <h6>Starting Bid</h6>
    <input required type="text" name="start_price" id="start_price" class="form-control" placeholder="Starting Bid in Peso" ><br>
    <h6>Starting date of Bidding</h6>
      <div class="row">
          <div class="col-md-4">
              <input type="date" class="form-control" name="start_date" id="start_date" style="width: 120px"/>
          </div>
      </div>
   <h6>Ending date of Bidding</h6>
      <div class="row">
          <div class="col-md-4">
              <input type="date" class="form-control" name="end_date" id="end_date" style="width: 120px" />
          </div>
      </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

   <script>
    document.addEventListener('DOMContentLoaded', function(e) {
    $('[name="date"]')
        .datepicker({
            format: 'dd/mm/yyyy'
        })
        .on('changeDate', function(e) {
            // do somwthing here
        });
});
.fa {
    position: absolute;
    right: 25px;
    top: 11px;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
   </script>
 </div>
 
 <div class="col">
  <h6>Category</h6>
      <select type="type" name="category_id" id="category_id" class="form-control" required>
      <option value="1">Pop Art</option>
      <option value="2">Realism</option>
      <option value="3">Portrait</option>
      <option value="4">Abstract</option>
      <option value="5">Expressionism</option>
      <option value="6">Expressionism</option>
      <option value="7">Photorealism</option>
      </select>

      <style>
        .dropdown-toggle {
          width: 400px; /* set a fixed width for the button */
        }
        .dropdown-menu {
            width: 400px;
        }
        
        </style>
      
      <script>
      $(document).ready(function() {
        $('.dropdown-item').click(function() {
          var selectedItem = $(this).text();
          $('#dropdownMenuButton').text(selectedItem);
        });
      });
      </script>
      
      
    <br>
    <h6>Description</h6>
    <textarea class="form-control"  name="description" id="description" rows="6" placeholder="Description"></textarea>
    <br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-middle">
        <a href="javascript:history.back()">
    <button class="btn btn-outline-danger" type="button">Cancel</button></a>
    <input type="submit" value="Post" class="btn btn-outline-primary">
    </div>
  </form>
 </div>
</div>
</div>


@endsection-->