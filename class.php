<?php 
	class user {

		private $db;
	private $_reach = 5,
	$limit = 3,
	$sql,
	$pager,
	$sqlresult;


		public function __construct($db_conn){
			$this->db = $db_conn;
		}
        public function addappointment($doc,$name,$cont,$gen,$dob,$add,$job,$doa){
            try{
                $sql = $this->db->prepare("insert into appointments(doc_id,a_name,a_contact,a_gender,dob,a_address,job,doa) values(:doc,:name,:cont,:gen,:dob,:add,:job,:doa)");
                $sql->execute(array(":doc"=>$doc,":name"=>$name,":cont"=>$cont,":gen"=>$gen,":dob"=>$dob,":add"=>$add,":job"=>$job,":doa"=>$doa));
                return $sql;
            }
            catch(PDOException $msg){
                die("Connection failed:".$msg->getMessage());
            }
        }
        public function addfields($name){
            try{
                $sql= $this->db->prepare("insert into specialty(name) values(:name)");
                $sql->execute(array(":name"=>$name));
                return $sql;               
            }
            catch(PDOException $msg){
                die("Connection failed: ".$msg->getMessage());
            }
        }
          public function adduser($name,$uname,$pass,$add,$cont,$status,$userpic)
        {
            try
            {
                $sql = $this->db->prepare("insert into patient(name,email,password,address,contact,status,image) values (:name,:email,:pass,:add,:cont,:status,:pic)");
                $sql->execute(array(":name"=>$name,":email"=>$uname,":pass"=>$pass,":add"=>$add,":cont"=>$cont,":status"=>$status,"pic"=>$userpic));
                return $sql;
            }
            catch(PDOException $msg)
            {

                die("Connection failed: ".$msg->getMessage());
            }

        }

        public function addoctors($name,$prc,$add,$cont,$email,$pass,$userpic)
        {
            try
            {
                $sql = $this->db->prepare("insert into doctor(prc,name,address,contact,email,password,image) values (:prc,:name,:add,:cont,:email,:pass,:userpic)");
                $sql->execute(array(":name"=>$name,":prc"=>$prc,":add"=>$add,":cont"=>$cont,":email"=>$email,":pass"=>$pass,":userpic"=>$userpic));
                return $sql;
            }
            catch(PDOException $msg)
            {

                die("Connection failed: ".$msg->getMessage());
            }

        }

		public function login($username,$password){
			try{
				$sql = "select * from patient where email = :username and password = :password ";
				$q =$this->db->prepare($sql);
				 $q->execute(array(':username'=>$username,':password'=>$password));
                $row = $q->fetch(PDO::FETCH_ASSOC);
                if($q->rowCount() > 0)
                {
                    $_SESSION['user_ses'] = $row['id'];
                    return true;
                }
            
                 else
                {
                  
                     return false;
                }
			}
			catch(PDOException $msg){
				die("Connection Failed: ".$msg->getMessage());
			}
		}
        public function doclogin($userdoc,$passdoc){
            try{
                $sql = "select * from doctor where email = :username and password = :password ";
                $q =$this->db->prepare($sql);
                 $q->execute(array(':username'=>$userdoc,':password'=>$passdoc));
                $row = $q->fetch(PDO::FETCH_ASSOC);
                if($q->rowCount() > 0)
                {
                    $_SESSION['user'] = $row['id'];
                    return true;
                }
            
                 else
                {
                  
                     return false;
                }
            }
            catch(PDOException $msg){
                die("Connection Failed: ".$msg->getMessage());
            }
        }
		
		public function redirect($url)
        {
            header("Location: $url");
        }//end for redirect method
       
        
        public function isloggedin()
        {
            if(isset($_SESSION['user_ses']))
               
                return true;
            
        }
         public function docisloggedin()
        {
            if(isset($_SESSION['user']))
                return true;
            
        }
        public function logout()
        {
            session_destroy();
            session_unset($_SESSION['user_ses']);
            header("Location:index.php?logout");
            return true;
        }
          public function doclogout()
        {
            session_destroy();
            session_unset($_SESSION['user']);
            header("Location:index.php?doctor_logout");
            return true;
        }

        /*Pagination*/
	public function getSQL($sql) {
        if (mb_strlen($sql)<= 0) {
            throw new Exception('There was a problem in your pager value. It must be a valid sql string.');
        } 
        $this->_sql = $sql;
	}
	/*private function getSequel() {
		return $this->_sql;
	}*/	
	public function setLimit($limit) {
		$this->_limit = $limit;
	}
	public function getLimit()
	{
		return $this->_limit;
	}
	public function getPagerName($pager) {
	if (!is_string($pager)) {
			throw new Exception('There was a problem in your pager value. It must be in a string form.');
		}
		$this->_pager = $pager;
	}	
	private function returnPager() {
		return $this->_pager;
	}

    private function getPager() {
         return ( isset ( $_REQUEST["{$this->_pager}"] ) )  
                ? (int) $_REQUEST["{$this->_pager}"]  
                : 0 
        ;  
        
    }	
    private function getOffset() {
		$current = $this->getCurrentResult();
		$limit = $this->getLimit();
		$offset = (($current - 1)*$limit);
		return (int) $offset;
	}
	private function getReach() {
		return $this->_reach;
	}
	private function genSQL() {
		$limitation = $this->getLimit();
		$offsetting = $this->getOffset();
		
		return $this->_sql. " LIMIT {$limitation} OFFSET {$offsetting}";		
	}
	private function processgenSQL () {
		return $this->db->query($this->genSQL());
	}
	private function getResult() {
		$result = $this->db->query(
					strtolower(str_ireplace('*','COUNT(*)',$this->_sql)));
		return $this->_sqlresult = $result;
	}
	private function getResultProvided() {
		$sql = $this->getResult()->fetchColumn();
		return (int) $sql;
	}
	public function displayUpper() {
		$totalresult = $this->getResultProvided(); 
		if ($totalresult > 0) {
			$currentpage = $this->getCurrentResult();//current page
			$totalpage = $this->getTotalPage();//total page
			//total result
			echo "<div>Showing the page {$currentpage} of {$totalpage} available pages for {$totalresult} results.</div>";
		}else{
			echo "<div>No records fetched.</div>";
		}
	}
	
	public function displayLower() {
		$totalresult = $this->getResultProvided();
		$currentpage = $this->getCurrentResult();
		$totalpage = $this->getTotalPage();
		$reach = $this->getReach();
		$paginator = $this->returnPager();
		
		if ($totalresult > 0) {
			
			if ($currentpage > 1) {
				$previous = $currentpage - 1;
				
				echo " <a href='{$_SERVER['PHP_SELF']}?{$paginator}=1'><span>First</span></a> 
					<a href='{$_SERVER['PHP_SELF']}?{$paginator}={$previous}'><span>Previous</span></a>";
				
			}
			for ($p = ($currentpage - $reach); $p < (($currentpage + $reach) + 1); $p++) {
				if (($p > 0) && ($p <= $totalpage)) {
					if ($p == $currentpage) {
						echo "
						[<span>{$p}</span>]";
					} else {
						echo " <a href='{$_SERVER['PHP_SELF']}?{$paginator}={$p}'><span>{$p}</span></a> ";
					}
				}
			}
			if ($currentpage != $totalpage) {
				$nextpage = $currentpage + 1; 
				echo "
				 <a href='{$_SERVER['PHP_SELF']}?{$paginator}={$nextpage}'><span>Next</span></a>
					<a href='{$_SERVER['PHP_SELF']}?{$paginator}={$totalpage}'><span>Last</span></a> 
				";
			}
			
		}		
	}
	
	private function getCurrentResult() {
		$total = $this->getResultProvided();
		$page = (int) $this->getpager();
		
		if (isset($page)) {
			$currentpage = $page;
		}else{
			$currentpage = 1;
		}
		
		if ($page > $total) {
			$currentpage = $total;
		}
		
		if ($page < 1) {
			$currentpage = 1;
		}
		return $currentpage;
	}
	
	private function getTotalPage() {
		$limit = $this->getLimit();
		$total = $this->getResultProvided();
		$totalpage = ceil($total / $limit);
		return (int) $totalpage;
	}
	
	public function fetchDoctors() {
		$totalresult = $this->getResultProvided(); 
		if($_SESSION['user_ses']==1) 
		{
					if ($totalresult > 0) {

						$fetch = $this->processgenSQL();

						echo "<div class='row'>";
						echo '<table class="table table-bordered table-striped">
								<tr>
									
									<td class="text-success" style="font-family:bold">Profile</td>	
									<td class="text-success" style="font-family:bold">Name</td>			
									<td class="text-success" style="font-family:bold">Specialty</td>
									<td class="text-success" style="font-family:bold">Email</td>			
									<td class="text-success" style="font-family:bold">Address</td>
									<td class="text-success" style="font-family:bold">Contact</td>			
									<td class="text-success" style="font-family:bold">Action</td>

								</tr>
								';

						foreach ($fetch as $fe) {
							$img = $fe['image'];
							$name = $fe['name'];
							$field = $fe['field'];
							$email = $fe['email'];
							$add = $fe['address'];
							$cont = $fe['contact'];
							$id = $fe['id'];
							echo "<tr class='danger'>";
							echo"<td class='text-primary'><image height='50' width='50' src='IMG/".$img."'/></td>";
							echo"<td class='text-primary'>{$name}</td>";
							echo"<td class='text-primary'>{$field}</td>";
							echo"<td class='text-primary'>{$email}</td>";
							echo"<td class='text-primary'>{$add}</td>";
							echo"<td class='text-primary'>{$cont}</td>";
									
  								echo'<td><a class = "btn btn-primary" href="viewdoctors.php?id='.$id.'">Read</a>';
                                echo"&nbsp&nbsp&nbsp";
                                echo"&nbsp&nbsp&nbsp";
                                echo'<a class = "btn btn-default" href="docupdate.php?id='.$id.'">Update</a>';
                                echo"&nbsp&nbsp&nbsp";
                                  echo"&nbsp&nbsp&nbsp";
                                echo'<a class = "btn btn-danger" href="deletedoc.php?id='.$id.'">Delete</a>';
                                echo"&nbsp&nbsp&nbsp </tr>";
								
						}
						echo '</table>';
						echo "</div>";
					}
					else
					{
						 echo "<div class='alert alert-danger'>No Doctors yet! </div>";
					}
		}
		else
		{
			if ($totalresult > 0) {
			$fetch = $this->processgenSQL();
			echo "<div class='row'>";
						echo '<table class="table table-bordered table-striped">
								<tr>
									<td class="text-success" style="font-family:bold">Profile</td>			
									<td class="text-success" style="font-family:bold">Name</td>			
									<td class="text-success" style="font-family:bold">Specialty</td>
									<td class="text-success" style="font-family:bold">Email</td>			
									<td class="text-success" style="font-family:bold">Address</td>
									<td class="text-success" style="font-family:bold">Contact</td>			
									<td class="text-success" style="font-family:bold">Action</td>

								</tr>
								';

						foreach ($fetch as $fe) {
							$img = $fe['image'];
							$name = $fe['name'];
							$field = $fe['field'];
							$email = $fe['email'];
							$add = $fe['address'];
							$cont = $fe['contact'];
							$id = $fe['id'];
							echo "<tr class='danger'>";
							echo"<td class='text-primary'><image height='50' width='50' src='IMG/".$img."'/></td>";
							echo"<td class='text-primary'>{$name}</td>";
							echo"<td class='text-primary'>{$field}</td>";
							echo"<td class='text-primary'>{$email}</td>";
							echo"<td class='text-primary'>{$add}</td>";
							echo"<td class='text-primary'>{$cont}</td>";
									
  								echo'<td><a class = "btn btn-primary" href="viewdoctors.php?id='.$id.'">Read</a>';
                                echo"&nbsp&nbsp&nbsp";
                                 echo'<a class = "btn btn-default" href="docupdate.php?id='.$id.'">Update</a>';
								
						}
						echo '</table>';
						echo "</div>";
					}
				else
					{
						 echo "<div class='alert alert-danger'>No Doctors yet! </div>";
					}
				}

	}

public function fetchDoc() {
		$totalresult = $this->getResultProvided(); 

					if ($totalresult > 0) {

						$fetch = $this->processgenSQL();

						echo "<div class='row'>";
						echo '<table class="table table-bordered table-striped">
								<tr>
									
									<td class="text-success" style="font-family:bold">Profile</td>	
									<td class="text-success" style="font-family:bold">Name</td>			
									<td class="text-success" style="font-family:bold">Specialty</td>
									<td class="text-success" style="font-family:bold">Email</td>			
									<td class="text-success" style="font-family:bold">Address</td>
									<td class="text-success" style="font-family:bold">Contact</td>			
									<td class="text-success" style="font-family:bold">Action</td>

								</tr>
								';

						foreach ($fetch as $fe) {
							$img = $fe['image'];
							$name = $fe['name'];
							$field = $fe['field'];
							$email = $fe['email'];
							$add = $fe['address'];
							$cont = $fe['contact'];
							$id = $fe['id'];
							echo "<tr class='danger'>";
							echo"<td class='text-primary'><image height='50' width='50' src='IMG/".$img."'/></td>";
							echo"<td class='text-primary'>{$name}</td>";
							echo"<td class='text-primary'>{$field}</td>";
							echo"<td class='text-primary'>{$email}</td>";
							echo"<td class='text-primary'>{$add}</td>";
							echo"<td class='text-primary'>{$cont}</td>";
									
  								echo'<td><a class = "btn btn-primary" href="viewdoc.php?id='.$id.'">Read</a>';
                                echo"&nbsp&nbsp&nbsp";
								
						}
						echo '</table>';
						echo "</div>";
					}
					else
					{
						 echo "<div class='alert alert-danger'>No Doctors yet! </div>";
					}
		}
	public function fetchUsers() {
		$totalresult = $this->getResultProvided(); 
		if($_SESSION['user_ses']==1)
		{
					if ($totalresult > 0) {

						$fetch = $this->processgenSQL();

						echo "<div class='row'>";
						echo '<table class="table table-bordered table-striped">
								<tr>
									
									<td class="text-success" style="font-family:bold">Profile</td>	
									<td class="text-success" style="font-family:bold">Name</td>			
									<td class="text-success" style="font-family:bold">Email</td>			
									<td class="text-success" style="font-family:bold">Address</td>
									<td class="text-success" style="font-family:bold">Contact</td>			
									<td class="text-success" style="font-family:bold">Action</td>

								</tr>
								';

						foreach ($fetch as $fe) {
							$img = $fe['image'];
							$name = $fe['name'];
							$email = $fe['email'];
							$add = $fe['address'];
							$cont = $fe['contact'];
							$id = $fe['id'];
							echo "<tr class='danger'>";
							echo"<td class='text-primary'><image height='50' width='50' src='IMG/".$img."'/></td>";
							echo"<td class='text-primary'>{$name}</td>";
							echo"<td class='text-primary'>{$email}</td>";
							echo"<td class='text-primary'>{$add}</td>";
							echo"<td class='text-primary'>{$cont}</td>";
									
  								echo'<td><a class = "btn btn-primary" href="userviewuser.php?id='.$id.'">Read</a>';
                                echo"&nbsp&nbsp&nbsp";
                                echo"&nbsp&nbsp&nbsp";
                                echo'<a class = "btn btn-default" href="userupdate.php?id='.$id.'">Update</a>';
                                echo"&nbsp&nbsp&nbsp";
                                  echo"&nbsp&nbsp&nbsp";
                                echo'<a class = "btn btn-danger" href="deleteuser.php?id='.$id.'">Delete</a>';
                                echo"&nbsp&nbsp&nbsp </tr>";
								
						}
						echo '</table>';
						echo "</div>";
					}
					else
					{
						 echo "<div class='alert alert-danger'>No Doctors yet! </div>";
					}
		}
		else
		{
			if ($totalresult > 0) {
			$fetch = $this->processgenSQL();
			echo "<div class='row'>";
						echo '<table class="table table-bordered table-striped">
								<tr>
									<td class="text-success" style="font-family:bold">Profile</td>	
									<td class="text-success" style="font-family:bold">Name</td>			
									<td class="text-success" style="font-family:bold">Email</td>			
									<td class="text-success" style="font-family:bold">Address</td>
									<td class="text-success" style="font-family:bold">Contact</td>			
									<td class="text-success" style="font-family:bold">Action</td>

								</tr>
								';

						foreach ($fetch as $fe) {
							$img = $fe['image'];
							$name = $fe['name'];
							$email = $fe['email'];
							$add = $fe['address'];
							$cont = $fe['contact'];
							$id = $fe['id'];
							echo "<tr class='danger'>";
							echo"<td class='text-primary'><image height='50' width='50' src='IMG/".$img."'/></td>";
							echo"<td class='text-primary'>{$name}</td>";
							echo"<td class='text-primary'>{$email}</td>";
							echo"<td class='text-primary'>{$add}</td>";
							echo"<td class='text-primary'>{$cont}</td>";
									
  								echo'<td><a class = "btn btn-primary" href="userviewuser.php?id='.$id.'">Read</a>';
                                echo"&nbsp&nbsp&nbsp";
								
						}
						echo '</table>';
						echo "</div>";
					}
				else
					{
						 echo "<div class='alert alert-danger'>No Doctors yet! </div>";
					}
				}

	}

		public function fetchApp() {
		$totalresult = $this->getResultProvided(); 
		if($_SESSION['user'])
		{
					if ($totalresult > 0) {

						$fetch = $this->processgenSQL();

						foreach ($fetch as $fe) {
							$doa = $fe['doa'];
							$name = $fe['a_name'];
							$id = $fe['app_id'];
				echo "<div class='container'>
                <div class='well'>"
                . $doa."<br/><b>". $name."</b>";
                 echo'
                  <span class="pull-right">
                 <a class = "btn btn-primary" href="to_details.php?app_id='.$id.'">View Details</a></span> </div></div>';

                }
            }

            else
            {

           echo "<div class='alert alert-danger'><center>No Appointments for Today</center></div>";

            }
							
						echo '</table>';
						echo "</div>";
		}


	}




	

        //public function displaynav(){
          //  if(isset($_SESSION['user_ses'])){
           //     if($_SESSION['user_ses'] == 1){
             //       include"include/header2.php";
               // }
                //else{
                  //  include"include/header1.php";
              //  }
            //}else{
              //  include"include/header.php";
            //}
        //}
        //public function displaydocnav(){
          //  if(isset($_SESSION['user'])){
            //    include"include/header3.php";
            //}
            //else{
              //  include"include/header.php";
           // }
        //}

    }
?>