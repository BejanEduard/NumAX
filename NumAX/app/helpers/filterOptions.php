<?php
    include(ROOT_PATH . "/app/database/connect.php");
	 function getData($sqlQuery) {
        global $conn;
		$result = mysqli_query($conn, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error($conn));
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	function getNumRows($sqlQuery) {
        global $conn;
		$result = mysqli_query($conn, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error($conn));
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}		
	 function getCountry(){
        global $conn;
		$sqlQuery = "
			SELECT DISTINCT(country)
			FROM coins 
			WHERE id is not null ORDER BY country DESC";
        return  getData($sqlQuery);
	}
	 function getComposition(){
        global $conn;
		$sqlQuery = "
			SELECT DISTINCT(composition)
			FROM coins 
			WHERE id is not null ORDER BY composition DESC";
        return  getData($sqlQuery);
	}
	 function getShape(){
        global $conn;
		$sqlQuery = "
			SELECT DISTINCT(shape)
			FROM coins 
			WHERE id is not null ORDER BY shape DESC";
        return  getData($sqlQuery);
	}

?>