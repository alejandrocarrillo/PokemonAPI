<?php 

use PHPUnit\Framework\TestCase;

class PokemonTest extends TestCase{

    public function testPokemonConstructorWithPokemonName(){
        $pokemon = new Pokemon( 'pikachu' );
        $this->assertEquals( 'pikachu', $pokemon->name );
    }

    public function testPokemonConstructorWithPokemonNumber(){
        $pokemon = new Pokemon( '376' );
        $this->assertEquals( 'metagross', $pokemon->name );
    }

    public function testPokemonConstructorWithEmptyParameter(){
        $this->expectException("Exception");        
        $pokemon = new Pokemon('');
    }

    public function testPokemonConstructorWithNonPokemonName(){
        $this->expectException("Exception");        
        $pokemon = new Pokemon('Brighton');
    }

    public function testPokemonConstructorWithNullParameter(){
        $this->expectException("Exception");        
        $pokemon = new Pokemon(null);
    }
}

?>