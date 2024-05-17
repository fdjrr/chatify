<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\User;
// use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
        ->where(function (Builder $query) {
          $query
            ->where('from_user_id', Auth::user()->id)
            ->where('to_user_id', $this->user->id);
        })
        ->orWhere(function (Builder $query) {
          $query
            ->where('from_user_id', $this->user->id)
            ->where('to_user_id', Auth::user()->id);
        })
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
