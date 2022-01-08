<?PHP

require_once 'models/Pokemon.php';
require_once 'models/Type.php';

/**
     * @OA\Info(title="PokemonAPI", version="0.1")
*/

class BattleController{

    function __construct(){
        return true;
    }

    /**
     * @OA\Get(
     *     path="/battle/properties",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */

    public function get_properties( $params ){
        $pokemon_name_1 = array_shift( $params );
        $pokemon_name_2 = array_shift( $params );

        try {
            $pokemon_1 = new Pokemon($pokemon_name_1);
            $pokemon_2 = new Pokemon($pokemon_name_2);
        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }
        
        $res = array( 'pokemon'=> array( 'name'=> $pokemon_1->name, 
                                         'can_deal_double_damage'=> 'no',
                                         'can_receive_half_or_no_damage'=> 'no' ) );
        
        foreach( $pokemon_1->types as $type_name ){
            $type = new Type( $type_name );

            $double_damage_array = array_intersect($type->damage_relations['double_damage_to'],$pokemon_2->types);
            $no_damage_array = array_intersect($type->damage_relations['no_damage_from'],$pokemon_2->types);
            $half_damage_array = array_intersect($type->damage_relations['half_damage_from'],$pokemon_2->types);

            if( !empty($double_damage_array) ){
                $res['pokemon']['can_deal_double_damage'] = 'yes';
            }

            if( !empty($no_damage_array) ){
                $res['pokemon']['can_receive_half_or_no_damage'] = 'yes, no damage';
            }else if( !empty($half_damage_array) ){
                $res['pokemon']['can_receive_half_or_no_damage'] = 'yes, half damage';
            }
        }

        return $res;
    }
}

?>