<?php

namespace Sentix\Helpers;

class QrCodeRenderer
{
    private $data;
    private $size;
    private $color;
    private $backgroundColor;

    public function __construct($data, $size, $color, $backgroundColor)
    {
        $this->data = $data;
        $this->size = $size;
        $this->color = $color;
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * Render the QR code as a PNG image.
     */
    public function render()
    {
        // Create an image resource
        $image = imagecreate($this->size, $this->size);

        // Allocate colors
        $bgColor = imagecolorallocate($image, ...$this->backgroundColor);
        $fgColor = imagecolorallocate($image, ...$this->color);

        // Fill background
        imagefill($image, 0, 0, $bgColor);

        // Dummy QR Code pattern (replace with actual QR generation logic)
        for ($x = 10; $x < $this->size - 10; $x += 20) {
            for ($y = 10; $y < $this->size - 10; $y += 20) {
                imagesetpixel($image, $x, $y, $fgColor);
            }
        }

        // Capture image data
        ob_start();
        imagepng($image);
        $imageData = ob_get_clean();

        // Destroy the image resource
        imagedestroy($image);

        return $imageData;
    }
}