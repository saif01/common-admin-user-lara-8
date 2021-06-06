
  <!-- Modal -->
  <div wire:ignore.self class="modal fade" id="dataAddModal" tabindex="-1" aria-labelledby="dataAddModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dataAddModalLabel">{{ $modelTitle }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <label for="userEmail">Email address</label>
                <input type="email" wire:model='email' class="form-control" id="userEmail" placeholder="Enter User Email address">
                @error('email')
                <small class="small text-danger">{{ $message }}</small>
                @enderror
            </div>
           

            <div class="form-group">
                <label for="userName">User Name</label>
                <input type="text" wire:model='name' class="form-control" id="userName" placeholder="Enter User Name">
                @error('name')
                <small class="small text-danger">{{ $message }}</small>
                @enderror
            </div>
            

            <div class="form-group">
                <label for="password">User Password</label>
                <input type="password" wire:model='password' class="form-control" id="password" placeholder="Enter User Password">
                @error('password')
                <small class="small text-danger">{{ $message }}</small>
                @enderror
            </div>
           

            
            <div class="form-group">
                <label for="conformPassword">Conform Password</label>
                <input type="password" wire:model='conformPassword' class="form-control" id="conformPassword" placeholder="Enter Conform Password">
                @error('conformPassword')
                <small class="small text-danger">{{ $message }}</small>
                @enderror
            </div>
           

             
            <div class="form-group">
                <label for="conformPassword">Profile Image</label>
                <input type="file" wire:model="image" class="form-control">
                @error('image')
                <small class="small text-danger">{{ $message }}</small>
                @enderror
            </div>
            
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" height="50" class="rounded mx-auto d-block" >
            @elseif($oldImage)
                <img src="{{ asset('images/admin/small').'/'.$oldImage }}" height="50" class="rounded mx-auto d-block" >
            @endif

         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         
          <button wire:click="save" wire:loading.remove class="btn btn-primary"><i class="fas fa-plus-square"></i> Save </button>

          <button wire:loading wire:target="save" class="btn btn-primary ">Saving... <i
            class="fas fa-spinner fa-spin"></i></button>
        </div>
      </div>
    </div>
  </div>