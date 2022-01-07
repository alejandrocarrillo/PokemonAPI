<?php

require 'vendor/autoload.php';
use PokePHP\PokeApi;

class Type{

    public $id;
    public $name;
    public $damage_relations = array();
    private $type_object;

    public function __construct( $name ){
        $api = new PokeApi;
        $type = $api->pokemonType( $name );
        
        if( $type == '"An error has occured."' ){
            throw new Exception( 'No type found.' ); 
            return;
        } 

        $this->type_object = json_decode( $type, true );

        $this->id = $this->type_object['id'];
        $this->name = $this->type_object['name'];

        $this->damage_relations[ 'double_damage_to' ] = array();
        foreach( $this->type_object['damage_relations']['double_damage_to'] as  $damage_type ){
            array_push($this->damage_relations['double_damage_to'], $damage_type['name']);
        }

        $this->damage_relations[ 'no_damage_from' ] = array();
        foreach( $this->type_object['damage_relations']['no_damage_from'] as  $damage_type ){
            array_push($this->damage_relations['no_damage_from'], $damage_type['name']);
        }

        $this->damage_relations[ 'half_damage_from' ] = array();
        foreach( $this->type_object['damage_relations']['half_damage_from'] as  $damage_type ){
            array_push($this->damage_relations['half_damage_from'], $damage_type['name']);
        }
    }
}
?>