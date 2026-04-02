<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivrableParQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reponse' => $this->reponse,

            'question' => new QuestionResource(
                $this->whenLoaded('question')
            ),

            'livrable' => new LivrableResource(
                $this->whenLoaded('livrable')
            ),
        ];
    }
}
