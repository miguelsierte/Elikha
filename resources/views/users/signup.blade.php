@extends('layout/master')

@section('Body')
   
<div class="container container-fluid text-center">
  <div class="row">
    <div class="col">
      <br><br><br>
      <td class="align-center">@include('users.signupForm')</td>
      <br><br><br>
    </div>
     
    <div class="col-md-6 my-col "style="background-color: #f2f2f2;">
              <div class="my-content">
              <p class="align-baseline fs-1 " style="font-family:Helvetica Neue">E-Likha</p>
              <p class="align-middle lh-small" style="font-family:Helvetica Neue">Welcome to my hiking website, 
                  where I share my love for exploring the great outdoors. 
                  If you're a fellow hiker or just looking for some inspiration for
                   your next adventure, you've come to the right place.</p>
            </div>
            <style>
            .my-col {
              display: flex;
              align-items: center;
              justify-content: center;
              
              padding-bottom: 0
              
            }
            
            .my-content {
              text-align: center;
            }
            
            </style>
            
            
            </div>
           
    </div>

  
@endsection