<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstaSlider extends Model
{
  protected $guarded = [];
  protected $table = 'insta_slider';
  public $timestamps = false;

  public function remove()
  {
    unlink(public_path($this->image));
    $this->delete();
  }
}
