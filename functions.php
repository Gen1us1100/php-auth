<?php
    function already_exists(string $table_name,string $col_name,string $value){
        // check if username or email already exists in database
        global $conn;
        $check_col = "SELECT {$col_name} FROM {$table_name} where $col_name=?";
        $stmt = $conn->prepare($check_col);
        $stmt->bind_param("s",$value);
        $stmt->execute();
        $stmt->store_result();
        $result = $stmt->num_rows();
        return ($result>0)?True:False;   
    }

?>