<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Cards;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    public function create(Request $request)
    {
        //dd($request->all());
        Cards::create([
            'title' => $request->cardTitle,
            'description' => $request->description,
            'file' => $request->file,
            'list_id' => $request->list_id,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'Card created successfully.');
    }

    public function detail(Request $request, $list_id, $card_id)
    {
        $card = Cards::find($card_id);
        $attachments = Attachment::where('card_id', '=', $card_id)->get();
        return view('card', compact('card', 'attachments'));
    }

    public function updateCard(Request $request)
    {
        if ($request->hasFile('filename')) {
            $name = $request->file('filename')->getClientOriginalName();
            $request->file('filename')->storeAs('public/files/', $name);
        }



        if ($request->card_id) {
            $card = Cards::find($request->card_id);
            $card->title = $request->get('cardTitle');
            $card->description = $request->get('description');
            if ($request->has('checkbox')) {
                $card->status = 1;
            } else {
                $card->status = 0;
            }

            if ($request->hasFile('filename')) {
                Attachment::create([
                    'user_id' => Auth::user()->id,
                    'card_id' => $request->card_id,
                    'name' => $name,
                    'file' => base64_encode($name)
                ]);
            }
            $card->save();
            return redirect()->back();
        }
    }

    public function deleteCard(Request $request)
    {
        $card = Cards::find($request->card_id);
        $card->delete();
        return redirect()->back();
    }

    public function deleteAttachment(Request $request)
    {
        $attachment = Attachment::find($request->atth_id);
        $attachment->delete();
        return redirect()->back();
    }
}

// $card->attachment->file = $name;
// $card->attachment->user_id = Auth::user()->id;
// $card->attachment->card_id = $request->card_id;
