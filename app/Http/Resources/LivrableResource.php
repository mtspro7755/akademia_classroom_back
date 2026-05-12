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
            'apprenant_id' => $this->apprenant_id,
            'activite_id' => $this->activite_id,
            'lienDuRepertoire' => $this->lienDuRepertoire,
            'lienDeploye' => $this->lienDeploye,
            'typeLivrable' => $this->typeLivrable,
            'statutCorrection' => $this->statutCorrection,
            'dateSoumission' => $this->dateSoumission ? $this->dateSoumission->format('Y-m-d H:i:s') : null,
            'dureeEffectue' => $this->dureeEffectue,
            'dureeActivite' => $this->dureeActivite,
            'estEnRetard' => $this->estEnRetard,
            'minutesRetard' => $this->minutesRetard,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),

            // Relations
            'apprenant' => $this->whenLoaded('apprenant', function () {
                return [
                    'id' => $this->apprenant->id,
                    'nom' => $this->apprenant->nom,
                    'prenom' => $this->apprenant->prenom,
                    'email' => $this->apprenant->email,
                ];
            }),

            'activite' => $this->whenLoaded('activite', function () {
                return [
                    'id' => $this->activite->id,
                    'titre' => $this->activite->titre,
                    'description' => $this->activite->description,
                    'duree' => $this->activite->duree,
                ];
            }),

            'scores' => $this->whenLoaded('scores', function () {
                return $this->scores->map(function ($score) {
                    return [
                        'id' => $score->id,
                        'score' => $score->score,
                        'max_score' => $score->max_score,
                        'critere' => $score->critere,
                    ];
                });
            }),

            'feedback' => $this->whenLoaded('feedback', function () {
                return $this->feedback ? [
                    'id' => $this->feedback->id,
                    'commentaire' => $this->feedback->commentaire,
                    'dateFeedback' => $this->feedback->dateFeedback->format('Y-m-d H:i:s'),
                ] : null;
            }),

            'reponses_questions' => $this->whenLoaded('reponsesQuestions', function () {
                return $this->reponsesQuestions->map(function ($reponse) {
                    return [
                        'id' => $reponse->id,
                        'question_id' => $reponse->question_id,
                        'reponse' => $reponse->reponse,
                        'question' => [
                            'id' => $reponse->question->id,
                            'texte' => $reponse->question->texte,
                            'type' => $reponse->question->type,
                        ],
                    ];
                });
            }),

            'penalites' => $this->whenLoaded('penalites', function () {
                return $this->penalites->map(function ($penalite) {
                    return [
                        'id' => $penalite->id,
                        'dureeInitial' => $penalite->dureeInitial,
                        'tempsDeRetard' => $penalite->tempsDeRetard,
                        'penalite' => $penalite->penalite,
                        'type_enum' => $penalite->type_enum,
                        'justificatif' => $penalite->justificatif,
                        'apprenant' => [
                            'id' => $penalite->apprenant->id,
                            'nom' => $penalite->apprenant->nom,
                            'prenom' => $penalite->apprenant->prenom,
                        ],
                    ];
                });
            }),

            // Computed attributes
            'score_total' => $this->whenLoaded('scores', function () {
                return $this->scores->sum('score');
            }),

            'score_max_total' => $this->whenLoaded('scores', function () {
                return $this->scores->sum('max_score');
            }),

            'penalite_total' => $this->whenLoaded('penalites', function () {
                return $this->penalites->sum('penalite');
            }),

            'score_final' => $this->whenLoaded('scores', function () {
                $scoreTotal = $this->scores->sum('score');
                $penaliteTotal = $this->whenLoaded('penalites', function () {
                    return $this->penalites->sum('penalite');
                });
                return max(0, $scoreTotal - $penaliteTotal);
            }),
        ];
    }
}
