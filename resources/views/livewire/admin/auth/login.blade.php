<div class="auth-wrapper aut-bg-img">

  <div class="auth-content">
      <div class="card">
          <div class="card-body text-center">
              <div class="mb-4">
                  <i class="feather icon-unlock auth-icon"></i>
                  {{-- <img src="{{ asset('all-assets/common/logo/cpb/cpb.png') }}" alt="Logo" height="55" > --}}
                  <h5 class="mb-4 text-muted">Admin Login</h5>
              </div>
              


              @if (session()->has('message'))
                  <div class="alert alert-danger">
                      {{ session('message') }}
                  </div>
              @endif


              <div class="input-group mb-3">
                <input type="text" wire:model.lazy="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Your Email">
              </div>
               @error('email')
                <div class="alert alert-danger">
                 <span>{{ $message }}</span> 
                </div>
               @enderror

              <div class="input-group mb-4">
                <input type="password" wire:model.lazy='password'  class="form-control @error('login') is-invalid @enderror"  placeholder="Enter Password">
              </div>
               @error('password')
                <div class="alert alert-danger">
                 <span>{{ $message }}</span> 
                </div>
               @enderror


              {{-- <div class="form-group text-left">
                  <div class="checkbox checkbox-fill d-inline">
                      <input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
                      <label for="checkbox-fill-a1" class="cr"> Save credentials</label>
                  </div>
              </div> --}}

              <hr>

              <div>
                  <button type="submit" wire:click="login" wire:loading.remove class="btn btn-primary shadow-2 btn-block"><i class="ft-unlock"></i> Login</button>
                  <button wire:loading wire:target="login" class="btn btn-success btn-block"><i class="fas fa-spinner fa-spin"></i> Loading ....</button>
              </div>

  
              {{-- <p class="mb-2 text-muted">Forgot password? <a href="auth-reset-password-v5.html">Reset</a></p>
              <p class="mb-0 text-muted">Don’t have an account? <a href="auth-signup-v5.html">Signup</a></p> --}}
          </div>
      </div>
  </div>

</div>
