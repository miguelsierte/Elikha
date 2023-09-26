@if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
<form class="form" action="{{ route('userslogin') }}" method="POST">
  @csrf
  <style>
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
      }</style>
 <p class="message">E-Likha</p>
    <p class="message">Signup now and get full access to the website. </p>
<label></label>
            
    <label>
        <input type="email" name="email" id="email" required class="input">
        <span>Email</span>
    </label> 
        
    <label>
        <input type="password" name="password" id="password" required class="input">
        <span>Password</span>
    </label>
    <button class="submit">Log In</button>
    <div>
      <a href="{{route('forgetpassword')}}">Forgot Password</a>
    </div>
    <p class="signin">Don't Have an Account? <a href="/signup">Sign Up</a> </p>
</form>