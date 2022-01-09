<?php 

use PHPUnit\Framework\TestCase;

class BattleControllerTest extends TestCase{

    private $op;

    public function setUp():void{
        $this->op = new BattleController();
    }

    public function testBattleControllerGetProperties(){
        $res = array( 'pokemon'=> array( 'name'=> 'groudon',
                                         'can_deal_double_damage'=> 'yes',
                                         'can_receive_half_or_no_damage'=> 'yes, no damage' ),
                       'versus'=> array( 'name' => 'pikachu') );
        
        $this->assertEquals( $res, $this->op->get_properties( array('groudon', 'pikachu') ) );
    }
    
}

?>