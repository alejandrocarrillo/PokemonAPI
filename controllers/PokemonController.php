<?PHP

require 'models/Pokemon.php';
require 'models/Move.php';

class PokemonController{

    function __construct(){
        return true;
    }

    public function get_compare_moves( $params ){
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
            $common_moves = array_slice($common_moves, 0, $limit);
        }

        if( $language && $language != 'en' ){
            setlocale(LC_ALL, $language);
            foreach( $common_moves as $key => $move_name ){
                $move = new Move($move_name);
                $move_translated = $move->translate($language);

                $common_moves[$key] = $move_translated;
            }
        }

        return array( 'common_moves'=> array_values($common_moves) );
    }
}

?>