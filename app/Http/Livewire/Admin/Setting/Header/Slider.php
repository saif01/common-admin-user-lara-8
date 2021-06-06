<?php

namespace App\Http\Livewire\Admin\Setting\Header;

use Livewire\Component;

use Livewire\WithPagination;
use Auth;
use App\Models\Admin\Setting\HomeSlider;

use App\Http\Livewire\Common\dataTbl\Conformation;
use App\Http\Livewire\Common\dataTbl\TblComponants;
use App\Http\Livewire\Common\Modal\ModalOpenClose;


class Slider extends Component
{
    use WithPagination, Conformation, TblComponants, ModalOpenClose;

    protected $paginationTheme = 'bootstrap';
  
    public  $message, $title, $details;


    //reset form
    public function resetForm(){
        $this->title        = '';  
        $this->details      = '';
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
                'title'     => 'required|string|max:100|unique:home_sliders,title,'.$this->editId,
                'details'   => 'required|string|max:1000',
            ]);

            $data = HomeSlider::find($this->editId);

        }else{
            //Validate
            $this->validate([
                'title'     => 'required|string|max:100|unique:home_sliders',
                'details'   => 'required|string|max:1000',
            ]);

            $data = new HomeSlider();
        }

        $data->title      = $this->title;
        $data->details    = $this->details;
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

        $data = HomeSlider::find($val);

        $this->title   = $data->title;
        $this->details = $data->details;

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

            if( !empty($delId) ){
              
                $data = HomeSlider::find($delId);
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

                $data = HomeSlider::find($stId);

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
        $allData = HomeSlider::query()
        ->search( trim(preg_replace('/\s+/' ,' ', $this->search)) )
        //->with('zoneData', 'managerData', 'officerData')
        //->where('status', 1)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);


        return view('livewire.admin.setting.header.slider', compact('allData'));
    }
}
