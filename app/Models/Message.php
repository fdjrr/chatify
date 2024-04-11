<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
  use HasFactory;

  /**
   * Get the from_user that owns the Message
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function from_user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'from_user_id', 'id');
  }

  /**
   * Get the to_user that owns the Message
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function to_user(): BelongsTo
  {
    return $this->belongsTo(User::class, 'to_user_id', 'id');
  }
}
