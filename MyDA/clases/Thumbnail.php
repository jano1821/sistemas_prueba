<?php

/**
 * Thumbnail
 *
 * Crea una miniatura de una imagen y la guarda en un formato especifico
 *
 */
class Thumbnail {

// informacion de la miniatura
    private $thumbnail;
    private $thumbnail_width;
    private $thumbnail_height;
// informacion de la imagen original
    private $image;
    private $image_width;
    private $image_height;
    private $image_type;
    public $error;

    /**
     * Thumbnail::__construct()
     *
     * @param mixed $source
     * @return
     */
    public function __construct($source) {
        $image_info = getimagesize($source);

        if ($image_info) {
            $this->image_width = $image_info[0];
            $this->image_height = $image_info[1];
            $this->image_type = $image_info[2];

            switch ($this->image_type) {
                case IMAGETYPE_JPEG: {
                        $this->image = imagecreatefromjpeg($source);
                        break;
                    }

                case IMAGETYPE_GIF: {
                        $this->image = imagecreatefromgif($source);
                        break;
                    }

                case IMAGETYPE_PNG: {
                        $this->image = imagecreatefrompng($source);
                        break;
                    }

                default: {
                        $this->error = "Formato no soportado";
                        break;
                    }
            }
        } else {
            $this->error = "Formato invalido";
        }
    }

    /**
     * Thumbnail::resize()
     *
     * @param mixed $width
     * @param integer $height
     * @return void
     */
    public function resize($width, $height) {
        if ($this->image_width >= $this->image_height) {
//Es mas ancho que alto, cambia el ancho y el alto lo calcula proporcional
            if ($width < $this->image_width) {
//Solo redimensiona si el original es mas grande
                $this->thumbnail_width = $width;
                $this->thumbnail_height = $width * $this->image_height / $this->image_width;
            } else {
//No redimensiona
                $this->thumbnail_width = $this->image_width;
                $this->thumbnail_height = $this->image_height;
            }
        } else {
//Es mas alto que ancho, cambia el alto y el ancho lo calcula proporcional
            if ($height < $this->image_height) {
//Solo redimensiona si el original es mas grande
                $this->thumbnail_height = $height;
                $this->thumbnail_width = $height * $this->image_width / $this->image_height;
            } else {
//No redimensiona
                $this->thumbnail_width = $this->image_width;
                $this->thumbnail_height = $this->image_height;
            }
        }


        $this->thumbnail = imagecreatetruecolor($this->thumbnail_width, $this->thumbnail_height);

        imagecopyresampled(
                $this->thumbnail, $this->image, 0, 0, 0, 0,
                $this->thumbnail_width, $this->thumbnail_height,
                $this->image_width, $this->image_height
        );
    }

    /**
     * Thumbnail::save_jpg()
     *
     * @param mixed $dir
     * @param mixed $name
     * @param integer $quality
     * @return
     */
    public function save_jpg($dir, $name, $quality = 95) {
        $path = $dir . $name . ".jpg"; // image_type_to_extension(IMAGETYPE_JPEG);
        imagejpeg($this->thumbnail, $path, $quality);

        imagedestroy($this->thumbnail);
    }

    /**
     * Thumbnail::save_gif()
     *
     * @param mixed $dir
     * @param mixed $name
     * @return
     */
    public function save_gif($dir, $name) {
        $path = $dir . $name . image_type_to_extension(IMAGETYPE_GIF);
        imagegif($this->thumbnail, $path);

        imagedestroy($this->thumbnail);
    }

    /**
     * Thumbnail::save_png()
     *
     * @param mixed $dir
     * @param mixed $name
     * @return
     */
    public function save_png($dir, $name) {
        $path = $dir . $name . image_type_to_extension(IMAGETYPE_PNG);
        imagegif($this->thumbnail, $path);

        imagedestroy($this->thumbnail);
    }

}

?>
