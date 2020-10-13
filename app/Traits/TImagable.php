<?php


namespace App\Traits;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait TImagable
{
	public function uploadImage($image)
	{
		if (!$image) {
			return;
		}

		$this->removeImage();
		
		$filename = Str::random(10) . '.' . $image->guessExtension();
		$image->storeAs('uploads', $filename);
		$this->image = $filename;
		$this->save();
	}
	
	public function getImage()
	{
		return $this->image ? '/uploads/' . $this->image : '/img/noImg.png';
	}
	
	public function removeImage()
	{
		if ($this->image) {
			Storage::delete('uploads/' . $this->image);
		}
	}
}