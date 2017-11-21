<?php
	// Functions used in project 1B

	  // Function to do query_search, it basicly constructs a string in the form of:
	  //       SELECT print_name FROM db_name WHERE search_col LIKE search_array[0] AND search_col LIKE search_array[1] ...
	  // INPUT:
	  // search_array: An array of string, every string in this array must be contained in the search_col in any order
	  // db_name: A string, the name of database the function tends to search
	  // search_col: A string, can be either an column name in the db_name database or an operation (concat, substr, etc.), which returns a string,
	  //             the function matches all strings in the search_array in this column name or returned string from a sql operation in any order.
	  // print_name: A string, the column names returned from mysql search
	  // $db_connection: An object returned from mysqli_connect, is the connection to the database the function searches in.
	function querySearch($search_array, $db_name, $search_col, $print_name, $db_connection)
	{
		$query = "SELECT $print_name FROM $db_name WHERE";
		foreach($search_array as $word)
			$query .= ' ' . $search_col . ' LIKE "%'. $word . '%" AND';
		  // remove last "AND"
		$query = substr($query, 0, -3);
		$tbl = mysqli_query($db_connection, $query);
		return $tbl;
	}

	  // Function to print a mysql table in the format of bootstrap bordered table
	  // INPUT:
	  // data: An object returned from mysqli_query, is a table returned by mysql SELECT query
	  // title: A string, the title to be printed in above the table
	  // col_names: A string, column names to be printed in the table
	function printTable($data, $title, $col_names)
	{
		echo '<div class = container>'. 
		     '<h2>'. $title. '</h2>'.
		     '<table class="table table-bordered">'.
		     '<thead>'.
			 '<tr>';
			 foreach($col_names as $c_name)
				 echo '<th>' . $c_name . '</th>';
		echo '</tr>'.
		     '</thead>'.
		     '<tbody>';
		while ($row = mysqli_fetch_row($data))
		{
			echo '<tr>';
			for ($i = 0; $i < count($row); $i++)
				echo '<td>' . $row[$i] . '</td>';
			echo '</tr>';
		}
		echo '</tbody>'.
		     '<table>'.
			 '</div>';
	}
?>
