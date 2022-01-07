<?php

require 'vendor/autoload.php';
use PokePHP\PokeApi;

class Pokemon{

    public $id;
    public $name;
    public $types = array();
    public $moves = array();
    private $pokemon_object;

    public function __construct( $name ){
        $api = new PokeApi;
        $pokemon = $api->pokemon( $name );
        
        if( $pokemon == '"An error has occured."' ){
            throw new Exception( 'No pokemon found.' ); 
            return;
        } 
        
        $this->pokemon_object = json_decode( $pokemon, true );

        $this->id = $this->pokemon_object['id'];
        $this->name = $this->pokemon_object['name'];

        foreach( $this->pokemon_object['types'] as $type ){
            array_push($this->types, $type['type']['name']);
        }

        foreach( $this->pokemon_object['moves'] as $move ){
            array_push($this->moves, $move['move']['name']);
        }
    }
}
?>