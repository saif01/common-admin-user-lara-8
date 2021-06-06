<?php

namespace App\Http\Livewire\Admin\Roles;

use Livewire\Component;

use Livewire\WithPagination;
use Auth;
use App\Models\Auth\Role; 
use Livewire\WithFileUploads;
use App\Http\Livewire\Common\dataTbl\Conformation;
use App\Http\Livewire\Common\dataTbl\TblComponants;

class All extends Component
{

    use WithPagination, WithFileUploads, Conformation, TblComponants;

    protected $paginationTheme = 'bootstrap';

  
    public $name, $modelTitle, $editId;


    //Model Open
    public function openModal( $title='Add Data', $editId=null ){
        $this->editId       = $editId;
        $this->modelTitle   = $title;
        $this->dispatchBrowserEvent('openModal');
    } 

    //Model Close
    public function closeModal( $title='Add Data', $editId=null ){
        $this->editId = $editId;
        $this->modelTitle = $title;
        $this->dispatchBrowserEvent('closeModal');
    } 
  
    //reset form
    public function resetForm(){
        $this->name             = '';
    }

    
    //add data btn click
    public function addData(){
        //Reset Form values
        $this->resetForm();
        //Open Model
        $this->openModal();
    }


    // Save new Data
    public function save($val=null){

        if($this->editId){

            //Validate
            $this->validate([
                'name'     => 'required|string|max:100|unique:roles,name,'.$this->editId,
            ]);

            $data = Role::find($this->editId);
        }else{
            //Validate
            $this->validate([
                'name'     => 'required|string|max:100|unique:roles',
            ]);

            $data = new Role();
        }

        
        $data->name     = $this->name;
        $success        = $data->save();

        //Close Modal
        $this->closeModal();

        //Reset Form
        $this->resetForm();
      
        if($success){
            //Tostar alert
            $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Saved Successfully &#128512.', 'icon' => 'success'] );
        }else{
            //Tostar alert
            $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Somthing Going Wrong &#128549.', 'icon' => 'error'] );
        }

        

    }

    // Single Data
    public function edit($val){

        $data = Role::find($val);

        // dd($val);
        $this->name     = $data->name;
      
        // set edit form Id
        $this->editId = $val;
        //Open Modal
        $this->openModal('Edit data', $val);
      
    }

    // Delete
    public function delete($delId=null, $conf=0){

        // Delete comform valu make null
        $this->conformation = null;
       
        if($conf == 1){

            $data = Role::find($delId);
            // dd($val);
            $success = $data->delete();
    
            if($success){
                //Tostar alert
                $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Deleted Successfully &#128512.', 'icon' => 'success'] );
            }else{
                //Tostar alert
                $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Somthing Going Wrong &#128549.', 'icon' => 'error'] );
            }
           
        }
       
      
    }

    public function render()
    {
        $allData = Role::query()
        ->search( trim(preg_replace('/\s+/' ,' ', $this->search)) )
        //->with('zoneData', 'managerData', 'officerData')
        //->where('status', 1)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.admin.roles.all', compact('allData'));
    }
}
