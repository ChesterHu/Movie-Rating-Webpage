<!-- Functions used in this project -->
<?php
	  // Function to do query_search, it basicly constructs a string in the form of:
	  //       SELECT print_name FROM db_name WHERE search_col LIKE search_array[0] AND search_col LIKE search_array[1] ...
	  // INPUT:
	  // search_array: array of string, every string in this array must be contained in the search_col in any order
	  // db_name: string, the name of database the function tends to search
	  // search_col: string, can be either an column name in the db_name database or an operation (concat, substr, etc.), which returns a string,
	  //             the function matches all strings in the search_array in this column name or returned string from a sql operation in any order.
	  // print_name: string, the column names returned from mysql search
	  // $db_connection: object returned from mysqli_connect, is the connection to the database the function searches in.
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
	  // data: object returned from mysqli_query, is a table returned by mysql SELECT query
	  // title: string, the title to be printed in above the table
	  // col_names: array of strings, column names to be printed in the table
	  // linkPage: string, if not empty tuples will be linked to the given page, and link id will use the last var in $data
	  // linkCol: int, indicates which column should have the link, work only $linkPage specified, default is first column
	function printTable($data, $title, $col_names, $linkPage = "", $linkCol = 0)
	{
		echo '<div class = container>'. 
		     '<h2>'. $title. '</h2>'.
		     '<table class="table table-bordered table-hover table-condensed">'.
		     '<thead>'.
			 '<tr>';
		foreach($col_names as $c)
			echo '<th>' . $c . '</th>';
		echo '</tr>'.
		     '</thead>'.
		     '<tbody>';
		while ($row = mysqli_fetch_row($data))
		{
			echo '<tr>';
			for ($i = 0; $i < count($col_names); $i++)
			{
				if ($row[$i] == "")
					echo '<td>-</td>';
				else if (empty($linkPage) || $i != $linkCol)  // if no link page specified or not the specified link column, print var
					echo '<td>' . $row[$i] . '</td>';
				else  // if link page specified and it's the specified column, print var, link it to linkPage and transfer id via GET method
					echo '<td>' . '<a href="' .  $linkPage . '?' . 'ID=' . end($row) . '">' . $row[$i] . '</a></td>';	
			}
			echo '</tr>';
		}
		echo '</tbody>'.
		     '</table>'.
			 '</div>';
	}

	  // Function to get movie or person id, it will do query in MaxPersonID/MaxMovieID
	  // INPUT: 
	  // identity: string, "Movie"/"Person"
	  // db_connection: object returned from mysqli_connection, the connection to the data base
	function getId($identity, $db_connection)
	{
		$query = "SELECT id FROM Max" . $identity . "ID";
		return mysqli_fetch_row(mysqli_query($db_connection, $query))[0];
	}	

	  // Function to convert data into valid format
	  // It will strip unnecessary characters (extra space, tab, newline) from the user input data
	  // remove the backslashes (\) from the user input, and convert html special characters exploits
	function valid_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	  // Funtion to insert new tuple into database, return true if the database insert successfully
	  // INPUT:
	  // dbName: string, the database name to search
	  // vars: array of strings, names of variables to search in the database
	  // db_connection: database connection object, return from mysqli_connect()
	function insertTuple($dbName, $vars, $db_connection)
	{
		$query = "INSERT INTO $dbName VALUES( ";
		foreach($vars as $val)
			$query .= "$val ,";
		  // replace last comma by left parenthese
		$query = substr($query, 0, -1) . ")";
		return mysqli_query($db_connection, $query);
	}
?>
