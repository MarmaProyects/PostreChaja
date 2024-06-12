<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
  
        $image->delete();
 
        return redirect()->back()->with('success', 'Imagen borrada exitosamente.');
    }
}
