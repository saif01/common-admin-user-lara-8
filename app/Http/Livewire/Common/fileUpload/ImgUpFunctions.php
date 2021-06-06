<?php

namespace App\Http\Livewire\Common\fileUpload;

use \Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Image;

trait ImgUpFunctions{

    use WithFileUploads;

    // Iamge Upload
    public function imgUpload( $img = null,  $path = null, $diskName = 'custom'){

        if ( !empty($img) && !is_null($img) ) {
           
            $imageName =$this->image->hashName();
            // $data->image = $imageName;
            //Store Original Image
            $this->image->storePublicly( $path, $diskName);

            // Resized Image Save
            $img = Image::make($this->image)
            ->resize(300, 200)
            ->save('images/'.$path.'small/'.$imageName);

            return $imageName;
        }

    }

    // Document Upload
    public function docUpload( $doc = null,  $path = null, $diskName = 'custom'){

        if ( !empty($doc) ) {
           
            $documentName =$this->document->hashName();
            // $data->document = $documentName;
            //Store Original document
            $this->document->storePublicly( $path, $diskName);

            return $documentName;
        }

    }

    // Image delete
    public function imgDelete( $imgFile = null, $path = null,  $diskName = 'custom' ){

        if( !empty($imgFile) ){

           
            $pathSm = $path .'small/';

            //dd($pathSm);

            // If file exist then delete without throw error
            Storage::disk($diskName)->delete( $path . $imgFile );
            Storage::disk($diskName)->delete( $pathSm . $imgFile );
        }         
    }

    // Document Delete
    public function docDelete( $docFile = null, $path = null,  $diskName = 'custom' ){

        if( !empty($docFile) ){
            // If file exist then delete without throw error
            Storage::disk($diskName)->delete( $path . $docFile );
        
        }         
    }

}

