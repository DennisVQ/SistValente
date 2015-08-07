<?php
class Organizacion extends Eloquent
{

/*Porque termina en es  no s se hace esto*/
protected $table = 'organizaciones';


  public function usuario(){
     return $this->hasMany('Usuario');
  }
}
?>