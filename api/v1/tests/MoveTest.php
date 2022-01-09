<?php 

use PHPUnit\Framework\TestCase;

class MoveTest extends TestCase{

    public function testMoveConstructorWithMoveName(){
        $move = new Move( 'hyper-beam' );
        $this->assertEquals( 'hyper-beam', $move->name );
    }

    public function testMoveConstructorWithMoveNumber(){
        $move = new Move( '200' );
        $this->assertEquals( 'outrage', $move->name );
    }

    public function testMoveConstructorWithEmptyParameter(){
        $this->expectException("Exception");        
        $move = new Move('');
    }

    public function testMoveConstructorWithNonMoveName(){
        $this->expectException("Exception");        
        $move = new Move('kiss-pound');
    }

    public function testMoveConstructorWithNullParameter(){
        $this->expectException("Exception");        
        $move = new Move(null);
    }

    public function testMoveTranslateExistLanguage(){
        $move = new Move( 'hyper-beam' );
        $this->assertEquals( 'Hiperrayo', $move->translate('es') );
    }

    public function testMoveTranslateEmptyParameter(){
        $move = new Move( 'ice-punch' );
        $this->assertEquals( false, $move->translate('') );
    }

    public function testMoveTranslateNullParameter(){
        $move = new Move( 'ice-punch' );
        $this->assertEquals( false, $move->translate(null) );
    }
}

?>