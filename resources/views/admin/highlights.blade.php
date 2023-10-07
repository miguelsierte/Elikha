<?php $page = 'highlights';?> @include ('inc.navadmin')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ELikha</title>
    <link href="style.css" rel="stylesheet">
    <style>
    body 
    {
        background-color: #EEEEEE;
        color: #535353;
        
    }
    .highlight-image {
    width: 800px; /* Set the desired width */
    height: 250px; /* Set the desired height */
    margin-bottom: 20px; /* Add some margin for spacing between images */
    overflow: hidden; /* Hide any excess image content beyond the specified dimensions */
    margin: 10px auto; /* Center the container horizontally and add margin top and bottom */

}

/* CSS for images */
.highlight-image img {
    width: 100%; /* Make sure the image occupies the entire container */
    height: auto; /* Automatically adjust the height to maintain aspect ratio */
}
    </style>
</head>
</div>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="mb-0" style="font-family:Helvetica Neue">Dashboard</h1>
                <a class="dropdown d-none d-sm-inline-block" style="position: relative; left: 1050px;">
                <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="prof.png" alt="" width="32" height="32" class="rounded-circle me-2">
                  <strong style="color:#535353">{{ Auth::user()->name }}</strong>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                    @csrf
                    @method('delete')
                </form>
                </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-mb-8">
                <div class="card shadow mb-8 h-100 p-3 w-100">
                    <div class="row align-items-center">
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">Highlights</h2>
                        <div class="card-body" style="text-align: center !important;">
                            @if ($highlightsData)
                                <div class="highlight-image">
                                    <img src="{{ asset('storage/images/' . $highlightsData->highlight1) }}" alt="Highlight 1">
                                </div>
                                <div class="highlight-image">
                                    <img src="{{ asset('storage/images/' . $highlightsData->highlight2) }}" alt="Highlight 2">
                                </div>
                                <div class="highlight-image">
                                    <img src="{{ asset('storage/images/' . $highlightsData->highlight3) }}" alt="Highlight 3">
                                </div>
                            @else
                                <p>No highlights data available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-mb-8">
                <div class="card shadow mb-8 h-100 p-3 w-100">
                    <div class="row no-gutters align-items-center">
                        <h2 class="mb-1" style="color: #535353; font-family:Helvetica Neue">Upload Higlights</h2>
                        <div class="card-body">
                            @if(Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                            <form method="POST" action="{{ route('highlights') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="highlight1">Highlight 1 (Landscape 800 x 250 px)</label>
                                    <input type="file" name="highlight1" id="highlight1" class="form-control" style="width: 350px;" required>
                                    <img id="preview1" src="#" alt="Image Preview" style="max-width: 200px; max-height: 200px; display: none;">
                                </div>
                                <div class="form-group">
                                    <label for="highlight2">Highlight 2 (Landscape 800 x 250 px)</label>
                                    <input type="file" name="highlight2" id="highlight2" class="form-control" style="width: 350px;" required>
                                    <img id="preview2" src="#" alt="Image Preview" style="max-width: 200px; max-height: 200px; display: none;">
                                </div>
                                <div class="form-group">
                                    <label for="highlight3">Highlight 3 (Landscape 800 x 250 px)</label>
                                    <input type="file" name="highlight3" id="highlight3" class="form-control" style="width: 350px;" required>
                                    <img id="preview3" src="#" alt="Image Preview" style="max-width: 200px; max-height: 200px; display: none;">
                                </div>
                                <button type="submit" class="btn btn-outline-dark">Upload</button>
                            </form>
                            <script>
                                
$(document).ready(function () {
    $('#highlights').on('submit', function (e) {
        if ($('#highlight1').val() === '' || $('#highlight2').val() === '' || $('#highlight3').val() === '') {
            e.preventDefault(); // Prevent form submission
            alert('Please select images for all highlights.');
        }
    });
});

                            $(document).ready(function () {
                                function readURL(input, previewId) {
                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();
                            
                                        reader.onload = function (e) {
                                            $(previewId).attr('src', e.target.result).show();
                                        };
                            
                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }
                            
                                $('#highlight1').change(function () {
                                    readURL(this, '#preview1');
                                });
                            
                                $('#highlight2').change(function () {
                                    readURL(this, '#preview2');
                                });
                            
                                $('#highlight3').change(function () {
                                    readURL(this, '#preview3');
                                });
                            });
                        </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
