<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainVideo extends Model
{
  protected $guarded = [];
  protected $table = 'main_video';

  public function remove()
  {
    unlink(public_path($this->thumbnail));
		unlink(public_path($this->video));
    $this->delete();
  }
}
