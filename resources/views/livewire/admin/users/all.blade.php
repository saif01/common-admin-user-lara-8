<div>

    <div class="card-header row">
        <div class="col-md-6">
            <h4 class="card-title">All Admins</h4>
        </div>

        <div class="col-md-6">
            @can('add')
            <button type="button" wire:click="addData" class="btn btn-primary btn-sm float-right"><i
                    class="fas fa-plus-square"></i>Add</button>
            @endcan
        </div>
    </div>

    <div class="card-content">
        <div class="card-body card-dashboard">

            <div class="row mb-4">
                {{-- Tbl Perpage Search --}}
                @include('livewire.partials.tbl-perpage-search')
            </div>

            <div class="table-responsive">
                <table class="table mb-0 table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th wire:click="sortBy('name')">Name
                                @include('livewire.partials.sort-icon',['field'=>'name'])</th>
                            <th wire:click="sortBy('email')">Email
                                @include('livewire.partials.sort-icon',['field'=>'email'])</th>
                            <th>Roles</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allData as $item)
                        <tr>
                            <td class="border-0">
                                @if($item->image)
                                <img src="{{ asset('images/admin/small').'/'.$item->image }}" height="30"
                                    class="rounded mx-auto d-block">
                                @else
                                <span class="text-danger">Not Found</span>
                                @endif
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                @forelse ($item->roles->sortBy('name') as $item2)
                                {{ $item2->name }},
                                @empty
                                <span class="text-danger">No Role Define</span>
                                @endforelse
                            </td>
                            <td>
                                @can('roleManage')
                                <button wire:click="roleEdit({{ $item->id }})" class="btn btn-sm btn-success"><i
                                        class="fas fa-cogs"></i> Role</button>
                                @endcan

                                @can('edit')
                                <button wire:click="edit({{ $item->id }})" class="btn btn-sm btn-info"><i
                                        class="far fa-edit"></i>Edit</button>
                                @endcan
                                {{-- Data Delete btn --}}
                                @can('delete')
                                @if($deleteConform === $item->id)
                                <div wire:loading.remove class="btn-group">
                                    <button wire:click="delete({{ $item->id }},1)" class="btn btn-sm btn-danger"><i
                                            class="far fa-check-circle"></i>Yes</button>
                                    <button wire:click="deleteConformation" class="btn btn-sm btn-secondary"><i
                                            class="far fa-times-circle"></i>No</button>
                                </div>
                                <button wire:loading wire:target="delete" class="btn btn-sm btn-success"><i
                                        class="fas fa-spinner fa-spin"></i>Loading ....</button>
                                @else
                                <a wire:click="deleteConformation({{ $item->id }})" class="btn btn-sm btn-warning"><i
                                        class="fas fa-eraser"></i>Delete</a>

                                @endif
                                @endcan
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <p class="text-center text-warning h3">Sorry !!! Data Not found</p>
                            </td>
                        </tr>
                        @endforelse


                    </tbody>
                </table>
                <p>Showing {{$allData->firstItem()}} to {{$allData->lastItem()}} out of {{$allData->total()}} items</p>
                {{ $allData->links() }}
            </div>

        </div>
    </div>


    @include('livewire.admin.users.modals.add')
    @include('livewire.admin.users.modals.role')


</div>



@push('scripts')

<script>
    window.addEventListener('closeModal', event => {
        //console.log(event);
        $("#dataAddModal").modal('hide');
    });

    window.addEventListener('openModal', event => {
        //console.log(event);
        $("#dataAddModal").modal('show');
    });


    window.addEventListener('closeModal_2', event => {
        //console.log(event);
        $("#dataAddModal_2").modal('hide');
    });

    window.addEventListener('openModal_2', event => {
        //console.log(event);
        $("#dataAddModal_2").modal('show');
    });

</script>

@endpush
