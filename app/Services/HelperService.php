<?php

namespace App\Services;

use PHPImageWorkshop\ImageWorkshop as ImageWorkshop;
use Illuminate\Support\Facades\App;

class HelperService
{
    public function generateSlug($slug, $subSpace = '-')
    {
        $slug = str_replace(
            array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
            array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
            $slug
        );

        $slug = str_replace(
            array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
            array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
            $slug
        );

        $slug = str_replace(
            array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
            array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
            $slug
        );

        $slug = str_replace(
            array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô','Õ','Ø'),
            array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O','O','O'),
            $slug
        );

        $slug = str_replace(
            array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
            array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
            $slug
        );

        $slug = str_replace(
            array('ñ', 'Ñ', 'ç', 'Ç','Š','š','Ž','ž','Ý','ý','ÿ'),
            array('n', 'N', 'c', 'C','S','s','Z','z','Y','y','y'),
            $slug
        );

        $slug = strtolower($slug);

        $slug = preg_replace('/[^a-zA-Z0-9\s]-'.$subSpace.'/i','', $slug);

        $slug = trim($slug);

        $slug = preg_replace('/\s+/', $subSpace, $slug);

        return $slug;
    }

    public function ProcessImage($image)
    {
        $name = time() . $image->getClientOriginalName();
        $path = "articleimages/images";
        $pathimage = "articleimages/images/" . $name;
        if (!App::runningInConsole()) {
            $image->move('articleimages/images', $name);
            $newimage = ImageWorkshop::initFromPath($pathimage);
            $newimage->resizeInPixel(825, 400, false);
            $newimage->save($path, $name, false, null, 95);
        }



        return $pathimage;
    }
}