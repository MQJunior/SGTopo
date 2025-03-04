<?php

class Debug_lib {
    protected $SISTEMA_=null;
    public $MensagemDebug;
    public function DebugPrint( $p_MensagemDebug ) {
        $this->MensagemDebug = $p_MensagemDebug;
        echo "DebugPrint::OK >". $p_MensagemDebug ."< \n";
    }

    public function DebugError( $p_MensagemDebug ) {
        $this->MensagemDebug = $p_MensagemDebug;
        die("DebugPrint::Error >". $p_MensagemDebug ."< \n");
    }
    public function DebugInfo( ) {
        print_r($this->SISTEMA_);
        //print(json_encode( $this->SISTEMA_, JSON_PRETTY_PRINT ));  

    }
}
?>