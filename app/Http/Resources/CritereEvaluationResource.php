<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CritereEvaluationResource extends JsonResource
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
            'critere' => $this->critere,
            'question' => $this->question,

            'activite' => new ActiviteResource(
                $this->whenLoaded('activite')
            ),

            'evaluations' => EvaluationParScoreResource::collection(
                $this->whenLoaded('evaluations')
            ),
        ];
    }
}
