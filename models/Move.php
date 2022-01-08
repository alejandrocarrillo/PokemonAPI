<?php

// require 'vendor/autoload.php';
use PokePHP\PokeApi;

class Move{

    public $id;
    public $name;
    private $move_object;
    
    public function __construct( $name ){
        $api = new PokeApi;
        
        $move = $api->move( $name );
        
        if( $move == '"An error has occured."' || $name == '' ){
            throw new Exception( 'No move found.' ); 
            return;
        }         
        
        $this->move_object = json_decode( $move, true );

        $this->id = $this->move_object['id'];
        $this->name = $this->move_object['name'];
    }

    public function translate( $language ){
        foreach( $this->move_object['names'] as $foreign_name ){
            if( $foreign_name['language']['name'] == $language ){
                return $foreign_name['name'];
            }
        }
        return false;
    }
}
?>