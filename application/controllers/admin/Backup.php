<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends MY_Controller {	 
	 
	public function __construct(){
	  // Call the Model constructor
	   parent::__construct();
	   
	    if(!$this->isAdminLoggedIn()){
			 redirect(ADMIN_FOLDER);		
		}
	}
	
	public function exportimport()
	{
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
        $this->load->view(ADMIN_FOLDER."/backup/exportimport", $data);
	}	
	public function excel()
	{
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
				$mysqlUserName      = ($_SERVER['HTTP_HOST']=="localhost")? LUSER:SUSER;
				$mysqlPassword      = ($_SERVER['HTTP_HOST']=="localhost")? LPASS:SPASS;
				$mysqlHostName      = "localhost";
				$DbName             = ($_SERVER['HTTP_HOST']=="localhost")? LDB:SDB;
				$backup_name        = "RendezvousDb";
				$con = mysqli_connect('localhost', $mysqlUserName, $mysqlPassword, $DbName);
		$form_data = $this->input->post();
		if($form_data['submitdata'] =='1' && $this->input->post())
		{
		$tbl= array($form_data['tbl_name']);
		$backup_name        = $form_data['tbl_name'];
		$this->exportExcel($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName,  $backup_name,$backup_name );
  //  $this->Export_DatabaseEXL($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName,  $tbl, $backup_name );
		}		
				
				$tables = array();
				
				$result = mysqli_query($con,"SHOW TABLES");
				while ($row = mysqli_fetch_row($result)) {
				$tables[] = $row[0];
}

         $data['table'] = $tables;
        $this->load->view(ADMIN_FOLDER."/backup/excel", $data);
	}
	public function import()
	{
		$oprt_id  = $this->session->userdata('oprt_id');
		$sel_query = $this->db->query("SELECT * FROM ".prefix."tbl_operator WHERE oprt_id='$oprt_id'");
		$fetchRow = $sel_query->row_array();
		$data['fetchRow']=$fetchRow;
				$mysqlUserName      = ($_SERVER['HTTP_HOST']=="localhost")? LUSER:SUSER;
				$mysqlPassword      = ($_SERVER['HTTP_HOST']=="localhost")? LPASS:SPASS;
				$mysqlHostName      = "localhost";
				$DbName             = ($_SERVER['HTTP_HOST']=="localhost")? LDB:SDB;
				$backup_name        = "RendezvousDb";
				$con = mysqli_connect('localhost', $mysqlUserName, $mysqlPassword, $DbName);
		$form_data = $this->input->post();
		if($form_data['submitdata'] =='1' && $this->input->post())
		{
		//$filename = realpath($_FILES["file"]["tmp_name"]);
		//$this->importDB($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName,filename );
  //  $this->Export_DatabaseEXL($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName,  $tbl, $backup_name );
		}		
				
				$tables = array();
				
				$result = mysqli_query($con,"SHOW TABLES");
				while ($row = mysqli_fetch_row($result)) {
				$tables[] = $row[0];
}

         $data['table'] = $tables;
        $this->load->view(ADMIN_FOLDER."/backup/import", $data);
	}
	public function export()
	{
	$mysqlUserName      = ($_SERVER['HTTP_HOST']=="localhost")? LUSER:SUSER;
    $mysqlPassword      = ($_SERVER['HTTP_HOST']=="localhost")? LPASS:SPASS;
    $mysqlHostName      = "localhost";
    $DbName             = ($_SERVER['HTTP_HOST']=="localhost")? LDB:SDB;
    $backup_name        = "RendezvousDb";
	$con = mysqli_connect('localhost', $mysqlUserName, $mysqlPassword, $DbName);


     $tables = array();

	$result = mysqli_query($con,"SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
	$tables[] = $row[0];
}
  

   //or add 5th parameter(array) of specific tables:    array("mytable1","mytable2","mytable3") for multiple tables

    $this->Export_Database($mysqlHostName,$mysqlUserName,$mysqlPassword,$DbName,  $tables=false, $backup_name=false );

   
	}	
	public  function Export_Database($host,$user,$pass,$name,  $tables=false, $backup_name=false )
    {
        
       
        $mysqli = new mysqli($host,$user,$pass,$name); 
        $mysqli->select_db($name); 
        $mysqli->query("SET NAMES 'utf8'");

        $queryTables    = $mysqli->query('SHOW TABLES'); 
        while($row = $queryTables->fetch_row()) 
        { 
            $target_tables[] = $row[0]; 
        }   
        if($tables !== false) 
        { 
            $target_tables = array_intersect( $target_tables, $tables); 
        } 
       
        foreach($target_tables as $table)
        {
            $result         =   $mysqli->query('SELECT * FROM '.$table);  
            $fields_amount  =   $result->field_count;  
            $rows_num=$mysqli->affected_rows;     
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table); 
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";
           
            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) 
            {
                while($row = $result->fetch_row())  
                { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 )  
                    {
                            $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)  
                    { 
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); 
                        if (isset($row[$j]))
                        {
                            $content .= '"'.$row[$j].'"' ; 
                        }
                        else 
                        {   
                            $content .= '""';
                        }     
                        if ($j<($fields_amount-1))
                        {
                                $content.= ',';
                        }      
                    }
                    $content .=")"; 
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) 
                    {   
                        $content .= ";";
                    } 
                    else 
                    {
                        $content .= ",";
                    }
                    $st_counter=$st_counter+1;
                } 
            } 
             
            $content .="\n\n\n";
           
          
        }
        
        
         
        $backup_name = $backup_name ? $backup_name : $name."___(".date('d-m-Y')."_".date('H-i-s').".sql";
        //$backup_name = $backup_name ? $backup_name : $name.".sql";
        header('Content-Type: application/octet-stream');   
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"".$backup_name."\"");  
        echo $content; exit;
    }
	public  function Export_DatabaseEXL($host,$user,$pass,$name,  $tables, $backup_name=false )
    {
        $mysqli = new mysqli($host,$user,$pass,$name); 
        $mysqli->select_db($name); 
        $mysqli->query("SET NAMES 'utf8'");


        if($tables !== false) 
        { 
            $target_tables = array_intersect( $target_tables, $tables); 
        }  
		//PrintR($target_tables);die;
        foreach($tables as $table)
        {
            $result         =   $mysqli->query('SELECT * FROM '.$table);  
            $fields_amount  =   $result->field_count;  
            $rows_num=$mysqli->affected_rows;     
            $res            =   $mysqli->query('SHOW CREATE TABLE '.$table); 
            $TableMLine     =   $res->fetch_row();
            $content        = (!isset($content) ?  '' : $content) . "\n\n".$TableMLine[1].";\n\n";

            for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) 
            {
                while($row = $result->fetch_row())  
                { //when started (and every after 100 command cycle):
                    if ($st_counter%100 == 0 || $st_counter == 0 )  
                    {
                            $content .= "\nINSERT INTO ".$table." VALUES";
                    }
                    $content .= "\n(";
                    for($j=0; $j<$fields_amount; $j++)  
                    { 
                        $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); 
                        if (isset($row[$j]))
                        {
                            $content .= '"'.$row[$j].'"' ; 
                        }
                        else 
                        {   
                            $content .= '""';
                        }     
                        if ($j<($fields_amount-1))
                        {
                                $content.= ',';
                        }      
                    }
                    $content .=")";
                    //every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
                    if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) 
                    {   
                        $content .= ";";
                    } 
                    else 
                    {
                        $content .= ",";
                    } 
                    $st_counter=$st_counter+1;
                }
            } $content .="\n\n\n";
        }
        //$backup_name = $backup_name ? $backup_name : $name."___(".date('d-m-Y')."_".date('H-i-s').".sql";
        $backup_name = $backup_name .".csv";
        header('Content-Type: application/octet-stream');   
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"".$backup_name."\"");  
        echo $content; exit;
    }	
	public function exportExcel($DB_Server, $DB_Username, $DB_Password,$DB_DBName,$DB_TBLName,$filename)
	{
	$sql = "Select * from $DB_TBLName";
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database   
$Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());   
//execute query 
$result = @mysql_query($sql,$Connect) or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());    
$file_ending = "xls";
//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysql_num_fields($result); $i++) {
echo mysql_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysql_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysql_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
	}}
	public function importDB($mysql_host, $mysql_username, $mysql_password,$mysql_database,$filename)
	{
	
	    //Drop table from database   
		$con = mysqli_connect($mysql_host, $mysql_username, $mysql_password,$mysql_database);
		$tables = array();
		$result = mysqli_query($con,"SHOW TABLES");
		while ($row = mysqli_fetch_row($result)) {
		$tables[] = $row[0];
		}
		foreach($tables as $tab)
		{	if($tab !='tbl_operator'){	
		$sql = "DROP TABLE $tab";
		mysqli_query($con, $sql);
		}	
		}
		
		
		//Import Database here

// Connect to MySQL server
mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';}}
		
		
	}
	
}
