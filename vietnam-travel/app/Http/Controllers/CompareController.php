<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'places' => ['nullable', 'array', 'max:3'],
            'places.*' => ['required', 'integer', 'distinct', 'min:1'],
        ]);

        $ids = collect($data['places'] ?? [])
            ->map(fn ($id) => (int) $id)
            ->values();

        $found = Place::query()
            ->with(['province', 'categories'])
            ->where('status', 'active')
            ->whereIn('id', $ids)
            ->get()
            ->keyBy('id');

        $places = $ids
            ->map(fn ($id) => $found->get($id))
            ->filter()
            ->values();

        return view('compare.index', compact('places'));
    }
}
