
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
            <label for="userName">Role Name</label>
            <input type="text" wire:model='name' class="form-control" id="userName" placeholder="Enter Role Name">
            @error('name')
            <small class="small text-danger">{{ $message }}</small>
            @enderror
        </div>
            
  
         
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