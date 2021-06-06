<?php

namespace App\Http\Livewire\Common\Modal;

trait ModalOpenClose{

    public $modelTitle, $editId;

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


}


?>