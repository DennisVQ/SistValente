<?php
class Cliente extends Eloquent
{
  public function storedProcedureCall(){
  	return DB::select('call sp_estado_clientes');
  }
}
?>