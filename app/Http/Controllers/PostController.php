<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $posts = Post::with(['apprenant', 'thematique'])->whereNull('parent_post_id')->get();

            return response()->json($posts);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur récupération'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        try {
            $post = Post::create([
                ...$request->validated(),
                'apprenant_id' => auth()->id()
            ]);

            return response()->json([
                'message' => 'Post créé avec succès',
                'data' => $post
            ], 201);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur création post'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        try {
            return response()->json(
                $post->load(['apprenant', 'reponses.apprenant'])
            );

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        try {
            $post->update($request->validated());

            return response()->json([
                'message' => 'Post mis à jour',
                'data' => $post
            ]);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur update'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();

            return response()->json([
                'message' => 'Post supprimé'
            ]);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur suppression'], 500);
        }
    }


    public function repondre(PostRequest $request, Post $post)
    {
        try {
            $reponse = Post::create([
                'contenu' => $request->contenu,
                'description' => $request->description,
                'typePost' => 'reponse',
                'thematique_id' => $post->thematique_id,
                'parent_post_id' => $post->id,
                'apprenant_id' => auth()->id()
            ]);

            return response()->json([
                'message' => 'Réponse ajoutée',
                'data' => $reponse
            ], 201);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur réponse'], 500);
        }
    }


    public function postsByThematique($id)
    {
        try {
            $posts = Post::where('thematique_id', $id)
                ->whereNull('parent_post_id')
                ->with('apprenant')
                ->get();

            return response()->json($posts);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }


    public function postsByUser()
    {
        try {
            $posts = auth()->user()->posts()->with('thematique')->get();

            return response()->json($posts);

        } catch (\Exception $e) {
            Log::debug($e->getMessage());

            return response()->json(['error' => 'Erreur'], 500);
        }
    }



}
