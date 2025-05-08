<?php
function manejarImagen($img) {
    $soportados = array("image/png", "image/webp", "image/jpeg");
    $max = 450;

    if(substr($img, 0, 5) == "data:") {
      // Es un archivo
      $data = substr($img, 5);
      $tokens = explode(";", $data, 2);

      $mime = $tokens[0]; // tipo de archivo
      $ext = "jpg";

      if(!in_array($mime, $soportados)) {
        return null;
      }

      if(substr($tokens[1], 0, 7) == "base64,") {
        // Es base64
        $filename = time() . "." . $ext;

        $b64 = substr($tokens[1], 7);
        $data = base64_decode($b64);
        
        $src = imagecreatefromstring($data);
        list($width, $height) = getimagesizefromstring($data);
        
        $widthRatio = $max / $width;
        $heightRatio = $max / $height;
        $ratio = min($widthRatio, $heightRatio);

        $new_w = (int)$width * $ratio;
        $new_h = (int)$height * $ratio;

        $dst = imagecreatetruecolor($new_w, $new_h);
        imagecopyresized($dst, $src, 0, 0, 0, 0, $new_w, $new_h, $width, $height);
        imagejpeg($dst, "../imgs/productos/$filename");

        return $filename;
      }
    }

    return null;
  }
?>