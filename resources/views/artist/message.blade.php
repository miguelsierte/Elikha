@extends ('artistlayouts.master')
        @section('header')
        
        @include('artistinc.navbar')
        <link rel="stylesheet" href={{asset('artistcss/message.css')}}>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

     
    
    
       
        
    
        <link rel='stylesheet' id='roboto-subset.css-css'  href='https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5' type='text/css' media='all' />
        <title>Home - @yield('title')</title>
@endsection
  
        @section('body')
        <main class="mt-4">
            <div class="container-fluid">
                <div class="row">
                    {{-- left column --}}
                    <div class="col-md-3">
                        <div class="d-flex justify-content-between">
                        <p class="ms-3"><strong>Your Contacts</strong></p>
                    <div>
                        <button type="button" class="btn btn-link" data-mdb-ripple-color="dark"><i class="fas fa-edit"></i></button>
                    </div>   
                    </div>
                    <div class="list-group list-group-light list-group-naked">
                        <a href="#" class="list-group-item list-group-item-action px-3 border-0 active text-reset" aria-current="true">
                          <img src="https://mdbootstrap.com/img/new/avatars/2.jpg" alt="" class="border rounded-circle" style="height: 40px;">
                        <strong>   </strong>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action px-3 border-0 active text-reset" aria-current="true">
                            <img src="https://mdbootstrap.com/img/new/avatars/1.jpg" alt="" class="border rounded-circle" style="height: 40px;">
                          <strong>   </strong>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action px-3 border-0 active text-reset" aria-current="true">
                            <img src="https://mdbootstrap.com/img/new/avatars/3.jpg" alt="" class="border rounded-circle" style="height: 40px;">
                          <strong>    </strong>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action px-3 border-0 active text-reset" aria-current="true">
                            <img src="https://mdbootstrap.com/img/new/avatars/4.jpg" alt="" class="border rounded-circle" style="height: 40px;">
                          <strong>    </strong>
                          </a>
                          <a href="#" class="list-group-item list-group-item-action px-3 border-0 active text-reset" aria-current="true">
                            <img src="https://mdbootstrap.com/img/new/avatars/5.jpg" alt="" class="border rounded-circle" style="height: 40px;">
                          <strong>   </strong>
                          </a>
                      </div>
                    </div>
                    {{-- left column --}}

                    {{-- center column --}}
     
                    <div class="col-md-8">
                        {{-- section messages --}}
                    <section>
                    <div class="">
                        <img src="https://mdbootstrap.com/img/new/avatars/2.jpg" alt="" class="border rounded-circle" style="height: 30px;">
                        <strong>   </strong>
                    </div>

                    <hr>

                    {{-- Single message - interlocutor 
                    <div class="d-flex justify-content-start">
                        <img src="https://mdbootstrap.com/img/new/avatars/1.jpg" alt="" 
                        class="border rounded-circle me-2" style="height: 40px;">
                    <p class = "bg-light p-3 rounded-2" style="max-width: 533px;">
                        
                        <small class="float-end mt-4">   </small>
                     </p>
                    
                    </div>
                    
                    {{-- Single message - interlocutor --}}

                    {{-- single message - me 
                    <div class="d-flex justify-content-end">
                        <p class = "bg-primary text-white p-3 rounded-2" style="max-width: 533px;">
                            
                            <small class="float-end mt-4">   </small>
                         </p>
                        
                        <img src="https://mdbootstrap.com/img/new/avatars/2.jpg" alt=""
                         class="border rounded-circle me-2" style="height: 40px;">
                    
                     </p>
                    
                    </div>
                    {{-- single message - me --}}
                    
                    {{-- Section: Message Box --}}

                   

                    <section class="fixed-bottom position-relative position-sticky">
                        <div class="form-outline position-absolute bottom-0 end-0 w-100 me-auto">
                          <textarea class="form-control"  id="textAreaExample5" rows="3" placeholder="Aa"></textarea>
                          <button class="btn btn-primary position-absolute bottom-0 end-0" type="submit">Send</button>
                                                  </div>
                                                  
                                              </div>
                                          </div>
                                          </section>
                    </section>
                </div>
                
                {{-- Section: Message Box --}}
               
                
                    {{-- right column --}}
                
           
        </main>
                       
        
        @endsection
    

