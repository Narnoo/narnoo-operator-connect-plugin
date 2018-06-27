<?

namespace Narnoo\Media;
/**
*
*/
class Media extends \Narnoo\Base
{
    /**************************************************
    *
    *                --- IMAGES ---
    *
    **************************************************/
    
    /**
    *   @title: Get Images
    *   @date: 25.06.2018
    *   @param: array page | total
    *   @result: JSON
    */
    public function getImages($value)
    {   
        if(empty($value['page'])){
            $value['page'] = 1;
        }
        $query = http_build_query($value);
        try{
            $url = "/image/list?".$query;
            $response = $this->callNarnooAPI("get",$url,$value);
            return $response;
        } catch (Exception $e) {
            $response = array("error" => $e->getMessage());
            return $response;
        }
    }


     /**
    *   @title: Get Image Details
    *   @date: 25.06.2018
    *   @param: int image ID
    *   @param: array page | total
    *   @result: JSON
    */
    public function getImageDetails($id,$value)
    {
        if(empty($value['page'])){
            $value['page'] = 1;
        }
        
        $query = http_build_query($value);
        try{
            $url = "/image/details/".$id."?".$query;
            $response = $this->callNarnooAPI("get",$url,$value);
            return $response;
        } catch (Exception $e) {
            $response = array("error" => $e->getMessage());
            return $response;
        }
    }


    /**************************************************
    *
    *                --- .IMAGES ---
    *
    **************************************************/



}

?>