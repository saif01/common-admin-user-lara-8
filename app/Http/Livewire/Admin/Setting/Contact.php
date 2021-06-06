<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;

use Livewire\WithPagination;
use Auth;
use App\Models\Admin\Setting\ContactInfo; 
use Livewire\WithFileUploads;
use App\Http\Livewire\Common\dataTbl\Conformation;
use App\Http\Livewire\Common\dataTbl\TblComponants;
use App\Http\Livewire\Common\Modal\ModalOpenClose;

class Contact extends Component
{
    use WithPagination, WithFileUploads, Conformation, TblComponants, ModalOpenClose;

    protected $paginationTheme = 'bootstrap';
  
    public $address, $phone, $email, $modelTitle, $editId;

  
    //reset form
    public function resetForm(){
        $this->address           = '';
        $this->phone             = '';
        $this->email             = '';
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
                'address'     => 'required|string|max:500|unique:contact_infos,address,'.$this->editId,
                'phone'       => 'required|string|max:100',
                'email'       => 'required|string|max:100',
            ]);

            $data = ContactInfo::find($this->editId);
        }else{
            //Validate
            $this->validate([
                'address'     => 'required|string|max:500|unique:contact_infos',
                'phone'       => 'required|string|max:100',
                'email'       => 'required|string|max:100',
            ]);

            $data = new ContactInfo();
        }

        
        $data->address    = $this->address;
        $data->phone      = $this->phone;
        $data->email      = $this->email;
        $data->status     = 1;
        $data->created_by = Auth::user()->id;
        $success          = $data->save();

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

        $data = ContactInfo::find($val);

        // dd($val);
        $this->address   = $data->address;
        $this->phone     = $data->phone;
        $this->email     = $data->email;
      
        // set edit form Id
        $this->editId = $val;
        //Open Modal
        $this->openModal('Edit data', $val);
      
    }

    // Delete
    public function delete( $delId = null, $conf=0 ){

        // Delete comform valu make null
        $this->conformation = null;
       
        if($conf == 1){

            if(Auth::user()->id == $delId){
                //Tostar alert
                $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Can not delete yourself &#128549.', 'icon' => 'error'] );
                
            }else{
                $data = ContactInfo::find($delId);
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
       
      
    }

    // Status change
    public function changeStatus( $stId = null, $conf=0 ){

        // Status comform valu make null
        $this->statusConform = null;

        // Check Conformation ok
        if($conf == 1){

            // Id get or not
            if( !empty($stId) ){

                $data = ContactInfo::find($stId);

                if($data->status == 1){
                    $data->status = 0;
                }else{
                    $data->status = 1;
                }

                $success = $data->save();

                if($success){
                    //Tostar alert
                    $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Saved Successfully &#128512.', 'icon' => 'success'] );
                }else{
                    //Tostar alert
                    $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Somthing Going Wrong &#128549.', 'icon' => 'error'] );
                }


            }else{
                //Tostar alert
                $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Somthing Going Wrong &#128549.', 'icon' => 'error'] );
            }

        }

    }



    public function render()
    {
        $allData = ContactInfo::query()
        ->search( trim(preg_replace('/\s+/' ,' ', $this->search)) )
        //->with('zoneData', 'managerData', 'officerData')
        //->where('status', 1)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.admin.setting.contact', compact('allData'));
    }
}
