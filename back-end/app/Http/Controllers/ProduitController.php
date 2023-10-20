<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit; 
use Validator;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::all();
        return response()->json(['data' => $produits], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'nom' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $produit = new Produit;
        $produit->user_id = $request->user_id;
        $produit->nom = $request->nom;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->save();

        return response()->json(['message' => 'Produit créé avec succès'], 201);
    }

    public function show($id)
    {
        $produit = Produit::find($id);
        if (!$produit) {
            return response()->json(['error' => 'Produit non trouvé'], 404);
        }
        return response()->json(['data' => $produit], 200);
    }

    public function update(Request $request, $id)
    {
        $produit = Produit::find($id);
        if (!$produit) {
            return response()->json(['error' => 'Produit non trouvé'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'description' => 'required|string',
            'prix' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $produit->nom = $request->nom;
        $produit->description = $request->description;
        $produit->prix = $request->prix;
        $produit->save();

        return response()->json(['message' => 'Produit mis à jour avec succès'], 200);
    }

    public function destroy($id)
    {
        $produit = Produit::find($id);
        if (!$produit) {
            return response()->json(['error' => 'Produit non trouvé'], 404);
        }

        $produit->delete();
        return response()->json(['message' => 'Produit supprimé avec succès'], 200);
    }
}
