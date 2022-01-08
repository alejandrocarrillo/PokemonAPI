<?php 

use PHPUnit\Framework\TestCase;

class PokemonControllerTest extends TestCase{

    private $op;

    public function setUp():void{
        $this->op = new PokemonController();
    }

    public function testPokemonControllerGetCompareMovesOnlyPokemon(){
        $res = array( 'common_moves'=> array( "ice-punch","thunder-punch","headbutt","hyper-beam","low-kick","counter","strength","earthquake","dig","toxic","double-team","rest","rock-slide","substitute","snore","protect","mud-slap","foresight","detect","endure","swagger","attract","sleep-talk","return","frustration","hidden-power","rain-dance","sunny-day","rock-smash","facade","focus-punch","helping-hand","role-play","brick-break","secret-power","rock-tomb","bulk-up","natural-gift","payback","fling","poison-jab","vacuum-wave","focus-blast","giga-impact","rock-climb","stone-edge","captivate","low-sweep","round","retaliate","bulldoze","work-up","dual-chop","confide","power-up-punch" ) );
        $this->assertEquals( $res, $this->op->get_compare_moves( array('machamp', 'lucario') ) );
    }

    public function testPokemonControllerGetCompareMovesDiffLanguage(){
        $res = array( 'common_moves'=> array( "Danza Espada","Golpe Cabeza","Golpe Cuerpo","Doble Filo","Lanzallamas","Fuerza","Tóxico","Mimético","Doble Equipo","Llamarada","Rapidez","Descanso","Avalancha","Sustituto","Ronquido","Protección","Cara Susto","Bofetón Lodo","Enfado","Aguante","Contoneo","Corte Furia","Sonámbulo","Retribución","Frustración","Cola Férrea","Poder Oculto","Día Soleado","Triturar","Poder Pasado","Golpe Roca","Imagen","Demolición","Daño Secreto","Sofoco","Tumba Rocas","Golpe Aéreo","Garra Dragón","Danza Dragón","Don Natural","Lanzamiento","Pulso Dragón","Garra Umbría","Afilagarras","Canon","Eco Voz","Calcinación","Confidencia" ));
        $this->assertEquals( $res, $this->op->get_compare_moves( array('rayquaza','charmander','es') ) );
    }

    public function testPokemonControllerGetCompareMovesLimit(){
        $res = array( 'common_moves'=> array( "fire-punch","ice-punch","thunder-punch","headbutt","body-slam","take-down","double-edge","flamethrower","water-gun","ice-beam" ) );
        $this->assertEquals( $res, $this->op->get_compare_moves( array('dragonite','jigglypuff','en', '10') ) );
    }

    public function testPokemonControllerGetCompareMovesInvalidLanguage(){
        $res = array('error'=>'Invalid language.');
        $this->assertEquals( $res, $this->op->get_compare_moves( array('roserade','mew','japones') ) );
    }

    public function testPokemonControllerGetCompareMovesInvalidLimit(){
        $res = array('error'=>'Invalid limit.');
        $this->assertEquals( $res, $this->op->get_compare_moves( array('snorlax','greninja','en', 'cinco') ) );
    }
    
}

?>