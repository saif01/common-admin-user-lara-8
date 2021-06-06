<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;

use Livewire\WithPagination;
use Auth;
use App\Models\Admin\Setting\SliderImg;
use Image;

use App\Http\Livewire\Common\fileUpload\ImgUpFunctions;
use App\Http\Livewire\Common\dataTbl\Conformation;
use App\Http\Livewire\Common\dataTbl\TblComponants;
use App\Http\Livewire\Common\Modal\ModalOpenClose;


class Slider extends Component
{
    use WithPagination, ImgUpFunctions, Conformation, TblComponants, ModalOpenClose;

    protected $paginationTheme = 'bootstrap';
  
    public $image, $oldImage;
  
    //reset form
    public function resetForm(){
        $this->image           = '';
        $this->oldImage        = '';
    }

    // Image 
    public function updatedImage(){
        $this->validate([
            'image' => 'image|max:1024', // 1MB Max
        ]);

        // $imageName = $this->image->hashName();
        // $img = Image::make($this->image)
        //     ->resize(300, 200)
        //     ->save('images/admin/small/'.$imageName);
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
                'image'     => 'required|image|max:1024',
            ]);

            $data = SliderImg::find($this->editId);

            // Check Image selected 
            if ( !empty($this->image) ) {
                // Delete file
                $imgFile = $data->image;
                if ( !empty($imgFile) ){
                    // Delete by trait function
                    $this->imgDelete($imgFile, 'slider/');
                }
            }

            

        }else{
            //Validate
            $this->validate([
                'image'     => 'required|image|max:1024',
            ]);

            $data = new SliderImg();
        }

        // // Image store
        // if ( !empty($this->image) ) {
        //     // Image upload by trait function
        //     $imageName = $this->imgUpload($this->image, 'slider/');
        //     //dd($imageName);
        //     $data->image = $imageName;
        // }

        // Image store
        if ( !empty($this->image) ) {
            $path = 'slider/';

            $imageName =$this->image->hashName();
            $data->image = $imageName;
            //Store Original Image
            $this->image->storePublicly( $path, 'custom');

            // Resized Image Save
            $img = Image::make($this->image)
            ->resize(300, 200)
            ->save('images/'.$path.'small/'.$imageName);
            
            // 1920*1080 Image Save
            $img = Image::make($this->image)
            ->resize(1920, 1080)
            ->save('images/'.$path.'1920-1080/'.$imageName);
        }



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

        $data = SliderImg::find($val);

        // dd($val);
        $this->oldImage = $data->image;
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
              
                $data = SliderImg::find($delId);

                // Delete file
                $imgFile = $data->image;
                if ( !empty($imgFile) ){
                    // Delete by trait function
                    $this->imgDelete($imgFile, 'slider/');
                }

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

                $data = SliderImg::find($stId);

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
        $allData = SliderImg::query()
        //->search( trim(preg_replace('/\s+/' ,' ', $this->search)) )
        //->with('zoneData', 'managerData', 'officerData')
        //->where('status', 1)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.admin.setting.slider', compact('allData'));
    }
}
