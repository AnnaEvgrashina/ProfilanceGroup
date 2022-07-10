<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        return view('shortLink');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request_data = $request->only(['link']);
        $validator = Validator::make($request_data, ['link' => 'required|string|url']);
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 400);
        }
        do {
            $short_link = url('') . '/' . Str::random(10);
        } while (Link::where('short_link', $short_link)->first());
        $link = Link::create([
            'link' => $request_data['link'],
            'short_link' => $short_link,
        ]);
        return response($short_link);
    }

    public function getAllLinks()
    {
        $links = Link::all(['link', 'short_link', 'number_visits']);
        return response()->json($links);
    }

    public function redirectShortLink($short_link)
    {
        $short_link = url('') . '/' . $short_link;
        $link = Link::where('short_link', $short_link)->first();
        $link->fill(['number_visits' => $link->number_visits + 1])->save();
        return redirect($link->link);
    }
}
