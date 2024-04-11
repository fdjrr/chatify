<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
  public User $user;
  public string $message = '';

  public function render()
  {
    return view('livewire.chat', [
      'messages' => Message::query()
        ->where('from_user_id', Auth::user()->id)
        ->orWhere('from_user_id', $this->user->id)
        ->orWhere('to_user_id', Auth::user()->id)
        ->orWhere('to_user_id', $this->user->id)
        ->get(),
    ]);
  }

  public function sendMessage()
  {
    Message::create([
      'from_user_id' => Auth::user()->id,
      'to_user_id'   => $this->user->id,
      'message'      => $this->message,
    ]);
  }
}
