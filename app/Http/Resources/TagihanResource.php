<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagihanResource extends JsonResource
{
    // Properti tambahan sesuai modul [cite: 23-25]
    public $status;
    public $message;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    public function toArray(Request $request): array
    {
        // Mengembalikan format JSON yang rapi
        return [
            'success' => $this->status,
            'message' => $this->message,
            'data'    => $this->resource,
        ];
    }
}
