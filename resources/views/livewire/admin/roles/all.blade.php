<div>

    <div class="card-header row">
        <div class="col-md-6">
            <h4 class="card-title">All Roles</h4>
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
                            <th wire:click="sortBy('name')">Name
                                @include('livewire.partials.sort-icon',['field'=>'name'])</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($allData as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>

                                @if ( DB::table('role_user')->where('role_id', $item->id)->first() )
                                <span class="text-danger"> Already Used</span>
                                @else


                                {{-- Data Edit btn --}}
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

                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <p class="text-center text-warning h3">Sorry !!! Data Not found</p>
                        </tr>
                        @endforelse


                    </tbody>
                </table>
                <p>Showing {{$allData->firstItem()}} to {{$allData->lastItem()}} out of {{$allData->total()}} items</p>
                {{ $allData->links() }}
            </div>

        </div>
    </div>




    @include('livewire.admin.roles.modals.add')


</div>


@push('scripts')

<script>
    window.addEventListener('closeModal', event => {
        // console.log(event);
        $("#dataAddModal").modal('hide');
    });

    window.addEventListener('openModal', event => {
        // console.log(event);
        $("#dataAddModal").modal('show');
    });

</script>

@endpush
