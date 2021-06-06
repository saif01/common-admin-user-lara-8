<!-- Modal -->
<div wire:ignore.self class="modal fade" id="dataAddModal_2" tabindex="-1" aria-labelledby="dataAddModal_2Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataAddModal_2Label">All Roles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <label class="control-label badge text-success">Role Access</label>
                <div class="form-group row">

                    @forelse($allRolesData as $role)

                        <div class="col-md-4">
                            <div class="custom-control custom-checkbox mr-2">
                                <input type="checkbox" class="custom-control-input " value="{{ $role->id }}"
                                    id="ch{{ $role->id }}" wire:model="assignRoles">
                                <label class="custom-control-label"
                                    for="ch{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        </div>

                    @empty
                        <p class="text-center text-danger h4"> No Role Availavle</p>
                    @endforelse

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

                <button wire:click="roleUpdate" wire:loading.remove class="btn btn-primary btn-sm"><i
                        class="fas fa-plus-square"></i> Update </button>

                <button wire:loading wire:target="roleUpdate" class="btn btn-primary btn-sm">Updating... <i
                        class="fas fa-spinner fa-spin"></i></button>
            </div>
        </div>
    </div>
</div>
