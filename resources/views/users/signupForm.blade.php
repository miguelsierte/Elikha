<form class="form" action="{{ route('signup') }}" method="POST">
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
        padding-left: 30px;
      }
      
      
      .title::before {
        width: 18px;
        height: 18px;
        background-color: royalblue;
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
      
      .form label .input  {
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
      
      .form label .input:placeholder-shown + span  {
        top: 15px;
        font-size: 0.9em;
      }
      
      .form label .input:focus + span,.form label  .input:valid + span {
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
      .dropdown-toggle {
          width: 200px; /* set a fixed width for the button */
        }
        </style>
        @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{Session::get('success')}}
        </div>
    @endif
   <h1>E-Likha</h1>
    <p class="message">Signup now and get full access to the website. </p>
      <label>Are you a Buyer or Artist?</label>
      <select type="type" name="role" id="role" class="form-control" required>
          <option value="2">Artist</option>
          <option value="3">Buyer</option>
      </select>
        <label>
          <input type="text" name="name" id="name" class="input" required>
          <span>Full Name</span>
        </label>
      <label>
        <input required type="email" class="input" id="email" name="email">
        <span>Email</span>
      </label>
      <label>
        <input required type="password" class="input" id="password" name="password">
        <span>Password</span>
      </label>
      <label>
        <input required type="password" class="input" id="name" name="password_confirmation">
        <span>Confirm password</span>
      </label>
      <button class="submit">Submit</button>
      <p class="signin">Already have an account? <a href="/userslogin">Log In</a></p>
    </form>