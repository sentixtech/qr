<?php

namespace Sentix;

use Illuminate\Support\Facades\Config;
use Sentix\Helpers\QrCodeRenderer;

class Qr
{
    private $data; // Dynamic data
    private $size;
    private $color;
    private $backgroundColor;
    private $path;

    /**
     * Constructor to initialize dynamic data and defaults from config.
     */
    public function __construct(string $data)
    {
        $this->data = $data;
        $this->size = Config::get('qr_code.size', 300); // Default size
        $this->color = Config::get('qr_code.color', [0, 0, 0]); // Default color
        $this->backgroundColor = Config::get('qr_code.background_color', [255, 255, 255]); // Default background color
    }

    /**
     * Create a new instance with data.
     */
    public static function make(string $data)
    {
        return new self($data);
    }

    /**
     * Set the size of the QR Code.
     */
    public function size(int $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Set the foreground color.
     */
    public function color(int $r, int $g, int $b)
    {
        $this->color = [$r, $g, $b];
        return $this;
    }

    /**
     * Set the background color.
     */
    public function bgColor(int $r, int $g, int $b)
    {
        $this->backgroundColor = [$r, $g, $b];
        return $this;
    }

    /**
     * Generate and save the QR Code image to the specified path.
     */
    public function save(string $path)
    {
        $this->path = $path;

        $renderer = new QrCodeRenderer($this->data, $this->size, $this->color, $this->backgroundColor);
        $imageData = $renderer->render();

        file_put_contents($this->path, $imageData);

        return $this->path;
    }

    /**
     * Generate and return Base64 encoded QR Code.
     */
    public function base64()
    {
        $renderer = new QrCodeRenderer($this->data, $this->size, $this->color, $this->backgroundColor);
        $imageData = $renderer->render();

        return 'data:image/png;base64,' . base64_encode($imageData);
    }
}