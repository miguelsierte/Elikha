@extends('layout/master')
@section ('Body')
@section('Head')

@endsection

@section('Body')
@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif

  <div class="container container-fluid text-center">
    <div class="row">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center vh-100">

                <form class="form" action="{{ route('userslogin') }}" method="POST">
                    @csrf
                        @if(Session::has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ Session::get('error') }}
                            </div>
                       @endif
                        <img src="images/logo.png" class="logo" alt="...">   
                        <label>
                            <input type="email" name="email" id="email" required class="input">
                            <span>Email</span>
                        </label> 
                            
                        <label>
                            <input type="password" name="password" id="password" required class="input">
                            <span>Password</span>
                        </label>
                        <button class="submit">Log In</button>
                        <div style="text-align: center">
                          <a href="{{route('forgetpassword')}}">Forgot Password</a>
                        </div>
                        <p class="signin">Don't Have an Account? <a href="/signup">Sign Up</a> </p>
              
            </div>        
        </div>
        <div class="col " style="margin-right: 80px">
            <div class="d-flex flex-column align-items-center justify-content-center vh-100">
                <img src="images/logo1.png" class="logo1" alt="...">
                <p class="text-center mt-3" style="color: #fff">"Welcome to E-Likha, a thriving online art community born out of a shared passion 
                    for creativity and artistic expression. Founded in 2023, we are a group of artists dedicated 
                    to showcasing the beauty of visual arts to the world."</p>
            </div>
        </div>
        
    </div>

    <style>   
        .logo{
            width:100%;
            height:100%;
        }   
        .logo1{
            width:600px;
            height: 120px;
        }               
        body {
            background-image: url('images/bgsignup.png');
            background-size: cover; /* Adjust as needed */
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    
        .row.fullscreen {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Adjust the opacity (last value) as needed */
            z-index: -1; /* Place the overlay behind the content */
        }
        .form {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 350px;
        background-color: #CCCCCC;
        padding: 20px;
        border-radius: 20px;
        position: relative;
        margin-left: 100px
        
        }
        
        .title {
            font-size: 28px;
            color: royalblue;
            font-weight: 600;
            letter-spacing: -1px;
            position: relative;
            display: flex;
            align-items: center;
            
        }
        
        
        .title::after {
            width: 18px;
            height: 18px;
            animation: pulse 1s linear infinite;
        }
        
        .message, .signin {
            color: rgba(4, 4, 4, 0.822);
            font-size: 14px;
        }
        
        .signin {
            text-align: center;
        }
        
        .signin a {
            color: royalblue;
        }
        
        .signin a:hover {
            text-decoration: underline royalblue;
        }
        
        .flex {
            display: flex;
            width: 100%;
            gap: 6px;
        }
        
        .form label {
            position: relative;
        }
        
        .form label .input {
            width: 100%;
            padding: 10px 10px 20px 10px;
            outline: 0;
            border: 1px solid rgba(105, 105, 105, 0.397);
            border-radius: 10px;
        }
        
        .form label .input + span {
            position: absolute;
            left: 10px;
            top: 15px;
            color: grey;
            font-size: 0.9em;
            cursor: text;
            transition: 0.3s ease;
        }
        
        .form label .input:placeholder-shown + span {
            top: 15px;
            font-size: 0.9em;
        }
        
        .form label .input:focus + span,.form label .input:valid + span {
            top: 30px;
            font-size: 0.7em;
            font-weight: 600;
        }
        
        .form label .input:valid + span {
            color: green;
        }
        
        .submit {
            border: none;
            outline: none;
            background-color: royalblue;
            padding: 10px;
            border-radius: 20px;
            color: #fff;
            font-size: 16px;
            transform: .3s ease;
        }
        
        .submit:hover {
            background-color: rgb(56, 90, 194);
        }
    
        @keyframes pulse {
            from {
            transform: scale(0.9);
            opacity: 1;
            }
        
            to {
            transform: scale(1.8);
            opacity: 0;
            }
        }

        </style>
</div>
@endsection