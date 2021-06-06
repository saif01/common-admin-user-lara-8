<?php

namespace App\Http\Livewire\Admin\Users;

use Livewire\Component;

use Livewire\WithPagination;
use Gate;
use Carbon\Carbon;
use Auth;
use DB;
use App\Models\User;
use App\Models\Auth\Role;

use App\Http\Livewire\Common\fileUpload\ImgUpFunctions;
use App\Http\Livewire\Common\dataTbl\Conformation;
use App\Http\Livewire\Common\dataTbl\TblComponants;

class All extends Component
{
    use WithPagination, ImgUpFunctions, Conformation, TblComponants;

    protected $paginationTheme = 'bootstrap';

    public $login ,$name, $email, $password, $conformPassword, $image, $oldImage, $modelTitle, $editId, $selectedUser, $assignRoles=[];


    // Model Open
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
        $this->login            = '';
        $this->name             = '';
        $this->email            = '';
        $this->password         = '';
        $this->conformPassword  = '';
        $this->image            = '';
        $this->oldImage         = '';
    }

    // Image 
    public function updatedImage(){
        $this->validate([
            'image' => 'image|max:1024', // 1MB Max
        ]);
    }

    // Add data btn click
    public function addData(){
        //Reset Form values
        $this->resetForm();
        //Open Model
        $this->openModal();
    }

    // Save new Data
    public function save( $val=null ){

        if($this->editId){

            //Validate
            $this->validate([
                'email'     => 'required|string|max:255|unique:users,email,'.$this->editId,
                'name'      => 'required|string|max:100',
                'password'  => 'nullable|string|same:conformPassword',
                'image'     => 'nullable|image|max:1024',
            ]);

            $data = User::find($this->editId);
            // Check Image selected 
            if ( !empty($this->image) ) {
                // Delete file
                $imgFile = $data->image;
                if ( !empty($imgFile) ){
                    // Delete by trait function
                    $this->imgDelete($imgFile, 'admin/');
                }
            }
           
 
        }else{
            //Validate
            $this->validate([
                'email'     => 'required|string|max:255|unique:users',
                'name'      => 'required|string|max:100',
                'password'  => 'required|string|same:conformPassword',
                'image'     => 'required|image|max:1024',
            ]);

            $data = new User();
        }

        $data->name     = $this->name;
        $data->email    = $this->email;
        $data->password = $this->password;

         // Image store
         if ( !empty($this->image) ) {
            // Image upload by trait function
            $imageName = $this->imgUpload($this->image, 'admin/');
            //dd($imageName);
            $data->image = $imageName;
        }

        
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
    public function edit( $val ){

        $data = User::find($val);

        // dd($val);
        $this->name     = $data->name;
        $this->email    = $data->email;
        $this->password = $data->password;
        $this->conformPassword = $data->password;
        $this->oldImage = $data->image;

        // set edit form Id
        $this->editId = $val;
        //Open Modal
        $this->openModal('Edit data', $val);
      
    }

    // Delete
    public function delete( $delId=null, $conf=0 ){

        // Delete comform valu make null
        $this->conformation = null;
    

        if($conf == 1){

            if(Auth::user()->id == $delId){
                //Tostar alert
                $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Can not delete yourself &#128549.', 'icon' => 'error'] );
                
            }else{
                $data = User::find($delId);
                // dd($val);

                // Delete file
                $imgFile = $data->image;
                if ( !empty($imgFile) ){
                    // Delete by trait function
                    $this->imgDelete($imgFile, 'admin/');
                }

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


    public function render()
    {

        $allData = User::query()
        ->search( trim(preg_replace('/\s+/' ,' ', $this->search)) )
        ->with('roles')
        //->where('status', 1)
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        // All role data
        $allRolesData = Role::where('delete_temp', 0)->orderBy('name')->get();

        //dd( implode(', ', $allData->roles->name) );

        return view('livewire.admin.users.all', compact('allData', 'allRolesData'));
    }


    // Role Edit
    public function roleEdit($userId){

        // Find Current User data
        $this->selectedUser = User::find($userId);

        // Current user role as a array
        $userRoles = $this->selectedUser->roles->pluck('id')->toArray();

        // Array convert to string
        $userRolesAsString = array_map('strval', $userRoles);
       
        // All string array role assign for checked
        $this->assignRoles = $userRolesAsString;
        
        //dd( $userRoles,  $userRolesAsString);

        // Opening role modal
        $this->dispatchBrowserEvent('openModal_2');
    }


    // Role Update
    public function roleUpdate(){

        // dd($this->assignRoles);
        if($this->selectedUser){

            // Get current user data
            $user = User::find($this->selectedUser->id);

            //dd($this->assignRoles);

            // Sync user role
            $user->roles()->sync($this->assignRoles);

            // Closed role modal
            $this->dispatchBrowserEvent('closeModal_2');

            $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Saved Successfully &#128512.', 'icon' => 'success'] );
         

        }
        else{
            //Tostar alert
            $this->dispatchBrowserEvent('toastMsg', ['messege' => 'Somthing Going Wrong &#128549.', 'icon' => 'error'] );
        }

       

    }

}
