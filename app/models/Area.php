<?php
class Area extends Eloquent
{
  public function usuario(){
     return $this->hasMany('Usuario');
  }

  public function jefe(){
     return $this->belongTo('Usuario', 'jefe_id', 'id');
  }

}
?>