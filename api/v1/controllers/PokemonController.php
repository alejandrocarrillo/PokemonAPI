<?PHP

require_once 'api/v1/models/Pokemon.php';
require_once 'api/v1/models/Move.php';

class PokemonController{

    function __construct(){
        return true;
    }

    /**
     * @OA\Get(
     *     path="/PokemonAPI/v1/pokemon/common_moves/{pokemon1}/{pokemon2}/{language}/{limit}",
     *     summary="Gets common moves between Pokemon.",
     *     description="Returns the moves two pokemon have in common in any language and with a limit number of moves.", 
     *     tags={"pokemon"},
     *     @OA\Parameter(
     *         description="Name or id of the pokemon",
     *         in="path",
     *         name="pokemon1",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Name or id of the pokemon",
     *         in="path",
     *         name="pokemon2",
     *         required=true,
     *         @OA\Schema(
     *           type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Abbreviation of a language",
     *         in="path",
     *         name="language",
     *         required=false,
     *         @OA\Schema(
     *           type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Number of moves to return",
     *         in="path",
     *         name="limit",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int32"
     *         ),
     *     ),
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Pokemon not found, Invalid limit, Invalid language ")
     * )
     */
    public function get_common_moves( $params ){
        $pokemon_name_1 = array_shift( $params );
        $pokemon_name_2 = array_shift( $params );

        try {
            $pokemon_1 = new Pokemon($pokemon_name_1);
            $pokemon_2 = new Pokemon($pokemon_name_2);
        } catch (Exception $e) {
            return array('error'=>$e->getMessage());
        }
        
        $common_moves = array_intersect($pokemon_1->moves, $pokemon_2->moves);

        $language = array_shift( $params );
        $limit = array_shift( $params );

        if( !empty( $limit ) ){
            if( is_numeric( $limit ) ){
                $common_moves = array_slice($common_moves, 0, $limit);
            }else{
                http_response_code(404);
                return array('error'=>'Invalid limit.');
            }
        }

        if( $language && $language != 'en' ){
            foreach( $common_moves as $key => $move_name ){
                $move = new Move($move_name);
                $move_translated = $move->translate($language);

                if( !$move_translated ){
                    http_response_code(404);
                    return array('error'=>'Invalid language.');
                }

                $common_moves[$key] = $move_translated;
            }
        }

        return array( 'pokemons'=>array($pokemon_1->name, $pokemon_2->name), 'common_moves'=> array_values($common_moves) );
    }
}

?>