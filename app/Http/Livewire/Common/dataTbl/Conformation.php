<?php

namespace App\Http\Livewire\Common\dataTbl;

trait Conformation{

    public $conformation, $deleteConform, $statusConform;

    // //For conformation notification
    // public function conformTrue($delId){
    //     $this->conformation = $delId;
    // }


    //Delete Conformation
    public function deleteConformation( $delId = null ){
        $this->deleteConform = $delId;
    }

    //Status conformation
    public function statusConformation( $stId = null ){
        $this->statusConform = $stId;
    }


}


?>