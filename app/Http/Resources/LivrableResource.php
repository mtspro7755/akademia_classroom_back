<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivrableResource extends JsonResource
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
            'lien' => $this->lien,
            'typeLivrable' => $this->typeLivrable,
            'statutCorrection' => $this->statutCorrection,
            'dateSoumission' => $this->dateSoumission,
            'dureeEffectue' => $this->dureeEffectue,


            'apprenant' => new ApprenantResource(
                $this->whenLoaded('apprenant')
            ),

            'activite' => new ActiviteResource(
                $this->whenLoaded('activite')
            ),

            // évaluations
            'scores' => EvaluationParScoreResource::collection(
                $this->whenLoaded('scores')
            ),

            'feedback' => new EvaluationParFeedbackResource(
                $this->whenLoaded('feedback')
            ),

            'reponsesQuestions' => LivrableParQuestionResource::collection(
                $this->whenLoaded('reponsesQuestions')
            ),

            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
