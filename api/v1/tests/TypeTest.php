<?php 

use PHPUnit\Framework\TestCase;

class TypeTest extends TestCase{

    public function testTypeConstructorWithTypeName(){
        $type = new Type( 'fire' );
        $this->assertEquals( 'fire', $type->name );
    }

    public function testTypeConstructorWithTypeNumber(){
        $type = new Type( '5' );
        $this->assertEquals( 'ground', $type->name );
    }

    public function testTypeConstructorWithEmptyParameter(){
        $this->expectException("Exception");        
        $type = new Type('');
    }

    public function testTypeConstructorWithNonTypeName(){
        $this->expectException("Exception");        
        $type = new Type('sound');
    }

    public function testTypeConstructorWithNullParameter(){
        $this->expectException("Exception");        
        $type = new Type(null);
    }
}

?>